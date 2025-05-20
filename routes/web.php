<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DistribusiBarangAdminController;
use App\Http\Controllers\Admin\PermintaanBarangAdminController;
use App\Http\Controllers\Admin\StokBarangAdminController;
use App\Http\Controllers\Admin\LaporanAdminController;
use App\Http\Controllers\Admin\PenggunaAdminController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\Distributor\DistributorController;
use App\Http\Controllers\Petani\PetaniController;
use App\Http\Controllers\Gudang\GudangController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');

        Route::prefix('pengguna')->group(function () {
            Route::get('/', [PenggunaAdminController::class, 'index'])->name('pengguna.index');
            Route::get('/filter', [PenggunaAdminController::class, 'filter'])->name('pengguna.filter');
            // Route::get('/show/{id}', [PenggunaAdminController::class, 'show'])->name('pengguna.show');
        });
        Route::prefix('stok-barang')->group(function () {
            Route::get('/', [StokBarangAdminController::class, 'index'])->name('stok-barang.index');
            Route::get('/filter', [StokBarangAdminController::class, 'filter'])->name('stok-barang.filter');
            Route::get('/show/{id}', [StokBarangAdminController::class, 'show'])->name('stok-barang.show');
            Route::get('/create', [StokBarangAdminController::class, 'create'])->name('stok-barang.create');
            Route::post('/store', [StokBarangAdminController::class, 'store'])->name('stok-barang.store');
            Route::get('/edit/{id}', [StokBarangAdminController::class, 'edit'])->name('stok-barang.edit');
            Route::put('/update/{id}', [StokBarangAdminController::class, 'update'])->name('stok-barang.update');
            Route::delete('/destroy/{id}', [StokBarangAdminController::class, 'destroy'])->name('stok-barang.destroy');
        });
        Route::prefix('permintaan-barang')->group(function () {
            Route::get('/', [PermintaanBarangAdminController::class, 'index'])->name('permintaan-barang.index');
            Route::get('/filter', [PermintaanBarangAdminController::class, 'filter'])->name('permintaan-barang.filter');
            // Route::get('/show/{id}', [PermintaanBarangAdminController::class, 'show'])->name('permintaan-barang.show');
            Route::get('/create', [PermintaanBarangAdminController::class, 'create'])->name('permintaan-barang.create');
            Route::post('/store', [PermintaanBarangAdminController::class, 'store'])->name('permintaan-barang.store');
            Route::get('/edit/{id}', [PermintaanBarangAdminController::class, 'edit'])->name('permintaan-barang.edit');
            Route::put('/update/{id}', [PermintaanBarangAdminController::class, 'update'])->name('permintaan-barang.update');
            Route::delete('/destroy/{id}', [PermintaanBarangAdminController::class, 'destroy'])->name('permintaan-barang.destroy');
        });

        Route::prefix('distribusi-barang')->group(function () {
            Route::get('/', [DistribusiBarangAdminController::class, 'index'])->name('distribusi-barang.index');
            Route::get('/filter', [DistribusiBarangAdminController::class, 'filter'])->name('distribusi-barang.filter');
            // Route::get('/{id}', [DistribusiBarangAdminController::class, 'show'])->name('distribusi-barang.show');
            Route::get('/create', [DistribusiBarangAdminController::class, 'create'])->name('distribusi-barang.create');
            Route::post('/store', [DistribusiBarangAdminController::class, 'store'])->name('distribusi-barang.store');
            Route::get('/edit/{id}', [DistribusiBarangAdminController::class, 'edit'])->name('distribusi-barang.edit');
            Route::put('/update/{id}', [DistribusiBarangAdminController::class, 'update'])->name('distribusi-barang.update');
            Route::delete('/destroy/{id}', [DistribusiBarangAdminController::class, 'destroy'])->name('distribusi-barang.destroy');
        });
        Route::prefix('laporan')->group(function () {
            Route::get('/', [LaporanAdminController::class, 'index'])->name('laporan.index');
            Route::get('/filter', [LaporanAdminController::class, 'filter'])->name('laporan.filter');
            Route::get('/export', [LaporanAdminController::class, 'export'])->name('laporan.export');
        });
    });
});

Route::middleware(['auth', 'role:gudang'])->group(function () {

    Route::prefix('gudang')->group(function () {
        Route::get('/', [GudangController::class, 'index']);
    });
});

Route::middleware(['auth', 'role:distributor'])->group(function () {
    Route::prefix('distributor')->group(function () {
        Route::get('/', [DistributorController::class, 'index']);
    });
});

Route::middleware(['auth', 'role:petani'])->group(function () {
    Route::prefix('petani')->group(function () {
        Route::get('/', [PetaniController::class, 'index']);
    });
});
