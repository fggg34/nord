<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Support\CmsFieldPresenter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageContentController extends Controller
{
    public function edit(string $page): View
    {
        $this->assertPageAllowed($page);
        $this->ensureRepeaterRows($page);

        $rows = Content::query()
            ->where('page', $page)
            ->orderBy('section')
            ->orderBy('key')
            ->get();

        $flatRows = $rows->filter(fn (Content $r) => $r->type !== 'repeater');
        $grouped = $this->sortSectionsForAdmin($flatRows->groupBy('section'));
        $grouped = $this->filterGroupedSectionsForAdmin($page, $grouped);

        $repeaters = $this->repeatersForPage($page, $rows);

        return view('admin.pages.edit', [
            'page' => $page,
            'pageLabel' => $this->pageLabel($page),
            'pages' => collect(config('cms.pages', [])),
            'grouped' => $grouped,
            'repeaters' => $repeaters,
        ]);
    }

    public function update(Request $request, string $page): RedirectResponse
    {
        $this->assertPageAllowed($page);

        $validated = $request->validate([
            'fields' => ['nullable', 'array'],
            'fields.*' => ['nullable', 'string'],
            'repeaters' => ['nullable', 'array'],
            'repeaters.*' => ['nullable', 'string'],
            'files' => ['nullable', 'array'],
            'files.*' => ['nullable', 'file', 'max:40960', 'mimes:jpg,jpeg,png,gif,webp,svg,bmp,ico,mp4,webm,ogg,mov'],
            'repeater_files' => ['nullable', 'array'],
        ]);

        foreach ($validated['fields'] ?? [] as $id => $value) {
            $id = (int) $id;
            if ($id <= 0) {
                continue;
            }

            $row = Content::query()->find($id);
            if ($row === null || $row->page !== $page || $row->type === 'repeater') {
                continue;
            }

            $wt = CmsFieldPresenter::widget($row)['type'];
            if ($wt === 'image' || $wt === 'video') {
                continue;
            }

            $row->update(['value' => $value ?? '']);
        }

        foreach ($request->file('files', []) as $id => $file) {
            $id = (int) $id;
            if ($id <= 0 || $file === null) {
                continue;
            }

            $row = Content::query()->find($id);
            if ($row === null || $row->page !== $page || $row->type === 'repeater') {
                continue;
            }

            $wt = CmsFieldPresenter::widget($row)['type'];
            if ($wt !== 'image' && $wt !== 'video') {
                continue;
            }

            $mime = (string) $file->getMimeType();
            if ($wt === 'image' && ! str_starts_with($mime, 'image/')) {
                continue;
            }
            if ($wt === 'video' && ! str_starts_with($mime, 'video/')) {
                continue;
            }

            $old = $row->value;
            if (is_string($old) && $old !== '' && str_starts_with($old, 'cms/')) {
                Storage::disk('public')->delete($old);
            }

            $path = $file->store('cms/'.$page, 'public');
            $row->update(['value' => $path]);
        }

        foreach ($validated['repeaters'] ?? [] as $storageKey => $json) {
            $decoded = $this->decodeRepeaterStorageKey((string) $storageKey);
            if ($decoded === null || $decoded['page'] !== $page) {
                continue;
            }

            $rep = $this->findRepeaterConfig($decoded['page'], $decoded['section'], $decoded['key']);
            if ($rep === null) {
                continue;
            }

            $items = json_decode((string) $json, true);
            if (! is_array($items)) {
                $items = [];
            }

            $items = $this->mergeRepeaterImageUploads($items, $rep, (string) $storageKey, $request);
            $items = $this->sanitizeRepeaterItems($items, $rep);

            Content::query()->updateOrCreate(
                [
                    'page' => $rep['page'],
                    'section' => $rep['section'],
                    'key' => $rep['key'],
                ],
                [
                    'value' => json_encode($items, JSON_UNESCAPED_UNICODE),
                    'type' => 'repeater',
                ]
            );
        }

        return redirect()
            ->route('admin.pages.edit', ['page' => $page])
            ->with('status', 'Saved.');
    }

    protected function assertPageAllowed(string $page): void
    {
        $allowed = collect(config('cms.pages', []))->pluck('slug')->all();
        if (! in_array($page, $allowed, true)) {
            throw new NotFoundHttpException;
        }
    }

    protected function pageLabel(string $page): string
    {
        $hit = collect(config('cms.pages', []))->firstWhere('slug', $page);

        return $hit['label'] ?? $page;
    }

    /**
     * @param  Collection<string, Collection<int, Content>>  $grouped
     * @return Collection<string, Collection<int, Content>>
     */
    /**
     * @param  Collection<string, Collection<int, Content>>  $grouped
     * @return Collection<string, Collection<int, Content>>
     */
    protected function filterGroupedSectionsForAdmin(string $page, Collection $grouped): Collection
    {
        $configKey = 'cms.admin_visible_sections.'.$page;
        if (! config()->has($configKey)) {
            return $grouped;
        }

        $allowed = config($configKey);
        if (! is_array($allowed)) {
            return $grouped;
        }

        if ($allowed === []) {
            return collect();
        }

        return $grouped->only($allowed);
    }

    protected function sortSectionsForAdmin(Collection $grouped): Collection
    {
        $rank = function (string $s): int {
            return match ($s) {
                'branding' => 0,
                'footer' => 1,
                'hero', 'stats' => 1,
                'services_industries' => 2,
                'critical_industries' => 3,
                'by_the_numbers' => 2,
                'features_section' => 3,
                'fleet_categories' => 4,
                'below_hero' => 2,
                'our_services' => 2,
                'features' => 3,
                'our_process' => 4,
                'our_history' => 3,
                'mission_values' => 4,
                'our_locations' => 5,
                'team' => 6,
                'certified' => 7,
                'cms_repeaters' => 8,
                default => 9,
            };
        };

        $sortedKeys = $grouped->keys()->sort(function (string $a, string $b) use ($rank): int {
            $ra = $rank($a);
            $rb = $rank($b);
            if ($ra !== $rb) {
                return $ra <=> $rb;
            }

            return strcmp($a, $b);
        });

        $out = collect();
        foreach ($sortedKeys as $key) {
            $out->put($key, $grouped->get($key));
        }

        return $out;
    }

    protected function ensureRepeaterRows(string $page): void
    {
        foreach (config('cms.repeaters', []) as $rep) {
            if (($rep['page'] ?? '') !== $page) {
                continue;
            }

            Content::query()->firstOrCreate(
                [
                    'page' => $rep['page'],
                    'section' => $rep['section'],
                    'key' => $rep['key'],
                ],
                [
                    'value' => '[]',
                    'type' => 'repeater',
                ]
            );
        }
    }

    /**
     * @return Collection<int, array<string, mixed>>
     */
    protected function repeatersForPage(string $page, Collection $rows): Collection
    {
        $bySectionKey = $rows
            ->filter(fn (Content $r) => $r->type === 'repeater')
            ->keyBy(fn (Content $r) => "{$r->section}\x1E{$r->key}");

        return collect(config('cms.repeaters', []))
            ->filter(fn (array $r) => ($r['page'] ?? '') === $page)
            ->values()
            ->map(function (array $rep) use ($bySectionKey) {
                $k = "{$rep['section']}\x1E{$rep['key']}";
                $row = $bySectionKey->get($k);
                $raw = $row?->value ?? '[]';
                $items = json_decode((string) $raw, true);

                if (! is_array($items)) {
                    $items = [];
                }

                $items = $this->sanitizeRepeaterItems($items, $rep);

                return array_merge($rep, [
                    'row' => $row,
                    'items' => $items,
                    'storage_key' => $this->encodeRepeaterStorageKey($rep['page'], $rep['section'], $rep['key']),
                ]);
            });
    }

    protected function findRepeaterConfig(string $page, string $section, string $key): ?array
    {
        foreach (config('cms.repeaters', []) as $rep) {
            if (($rep['page'] ?? '') === $page
                && ($rep['section'] ?? '') === $section
                && ($rep['key'] ?? '') === $key) {
                return $rep;
            }
        }

        return null;
    }

    protected function encodeRepeaterStorageKey(string $page, string $section, string $key): string
    {
        return rtrim(strtr(base64_encode(json_encode([$page, $section, $key], JSON_THROW_ON_ERROR)), '+/', '-_'), '=');
    }

    /**
     * @return array{page: string, section: string, key: string}|null
     */
    protected function decodeRepeaterStorageKey(string $encoded): ?array
    {
        $pad = strlen($encoded) % 4;
        if ($pad > 0) {
            $encoded .= str_repeat('=', 4 - $pad);
        }

        $json = base64_decode(strtr($encoded, '-_', '+/'), true);
        if ($json === false) {
            return null;
        }

        $data = json_decode($json, true);
        if (! is_array($data) || count($data) !== 3) {
            return null;
        }

        return [
            'page' => (string) $data[0],
            'section' => (string) $data[1],
            'key' => (string) $data[2],
        ];
    }

    /**
     * @param  array<int, mixed>  $items
     * @return array<int, array<string, string>>
     */
    /**
     * @param  array<int, mixed>  $items
     * @return array<int, array<string, string>>
     */
    protected function mergeRepeaterImageUploads(array $items, array $rep, string $storageKey, Request $request): array
    {
        $imageFieldKeys = collect($rep['fields'] ?? [])
            ->filter(fn (array $f) => ($f['type'] ?? '') === 'image')
            ->pluck('key')
            ->filter()
            ->all();

        if ($imageFieldKeys === []) {
            return $items;
        }

        $bag = $request->file('repeater_files', []);
        if (! is_array($bag) || ! isset($bag[$storageKey]) || ! is_array($bag[$storageKey])) {
            return $items;
        }

        $page = (string) ($rep['page'] ?? '');
        $repKey = (string) ($rep['key'] ?? 'repeater');
        $dir = 'cms/'.$page.'/'.$repKey;

        foreach ($bag[$storageKey] as $index => $uploads) {
            if (! is_array($uploads)) {
                continue;
            }

            $i = (int) $index;
            if ($i < 0 || ! isset($items[$i]) || ! is_array($items[$i])) {
                continue;
            }

            foreach ($imageFieldKeys as $fk) {
                $file = $uploads[$fk] ?? null;
                if (! $file instanceof UploadedFile || ! $file->isValid()) {
                    continue;
                }

                $maxBytes = 5120 * 1024;
                if ($file->getSize() > $maxBytes) {
                    continue;
                }

                $old = isset($items[$i][$fk]) ? (string) $items[$i][$fk] : '';
                if ($old !== '' && str_starts_with($old, 'cms/')) {
                    Storage::disk('public')->delete($old);
                }

                $path = $file->store($dir, 'public');
                $items[$i][$fk] = $path;
            }
        }

        return $items;
    }

    protected function sanitizeRepeaterItems(array $items, array $rep): array
    {
        $fieldDefs = collect($rep['fields'] ?? [])
            ->filter(fn (array $f) => ($f['key'] ?? '') !== '')
            ->keyBy(fn (array $f) => (string) $f['key']);
        $fieldKeys = $fieldDefs->keys()->all();
        $out = [];

        foreach ($items as $item) {
            if (! is_array($item)) {
                continue;
            }

            $row = [];
            foreach ($fieldKeys as $fk) {
                $raw = isset($item[$fk]) ? (string) $item[$fk] : '';
                $type = (string) ($fieldDefs->get($fk, [])['type'] ?? 'text');
                if ($type === 'image' && $raw !== '' && ! str_starts_with($raw, 'cms/')
                    && ! str_starts_with($raw, 'assets/')
                    && ! preg_match('#^https?://#i', $raw) && ! str_starts_with($raw, '/')) {
                    $raw = '';
                }
                if ($type === 'html') {
                    $raw = preg_replace('#<\s*script\b[^>]*>.*?<\s*/\s*script\s*>#is', '', $raw) ?? '';
                    $raw = preg_replace('#\s+on\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)#i', '', $raw) ?? '';
                }
                $row[$fk] = $raw;
            }
            $out[] = $row;
        }

        return $out;
    }
}
