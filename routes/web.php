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
Route::get('/page/{slug}', [\App\Http\Controllers\FrontPageController::class, 'page_show'])->name('page.show');
Route::get('/berita', [\App\Http\Controllers\FrontPageController::class, 'berita'])->name('front.berita');
Route::get('/faq', [\App\Http\Controllers\FrontPageController::class, 'faq'])->name('front.faq');
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
    Route::resource('layanan', \App\Http\Controllers\LayananController::class)->except('show');
    Route::put('cta/set_active/{id}', [\App\Http\Controllers\CtaController::class, 'set_active'])->name('cta.set_active');
    Route::resource('cta', \App\Http\Controllers\CtaController::class)->except('show');
    Route::resource('link_terkait', \App\Http\Controllers\LinkTerkaitController::class)->except('show');
    Route::resource('kategori', \App\Http\Controllers\KategoriController::class)->except('show');
    Route::resource('berita', \App\Http\Controllers\BeritaController::class)->except('show');
    Route::resource('folder', \App\Http\Controllers\FolderController::class)->except('show');
    Route::resource('foto', \App\Http\Controllers\GaleriController::class)->except('show');
    Route::resource('video', \App\Http\Controllers\VideoController::class)->except('show');
    Route::resource('faq', \App\Http\Controllers\FaqController::class)->except('show');
    Route::resource('kontak', \App\Http\Controllers\KontakController::class)->except('show');
    Route::resource('bank_data', \App\Http\Controllers\BankDataController::class)->except('show');
    Route::resource('page', \App\Http\Controllers\PageController::class)->except('show');
    Route::resource('dynamic_menu', \App\Http\Controllers\DynamicMenuController::class)->except('show');

    Route::get('galeri_dropzone/{folder_id}/upload',[App\Http\Controllers\GaleriController::class, 'fileStoreDropzone'])->name('galeri.fileDropzone');
    Route::post('galeri_dropzone/{folder_id}/upload/store',[App\Http\Controllers\GaleriController::class, 'fileStore'])->name('galeri.fileStore');
    Route::post('galeri_dropzone/delete',[App\Http\Controllers\GaleriController::class, 'fileDestroy'])->name('galeri.fileDestroy');
    Route::post('galeri_dropzone/deleteReload',[App\Http\Controllers\GaleriController::class, 'fileDestroyReload'])->name('galeri.fileDestroyReload');

    Route::get('video_dropzone/{folder_id}/upload',[App\Http\Controllers\VideoController::class, 'fileStoreDropzone'])->name('video.fileDropzone');
    Route::post('video_dropzone/{folder_id}/upload/store',[App\Http\Controllers\VideoController::class, 'fileStore'])->name('video.fileStore');
    Route::post('video_dropzone/delete',[App\Http\Controllers\VideoController::class, 'fileDestroy'])->name('video.fileDestroy');
    Route::post('video_dropzone/deleteReload',[App\Http\Controllers\VideoController::class, 'fileDestroyReload'])->name('video.fileDestroyReload');

    // CkEditor Berita
    Route::post('helper/ckeditor_upload',[App\Http\Controllers\BeritaController::class, 'ckeditor_upload'])->name('helper.ckeditor_upload');
});

require __DIR__.'/auth.php';
