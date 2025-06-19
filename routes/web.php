<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KritikSaranController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::get('daftar', [LoginController::class, 'daftar'])->name('daftar');
Route::post('/daftar', [LoginController::class, 'register']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login', [LoginController::class, 'login']);

// Route untuk admin dashboard
Route::get('admin/dashboard', [LoginController::class, 'admin_dashboard'])->name('admin.dashboard');
Route::get('dekan/dashboard', [LoginController::class, 'dekan_dashboard'])->name('dekan.dashboard');

// Route untuk user dashboard
Route::get('/dashboard', [LoginController::class, 'user_dashboard'])->name('user.dashboard');

Route::get('/kritiksaran', [KritikSaranController::class, 'user_index'])->name('user.kritiksaran');
Route::post('/kritiksaran', [KritikSaranController::class, 'user_store']);

Route::get('user/hubungi', [KritikSaranController::class, 'user_hubungi'])->name('user.hubungi');
Route::get('admin/profil', [KritikSaranController::class, 'admin_profil'])->name('admin.profil');
Route::get('admin/profil/edit', [KritikSaranController::class, 'admin_profiledit'])->name('admin.profiledit');
Route::post('admin/profil', [KritikSaranController::class, 'admin_profilupdate']);
Route::get('admin/manajemen', [KritikSaranController::class, 'admin_manajemen'])->name('admin.manajemen');
Route::get('admin/manajemen/{id}/detail', [KritikSaranController::class, 'admin_manajemendetail'])->name('admin.manajemen.detail');
Route::post('admin/manajemen/proses', [KritikSaranController::class, 'admin_manajemenproses'])->name('admin.manajemen.proses');
Route::post('admin/manajemen/selesai', [KritikSaranController::class, 'admin_manajemenselesai'])->name('admin.manajemen.selesai');
Route::put('admin/tanggapan/{id}/update', [KritikSaranController::class, 'updateTanggapan'])->name('admin.tanggapan.update');


Route::get('dekan/profil', [KritikSaranController::class, 'dekan_profil'])->name('dekan.profil');
Route::get('dekan/profil/edit', [KritikSaranController::class, 'dekan_profiledit'])->name('dekan.profiledit');
Route::post('dekan/profil', [KritikSaranController::class, 'dekan_profilupdate']);
Route::get('dekan/manajemen', [KritikSaranController::class, 'dekan_manajemen'])->name('dekan.manajemen');
Route::get('dekan/manajemen/{id}/detail', [KritikSaranController::class, 'dekan_manajemendetail'])->name('dekan.manajemen.detail');