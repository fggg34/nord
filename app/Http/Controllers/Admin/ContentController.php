<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index(): RedirectResponse
    {
        $first = collect(config('cms.pages', []))->pluck('slug')->first() ?? 'home';

        return redirect()->route('admin.pages.edit', ['page' => $first]);
    }

    public function update(Request $request): RedirectResponse
    {
        $first = collect(config('cms.pages', []))->pluck('slug')->first() ?? 'home';

        return redirect()
            ->route('admin.pages.edit', ['page' => $first])
            ->with('status', 'Use per-page editor: /admin/pages/'.$first);
    }
}
