<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PenyewaanController;
use App\Http\Controllers\Admin\PesananController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('index');

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('barang', [BarangController::class, 'index'])->name('barang');
        Route::post('barang', [BarangController::class, 'store'])->name('barang.store');
        Route::post('barang/varian', [BarangController::class, 'storeVarian'])->name('barang.varian.store');
        Route::get('barang/{barang:kode}', [BarangController::class, 'detail'])->name('barang.detail');
        Route::put('barang', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('barang', [BarangController::class, 'delete'])->name('barang.delete');
        Route::delete('barang/varian', [BarangController::class, 'deleteVarian'])->name('barang.varian.delete');

        Route::get('pesanan-masuk', [PesananController::class, 'index'])->name('orders');
        Route::get('pesanan-masuk/{order:id}', [PesananController::class, 'detail'])->name('orders.detail');
        Route::post('pesanan-masuk', [PesananController::class, 'terima'])->name('orders.terima');
        Route::delete('pesanan-masuk', [PesananController::class, 'delete'])->name('orders.delete');

        Route::group(['prefix' => 'penyewaan', 'as' => 'penyewaan.'], function () {
            Route::get('belum-lunas', [PenyewaanController::class, 'belumLunas'])->name('belum-lunas');
            Route::get('belum-lunas/{order:id}', [PenyewaanController::class, 'belumLunasDetail'])->name('belum-lunas.detail');
            Route::put('belum-lunas', [PenyewaanController::class, 'belumLunasUpdate'])->name('belum-lunas.update');

            Route::get('lunas', [PenyewaanController::class, 'lunas'])->name('lunas');
            Route::get('lunas/{order:id}', [PenyewaanController::class, 'lunasDetail'])->name('lunas.detail');
            Route::put('lunas', [PenyewaanController::class, 'lunasUpdate'])->name('lunas.update');
        });

        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('laporan/all', [LaporanController::class, 'exportAll'])->name('laporan.export-all');
        Route::get('laporan/{order:id}', [LaporanController::class, 'export'])->name('laporan.export');
    });

    Route::group(['middleware' => 'owner'], function () {
        Route::get('admin', [AdminController::class, 'index'])->name('admin');
        Route::post('admin', [AdminController::class, 'store'])->name('admin.store');
        Route::get('admin/{admin:id}', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('admin', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('admin', [AdminController::class, 'delete'])->name('admin.delete');
    });

    Route::get('konsumen', [UserController::class, 'index'])->name('konsumen');
    Route::get('konsumen/{user:id}', [UserController::class, 'detail'])->name('konsumen.detail');
    Route::delete('konsumen/{user:id}', [UserController::class, 'delete'])->name('konsumen.delete');

    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile', [AdminController::class, 'profileUpdate'])->name('profile.update');

    Route::put('pengaturan', [PengaturanController::class, 'simpan'])->name('pengaturan.save');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
