
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KamarDanFasilitasController;
use App\Http\Controllers\DetailReservasiController;
use App\Http\Controllers\PaymentController;




Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tamu', TamuController::class);
Route::resource('kamar', KamarController::class);
Route::resource('fasilitaskamar', FasilitasKamarController::class);
Route::resource('fasilitas_kamar', FasilitasKamarController::class);
Route::resource('reservasi', ReservasiController::class);
Route::resource('KamarDanFasilitas', KamarDanfasilitasController::class);
Route::resource('kamar-dan-fasilitas', KamarDanFasilitasController::class);
Route::resource('kamardanfasilitas', KamarDanFasilitasController::class);
Route::resource('detail_reservasi', DetailReservasiController::class);
Route::resource('kamar', KamarController::class)->parameters(['kamar' => 'id_kamar']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');




Route::get('/kamar/search', [KamarController::class, 'search'])->name('kamar.search');
Route::get('/dashboard/cari-kamar', [DashboardController::class, 'cariKamar'])->name('dashboard.cariKamar');
Route::get('fasilitasKamar', [FasilitasKamarController::class, 'index'])->name('fasilitasKamar.index');
Route::get('/fasilitaskamar/{id}/edit', [FasilitasKamarController::class, 'edit'])->name('fasilitaskamar.edit');
Route::get('/kamar/{id}/edit', [KamarController::class, 'edit'])->name('kamar.edit');
Route::get('/fasilitas', [FasilitasKamarController::class, 'index'])->name('fasilitas.index');
Route::get('/fasilitas/create', [FasilitasKamarController::class, 'create'])->name('fasilitas.create');
Route::get('/fasilitas/{fasilitas_kamar}/edit', [FasilitasKamarController::class, 'edit'])->name('fasilitas.edit');
Route::get('/dashboard/cari', [DashboardController::class, 'cariKamar'])->name('dashboard.cariKamar');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/reservasi/{id}', [ReservasiController::class, 'showDetail'])->name('reservasi.showDetail');
Route::get('/detail-reservasi', [DetailReservasiController::class, 'index'])->name('detailReservasi.index');

Route::get('/dashboard/cari-kamar', [DashboardController::class, 'cariKamar'])->name('dashboard.cariKamar');



Route::put('/kamar/{id_kamar}', [KamarController::class, 'update'])->name('kamar.update');
Route::put('/fasilitas/{fasilitas_kamar}', [FasilitasKamarController::class, 'update'])->name('fasilitas.update');
Route::put('/kamardanfasilitas/{id}', [KamarDanFasilitasController::class, 'update'])->name('kamardanfasilitas.update');



Route::post('/fasilitas_kamar', [FasilitasKamarController::class, 'store'])->name('fasilitas_kamar.store');


Route::delete('/fasilitas/{fasilitas_kamar}', [FasilitasKamarController::class, 'destroy'])->name('fasilitas.destroy');
Route::delete('/tamu/{id_tamu}', [TamuController::class, 'destroy'])->name('tamu.destroy');



Route::post('/reservasi/checkout', [ReservasiController::class, 'checkout'])->name('reservasi.checkout');
Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');
Route::get('/reservasi/create/{id_tamu}', [ReservasiController::class, 'create'])->name('reservasi.create');
Route::post('/reservasi/store', [ReservasiController::class, 'store'])->name('reservasi.store');
Route::get('/reservasi/cari-kamar', [ReservasiController::class, 'cariKamar'])->name('reservasi.cariKamar');
Route::post('/reservasi/filter-kamar', [ReservasiController::class, 'filterKamar'])->name('reservasi.filterKamar');
Route::get('/checkout/show', [ReservasiController::class, 'showCheckout'])->name('reservasi.showCheckout');
Route::get('/tamu/{id_tamu}', [ReservasiController::class, 'getTamu'])->name('tamu.show');
Route::post('/checkout', [PaymentController::class, 'store'])->name('checkout.store');

Route::post('/checkout/simulate', [PaymentController::class, 'simulatePayment'])->name('checkout.simulate');
Route::post('/payment/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
Route::get('/checkout/print-receipt', [PaymentController::class, 'printReceipt'])->name('checkout.printReceipt');
Route::get('/receipt/print', [PaymentController::class, 'printReceipt'])->name('receipt.print');
// Route untuk menyimpan data reservasi dan metode pembayaran
Route::post('/checkout', [PaymentController::class, 'store'])->name('checkout.store');

// Route untuk menampilkan hasil pembayaran (hasil simulasi)
Route::get('/checkout/result', [PaymentController::class, 'result'])->name('checkout.result');
// Route untuk menampilkan halaman result pembayaran
Route::get('/payment/result', [PaymentController::class, 'result'])->name('payment.result');

Route::post('/checkout', [ReservasiController::class, 'store'])->name('checkout.store');
Route::get('/payment/result', [PaymentController::class, 'result'])->name('payment.result');




require __DIR__.'/auth.php';
