<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DistribusiBarangAdminController;
use App\Http\Controllers\Admin\PermintaanBarangAdminController;
use App\Http\Controllers\Admin\StokBarangAdminController;
use App\Http\Controllers\Admin\LaporanAdminController;
use App\Http\Controllers\Admin\PenggunaAdminController;
use App\Http\Controllers\Gudang\GudangController;
use App\Http\Controllers\Gudang\StokBarangGudangController;
use App\Http\Controllers\Gudang\PermintaanBarangGudangController;
use App\Http\Controllers\Gudang\DistribusiBarangGudangController;
use App\Http\Controllers\Distributor\DistributorController;
use App\Http\Controllers\Distributor\PermintaanBarangDistributorController;
use App\Http\Controllers\Petani\PetaniController;

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
            Route::get('/', [PenggunaAdminController::class, 'index'])->name('admin.pengguna.index');
            Route::get('/filter', [PenggunaAdminController::class, 'filter'])->name('admin.pengguna.filter');
            // Route::get('/show/{id}', [PenggunaAdminController::class, 'show'])->name('pengguna.show');
        });
        Route::prefix('stok-barang')->group(function () {
            Route::get('/', [StokBarangAdminController::class, 'index'])->name('admin.stok-barang.index');
            Route::get('/filter', [StokBarangAdminController::class, 'filter'])->name('admin.stok-barang.filter');
            Route::get('/show/{id}', [StokBarangAdminController::class, 'show'])->name('admin.stok-barang.show');
            Route::get('/create', [StokBarangAdminController::class, 'create'])->name('admin.stok-barang.create');
            Route::post('/store', [StokBarangAdminController::class, 'store'])->name('admin.stok-barang.store');
            Route::get('/edit/{id}', [StokBarangAdminController::class, 'edit'])->name('admin.stok-barang.edit');
            Route::put('/update/{id}', [StokBarangAdminController::class, 'update'])->name('admin.stok-barang.update');
            Route::delete('/destroy/{id}', [StokBarangAdminController::class, 'destroy'])->name('admin.stok-barang.destroy');
        });
        Route::prefix('permintaan-barang')->group(function () {
            Route::get('/', [PermintaanBarangAdminController::class, 'index'])->name('admin.permintaan-barang.index');
            Route::get('/filter', [PermintaanBarangAdminController::class, 'filter'])->name('admin.permintaan-barang.filter');
            // Route::get('/show/{id}', [PermintaanBarangAdminController::class, 'show'])->name('admin.permintaan-barang.show');
            Route::get('/distribusi/{id}', [PermintaanBarangAdminController::class, 'distribusi'])->name('admin.permintaan-barang.distribusi');
            Route::post('/distribusi/{id}', [PermintaanBarangAdminController::class, 'distribusiStore'])->name('admin.permintaan-barang.distribusi.store');
            Route::get('/create', [PermintaanBarangAdminController::class, 'create'])->name('admin.permintaan-barang.create');
            Route::post('/store', [PermintaanBarangAdminController::class, 'store'])->name('admin.permintaan-barang.store');
            Route::get('/edit/{id}', [PermintaanBarangAdminController::class, 'edit'])->name('admin.permintaan-barang.edit');
            Route::put('/update/{id}', [PermintaanBarangAdminController::class, 'update'])->name('admin.permintaan-barang.update');
            Route::delete('/destroy/{id}', [PermintaanBarangAdminController::class, 'destroy'])->name('admin.permintaan-barang.destroy');
        });

        Route::prefix('distribusi-barang')->group(function () {
            Route::get('/', [DistribusiBarangAdminController::class, 'index'])->name('admin.distribusi-barang.index');
            Route::get('/filter', [DistribusiBarangAdminController::class, 'filter'])->name('admin.distribusi-barang.filter');
            // Route::get('/{id}', [DistribusiBarangAdminController::class, 'show'])->name('admin.distribusi-barang.show');
            Route::put('/update-status/{id}', [DistribusiBarangAdminController::class, 'updateStatus'])->name('admin.distribusi-barang.update-status');
            Route::get('/create', [DistribusiBarangAdminController::class, 'create'])->name('admin.distribusi-barang.create');
            Route::post('/store', [DistribusiBarangAdminController::class, 'store'])->name('admin.distribusi-barang.store');
            Route::get('/edit/{id}', [DistribusiBarangAdminController::class, 'edit'])->name('admin.distribusi-barang.edit');
            Route::put('/update/{id}', [DistribusiBarangAdminController::class, 'update'])->name('admin.distribusi-barang.update');
            Route::delete('/destroy/{id}', [DistribusiBarangAdminController::class, 'destroy'])->name('admin.distribusi-barang.destroy');
        });
        Route::prefix('laporan')->group(function () {
            Route::get('/', [LaporanAdminController::class, 'index'])->name('admin.laporan.index');
            Route::get('/filter', [LaporanAdminController::class, 'filter'])->name('admin.laporan.filter');
            Route::get('/export', [LaporanAdminController::class, 'export'])->name('admin.laporan.export');
        });
    });
});

