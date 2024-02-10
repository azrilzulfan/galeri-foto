<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route home
Route::get('/', [BerandaController::class, 'index'])->name('beranda');
// Route page explore atau jelajahi
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

Route::middleware(['auth'])->group(function () {
    // Route data dan view album yang dimiliki tiap user
    Route::get('/profile', [AlbumController::class, 'index'])->name('profile.index');
    // Route crud album
    Route::post('/profile', [AlbumController::class, 'store'])->name('album.store');
    Route::put('/profile/{id}', [AlbumController::class, 'update'])->name('album.update');
    Route::delete('/profile/{id}', [AlbumController::class, 'destroy'])->name('album.destroy');

    // Route data dan view foto berdasarkan album yang dipilih
    Route::get('/album/{id}', [FotoController::class, 'index'])->name('album.index');
    // Route crud foto
    Route::post('/album/{id}', [FotoController::class, 'store'])->name('foto.store');
    Route::put('/album/{id}', [FotoController::class, 'update'])->name('foto.update');
    Route::delete('/album/{id}', [FotoController::class, 'destroy'])->name('foto.destroy');
    // Route detail foto
    Route::get('/foto/{id}', [FotoController::class, 'show'])->name('foto.show');

    // Route like foto
    Route::post('/foto/{id}/like', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/foto/{id}/like', [LikeController::class, 'destroy'])->name('like.destroy');

    // Route komentar foto
    Route::post('/foto/{id}/komentar', [KomentarController::class, 'store'])->name('komentar.store');
    Route::delete('/foto/{id}/komentar', [KomentarController::class, 'destroy'])->name('komentar.destroy');
});

require __DIR__.'/auth.php';
