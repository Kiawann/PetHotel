<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Konsumen\homeController;
use App\Http\Controllers\Admin\KategoriHewanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataHewanController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});
Route::POST('register', [RegisterController::class, 'create'])->name('register');
Route::POST('datapemilik', [App\Http\Controllers\Auth\RegisterController::class, 'datapemilik'])->name('biodata');
Route::GET('datapemilik', [App\Http\Controllers\Auth\RegisterController::class, 'datapemilik'])->name('biodata');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Routes for Konsumen
Route::middleware(['check.role:konsumen'])->group(function () {
    Route::resource('/konsumen', HomeController::class);
});

// Routes for Admin
Route::middleware(['check.role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('/admin', DashboardController::class);
      //kategori hewan
Route::get('/kategori-hewan', [KategoriHewanController::class, 'index'])->name('kategori_hewan.index');
Route::get('kategori-hewan/create', [KategoriHewanController::class, 'create'])->name('kategori_hewan.create');
Route::post('kategori-hewan', [KategoriHewanController::class, 'store'])->name('kategori_hewan.store');
Route::get('kategori-hewan/{id_kategori_hewan}/edit', [KategoriHewanController::class, 'edit'])->name('kategori_hewan.edit');
Route::put('kategori-hewan/{id_kategori_hewan}', [KategoriHewanController::class, 'update'])->name('kategori_hewan.update');
Route::delete('kategori-hewan/{id_kategori_hewan}', [KategoriHewanController::class, 'destroy'])->name('kategori_hewan.destroy');
    //biodata hewan 
Route::get('/data-hewan', [DataHewanController::class, 'index'])->name('data_hewan.index');
Route::get('/data-hewan/create', [DataHewanController ::class, 'create'])->name('data_hewan.create');
Route::post('/data-hewan', [DataHewanController::class, 'store'])->name('data_hewan.store');
Route::get('/data-hewan/{id}/edit', [DataHewanController::class, 'edit'])->name('data_hewan.edit');
Route::put('/data-hewan/{id}', [DataHewanController::class, 'update'])->name('data_hewan.update');
Route::delete('/data-hewan/{id}', [DataHewanController::class, 'destroy'])->name('data_hewan.destroy');
Route::get('/api/pemilik/search', [DataHewanController::class, 'search'])->name('pemilik.search');

  

});

