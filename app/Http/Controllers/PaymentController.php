<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\DetailReservasi;
use App\Models\Kamar;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_tamu' => 'required|exists:tamus,id_tamu',
            'id_kamars' => 'required|array', 
            'tanggal_checkin' => 'required|date_format:Y-m-d H:i:s', 
            'tanggal_checkout' => 'required|date_format:Y-m-d H:i:s|after:tanggal_checkin',
            'total_harga' => 'required|numeric',  
            'metode_pembayaran' => 'required|string',
        ]);
    
        // Simulate storing the data
        $reservasi = Reservasi::create([
            'id_tamu' => $request->id_tamu,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'total_harga' => $request->total_harga,
            'metode_pembayaran' => $request->payment_method,
        ]);
    
        // Redirect ke halaman hasil pembayaran dengan data yang dikirim.
    return redirect()->route('payment.result', [
        'paymentMethod' => $request->payment_method,
        'totalHarga' => $request->total_harga,
    ]);
    }
    

    public function result(Request $request)
    {
        // Ambil data dari request
        $paymentMethod = $request->paymentMethod;
        $totalHarga = $request->totalHarga;


        // Kirim data ke view untuk ditampilkan
        return view('payment.result', compact('paymentMethod', 'totalHarga'));
    }




public function printReceipt()
{
    // Ambil data dari session yang sudah disimpan sebelumnya
    $tamu = session('tamu');
    $tanggalCheckin = session('tanggalCheckin');
    $tanggalCheckout = session('tanggalCheckout');
    $jumlahTamu = session('jumlahTamu');
    $paymentMethod = session('payment_method');
    $totalHarga = session('totalHarga');

    // Kirim data ke view receipt
    return view('payment.receipt', compact('tamu', 'tanggalCheckin', 'tanggalCheckout', 'jumlahTamu', 'paymentMethod', 'totalHarga'));
}

    
}
