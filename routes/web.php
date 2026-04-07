<?php

use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/about-us', 'about-us');
Route::view('/contact-us', 'contact-us');
Route::view('/services', 'services');
Route::view('/our-fleet', 'our-fleet');
Route::view('/industries', 'industries');
Route::view('/privacy-policy', 'privacy-policy');
Route::view('/404', 'error-404');
Route::view('/search', 'search');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        $first = collect(config('cms.pages', []))->pluck('slug')->first() ?? 'home';

        return redirect()->route('admin.pages.edit', ['page' => $first]);
    })->name('dashboard');

    Route::get('/content', [ContentController::class, 'index'])->name('content.index');
    Route::put('/content', [ContentController::class, 'update'])->name('content.update');

    Route::get('/pages/{page}', [PageContentController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page}', [PageContentController::class, 'update'])->name('pages.update');
});

Route::fallback(function () {
    return response()->view('error-404', [], 404);
});