Route::middleware(['auth', 'role:gudang'])->group(function () {

    Route::prefix('gudang')->group(function () {
        Route::get('/', [GudangController::class, 'index'])->name('gudang.index');

        Route::prefix('stok-barang')->group(function () {
            Route::get('/', [StokBarangGudangController::class, 'index'])->name('gudang.stok-barang.index');
            Route::get('/filter', [StokBarangGudangController::class, 'filter'])->name('gudang.stok-barang.filter');
            Route::get('/create', [StokBarangGudangController::class, 'create'])->name('gudang.stok-barang.create');
            Route::post('/store', [StokBarangGudangController::class, 'store'])->name('gudang.stok-barang.store');
            Route::get('/edit/{id}', [StokBarangGudangController::class, 'edit'])->name('gudang.stok-barang.edit');
            Route::put('/update/{id}', [StokBarangGudangController::class, 'update'])->name('gudang.stok-barang.update');
            Route::delete('/destroy/{id}', [StokBarangGudangController::class, 'destroy'])->name('gudang.stok-barang.destroy');
        });

        Route::prefix('permintaan-barang')->group(function () {
            Route::get('/', [PermintaanBarangGudangController::class, 'index'])->name('gudang.permintaan-barang.index');
            Route::get('/filter', [PermintaanBarangGudangController::class, 'filter'])->name('gudang.permintaan-barang.filter');
            Route::get('/distribusi/{id}', [PermintaanBarangGudangController::class, 'distribusi'])->name('gudang.permintaan-barang.distribusi');
            Route::post('/distribusi/{id}', [PermintaanBarangGudangController::class, 'distribusiStore'])->name('gudang.permintaan-barang.distribusi.store');
            Route::get('/create', [PermintaanBarangGudangController::class, 'create'])->name('gudang.permintaan-barang.create');
            Route::post('/store', [PermintaanBarangGudangController::class, 'store'])->name('gudang.permintaan-barang.store');
            Route::get('/edit/{id}', [PermintaanBarangGudangController::class, 'edit'])->name('gudang.permintaan-barang.edit');
            Route::put('/update/{id}', [PermintaanBarangGudangController::class, 'update'])->name('gudang.permintaan-barang.update');
            Route::delete('/destroy/{id}', [PermintaanBarangGudangController::class, 'destroy'])->name('gudang.permintaan-barang.destroy');
        });

        Route::prefix('distribusi-barang')->group(function () {
            Route::get('/', [DistribusiBarangGudangController::class, 'index'])->name('gudang.distribusi-barang.index');
            Route::get('/filter', [DistribusiBarangGudangController::class, 'filter'])->name('gudang.distribusi-barang.filter');
            // Route::get('/show/{id}', [DistribusiBarangGudangController::class, 'show'])->name('gudang.distribusi-barang.show');
            Route::put('/update-status/{id}', [DistribusiBarangGudangController::class, 'updateStatus'])->name('gudang.distribusi-barang.update-status');
            Route::get('/create', [DistribusiBarangGudangController::class, 'create'])->name('gudang.distribusi-barang.create');
            Route::post('/store', [DistribusiBarangGudangController::class, 'store'])->name('gudang.distribusi-barang.store');
            Route::get('/edit/{id}', [DistribusiBarangGudangController::class, 'edit'])->name('gudang.distribusi-barang.edit');
            Route::put('/update/{id}', [DistribusiBarangGudangController::class, 'update'])->name('gudang.distribusi-barang.update');
            Route::delete('/destroy/{id}', [DistribusiBarangGudangController::class, 'destroy'])->name('gudang.distribusi-barang.destroy');
        });
    });
});

Route::middleware(['auth', 'role:distributor'])->group(function () {
    Route::prefix('distributor')->group(function () {
        Route::get('/', [DistributorController::class, 'index'])->name('distributor.index');

        Route::prefix('permintaan-barang')->group(function () {
            Route::get('/', [PermintaanBarangDistributorController::class, 'index'])->name('distributor.permintaan-barang.index');
            Route::get('/filter', [PermintaanBarangDistributorController::class, 'filter'])->name('distributor.permintaan-barang.filter');
        });
    });
});

Route::middleware(['auth', 'role:petani'])->group(function () {
    Route::prefix('petani')->group(function () {
        Route::get('/', [PetaniController::class, 'index']);
    });
});
