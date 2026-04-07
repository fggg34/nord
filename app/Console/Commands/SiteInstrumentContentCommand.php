<?php

namespace App\Console\Commands;

use App\Models\Content;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SiteInstrumentContentCommand extends Command
{
    protected $signature = 'site:instrument-content
                            {--dry-run : Show changes without writing files or DB}
                            {--no-db : Update Blade only; skip database upserts}';

    protected $description = 'Extract leaf text from Framer body partials, seed contents table, and replace with content() Blade calls';

    public function handle(): int
    {
        $dir = resource_path('views/partials/framer');
        $files = glob($dir.'/_body_*.blade.php') ?: [];

        if ($files === []) {
            $this->error('No _body_*.blade.php files found.');

            return self::FAILURE;
        }

        sort($files);

        foreach ($files as $path) {
            $this->processFile($path);
        }

        $this->info('Done.');

        return self::SUCCESS;
    }

    protected function processFile(string $path): void
    {
        $base = basename($path, '.blade.php');
        $page = preg_replace('/^_body_/', '', $base) ?? $base;
        $html = file_get_contents($path);
        if ($html === false) {
            $this->warn("Skip unreadable: {$path}");

            return;
        }

        if (str_contains($html, "{{ content('")) {
            $this->line("Skip (already instrumented): {$path}");

            return;
        }

        $pattern = '/<(p|h[1-6]|span|a|label|button|li)\b[^>]*>([^<]{1,500})<\/\1>/iu';

        if (! preg_match_all($pattern, $html, $matches, PREG_OFFSET_CAPTURE)) {
            $this->warn("No matches: {$path}");

            return;
        }

        $usedKeys = [];

        $replacements = [];

        foreach ($matches[0] as $i => $full) {
            $tag = strtolower($matches[1][$i][0]);
            $rawInner = $matches[2][$i][0];
            $offset = $full[1];

            if (str_contains($rawInner, '{{') || str_contains($rawInner, '}}')) {
                continue;
            }

            $trimmed = trim($rawInner);
            if (mb_strlen($trimmed) < 2) {
                continue;
            }

            $pre = substr($html, max(0, $offset - 2500), 2500);
            if (preg_match_all('/data-framer-name="([^"]+)"/', $pre, $fn)) {
                $framer = end($fn[1]);
            } else {
                $framer = 'general';
            }

            $section = $this->slugKey((string) $framer, 120);
            $decoded = html_entity_decode($trimmed, ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $keyBase = $tag.'_'.$this->slugKey($decoded, 100);
            $key = $keyBase;
            $n = 2;
            while (isset($usedKeys[$section."\t".$key])) {
                $key = $keyBase.'_'.$n;
                $n++;
            }
            $usedKeys[$section."\t".$key] = true;

            $search = '>'.$rawInner.'</'.$tag.'>';
            if (str_contains($search, '{{ content(')) {
                continue;
            }

            $jsonFallback = json_encode($decoded, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
            $replace = ">{{ content('{$page}', '{$section}', '{$key}') ?? {$jsonFallback} }}</{$tag}>";

            $replacements[] = [
                'search' => $search,
                'replace' => $replace,
                'len' => strlen($search),
                'page' => $page,
                'section' => $section,
                'key' => $key,
                'value' => $decoded,
            ];
        }

        usort($replacements, fn (array $a, array $b): int => $b['len'] <=> $a['len']);

        $seenSearch = [];
        $unique = [];
        foreach ($replacements as $r) {
            if (isset($seenSearch[$r['search']])) {
                continue;
            }
            $seenSearch[$r['search']] = true;
            $unique[] = $r;
        }

        $this->info($path.' → page='.$page.' replacements='.count($unique));

        if ($this->option('dry-run')) {
            foreach (array_slice($unique, 0, 8) as $r) {
                $this->line("  [{$r['section']}.{$r['key']}] ".$r['value']);
            }

            return;
        }

        if (! $this->option('no-db')) {
            foreach ($unique as $r) {
                Content::query()->updateOrCreate(
                    [
                        'page' => $r['page'],
                        'section' => $r['section'],
                        'key' => $r['key'],
                    ],
                    ['value' => $r['value']]
                );
            }
        }

        $newHtml = $html;
        foreach ($unique as $r) {
            $count = 0;
            $newHtml = str_replace($r['search'], $r['replace'], $newHtml, $count);
            if ($count === 0) {
                $this->warn("  Missed replace: {$r['search']}");
            }
        }

        file_put_contents($path, $newHtml);
    }

    protected function slugKey(string $value, int $max): string
    {
        $s = Str::slug($value, '_');
        if ($s === '') {
            $s = 'text';
        }

        return Str::limit($s, $max, '');
    }
}
