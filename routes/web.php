<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::middleware('admin')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::post('/buku/edit/{id}/delete-image/{image_id}', [BukuController::class, 'deleteImage'])->name('buku.deleteImage');
    });
    
    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
    Route::get('/detail_buku/{id}', [BukuController::class, 'galbuku'])->name('buku.galeri');
});


require __DIR__ . '/auth.php';
