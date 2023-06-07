<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PropertiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\InfoController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['namespace' => 'App\Http\Controllers'], function()
{  
    Route::group(['middleware' => ['guest']], function() {
        /**
         * Login Routes
         */
        Route::get('/', 'LoginController@show')->name('login.show');
        Route::post('/', 'LoginController@login')->name('login.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        Route::prefix('salon')->group(function(){
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
            Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
            Route::get('/info', [InfoController::class, 'salonInfo'])->name('info');
            Route::get('/barang', [BarangController::class, 'salonBarang'])->name('barang');
            Route::get('/properti', [PropertiController::class, 'salonProperti'])->name('properti');
            Route::get('/penjualan', [PenjualanController::class, 'salonPenjualan'])->name('penjualan');
            Route::get('/pegawai', 'PegawaiController@salonPegawai')->name('pegawai');
            Route::get('/penjualan/detail/{id}', [PenjualanController::class, 'detailPenjualan'])->name('penjualan.detail');
            Route::get('/transaksi', [TransaksiController::class, 'salonTransaksi'])->name('transaksi');
            Route::get('/register', 'RegisterController@show')->name('register.show');
        });
        
        /**
         * Register Routes
         */
        Route::post('/register', 'RegisterController@register')->name('register.perform');
        Route::post('/profile/change', 'RegisterController@changeProfile')->name('profile.perform');
        Route::post('/info/change', 'InfoController@changeInfo')->name('info.perform');

        Route::get('/find-type/{type}', [PropertiController::class, 'findType'])->name('find-type');
        Route::get('/find-barang/{jenis}', [PropertiController::class, 'findBarang'])->name('find-barang');
        Route::get('/find-barang/harga/{id}', [PropertiController::class, 'findBarangId'])->name('find-barang-id');
        
        Route::delete('/hapus-img/{id}/barang', [BarangController::class, 'destroyImg'])->name('hapus-img.barang');
        Route::delete('/hapus-img/{id}/pegawai', [PegawaiController::class, 'destroyImg'])->name('hapus-img.pegawai');
        Route::delete('/hapus-img/{id}/icon', [InfoController::class, 'destroyImgIcon'])->name('hapus-img.icon');
        Route::delete('/hapus-img/{id}/login', [InfoController::class, 'destroyImgLogin'])->name('hapus-img.login');        
        Route::delete('/hapus-notif/{id}/barang', [BarangController::class, 'destroyNotif'])->name('hapus-notif.barang');
        
        Route::get('/save-penjualan', [TransaksiController::class, 'savePenjualan'])->name('save.penjualan');
        Route::get('/reset-keranjang', [TransaksiController::class, 'resetKeranjang'])->name('reset.keranjang');
        Route::get('/cetak-keranjang/{bayar}/{kembalian}', [TransaksiController::class, 'cetakKeranjang'])->name('cetak.keranjang');
        Route::get('/cetak-penjualan/{dari}/{sampai}/{opsi}', [PenjualanController::class, 'cetakPenjualan'])->name('cetak.penjualan');
        Route::get('/cetak-barang/{dari}/{sampai}/{opsi}', [BarangController::class, 'cetakBarang'])->name('cetak.barang');
        Route::get('/cetak-pegawai/{dari}/{sampai}/{opsi}', [PegawaiController::class, 'cetakPegawai'])->name('cetak.pegawai');
        
        Route::resource('ajax-barang', BarangController::class);
        Route::resource('ajax-pegawai', PegawaiController::class);
        Route::resource('ajax-properti', PropertiController::class);
        Route::resource('ajax-penjualan', PenjualanController::class);
        Route::resource('ajax-transaksi', TransaksiController::class);

        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });

});