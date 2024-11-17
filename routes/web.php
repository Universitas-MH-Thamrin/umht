<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\FrontPageController::class, 'index'])->name('front.index');
Route::get('/kontak', [\App\Http\Controllers\FrontPageController::class, 'kontak'])->name('front.kontak');
Route::post('kontak', [\App\Http\Controllers\FrontPageController::class, 'kontak'])->name('front.kontak.store');

// Page From Backend
Route::get('/berita', [\App\Http\Controllers\FrontPageController::class, 'berita'])->name('front.berita');
Route::get('berita/{slug}', [\App\Http\Controllers\FrontPageController::class, 'berita_detail'])->name('berita.detail');
Route::get('kategori/{slug}', [\App\Http\Controllers\FrontPageController::class, 'berita_kategori'])->name('berita.kategori');
Route::get('/foto', [\App\Http\Controllers\FrontPageController::class, 'foto'])->name('front.foto');
Route::get('foto_folder/{folder_id}', [\App\Http\Controllers\FrontPageController::class, 'foto_folder'])->name('front.foto_folder');
Route::get('/video', [\App\Http\Controllers\FrontPageController::class, 'video'])->name('front.video');
Route::get('video_folder/{folder_id}', [\App\Http\Controllers\FrontPageController::class, 'video_folder'])->name('front.video_folder');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => 'auth'], function() {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('index');

    Route::get('user/profile', [\App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');
    Route::put('user/profile_update', [\App\Http\Controllers\UserController::class, 'profile_update'])->name('user.profile_update');

    // Website Modules
    Route::resource('user', \App\Http\Controllers\UserController::class)->except('show');
    Route::resource('slider', \App\Http\Controllers\SliderController::class)->except('show');

    Route::resource('kontak', \App\Http\Controllers\KontakController::class)->except('show');
});

require __DIR__.'/auth.php';
