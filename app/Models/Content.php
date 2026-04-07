<?php

namespace App\Models;

use App\Support\ContentRepository;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        'page',
        'section',
        'key',
        'value',
        'type',
    ];

    protected static function booted(): void
    {
        static::saved(function (Content $content): void {
            ContentRepository::forgetPage($content->page);
        });

        static::deleted(function (Content $content): void {
            ContentRepository::forgetPage($content->page);
        });
    }
}
