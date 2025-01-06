<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;

class DashboardController extends Controller
{
public function index(Request $request)
{
    // Validasi input opsional (jika ada filter pada dashboard)
    $request->validate([
        'tanggal_checkin' => 'nullable|date',
        'tanggal_checkout' => 'nullable|date|after:tanggal_checkin',
        'jumlah_tamu' => 'nullable|integer|min:1',
    ]);

    // Ambil data input (jika ada)
    $tanggalCheckin = $request->tanggal_checkin;
    $tanggalCheckout = $request->tanggal_checkout;
    $jumlahTamu = $request->jumlah_tamu;

    // Query dasar untuk kamar tersedia
    $query = Kamar::with('fasilitas')->where('status_kamar', 'Tersedia');

    // Tambahkan filter berdasarkan input (jika ada)
    if ($jumlahTamu) {
        $query->where('kapasitas_kamar', '>=', $jumlahTamu);
    }

    // Dapatkan data kamar tersedia
    $kamarTersedia = $query->get();

    // Return view dashboard dengan data yang difilter
    return view('dashboard', compact('kamarTersedia', 'tanggalCheckin', 'tanggalCheckout', 'jumlahTamu'));
}


    public function cariKamar(Request $request)
    {
        // Validasi input
        $request->validate([
            'checkin' => 'required|date|after:today',
            'checkout' => 'required|date|after:checkin',
        ], [
            'checkin.required' => 'Tanggal check-in wajib diisi.',
            'checkout.required' => 'Tanggal check-out wajib diisi.',
            'checkin.after' => 'Tanggal check-in harus lebih besar dari hari ini.',
            'checkout.after' => 'Tanggal check-out harus lebih besar dari tanggal check-in.',
        ]);

        $checkin = $request->input('checkin');
        $checkout = $request->input('checkout');
        $jumlahOrang = $request->input('jumlah_orang');

        // Cari kamar tersedia
        $kamarTersedia = Kamar::where('status_kamar', 'Tersedia')
            ->whereDoesntHave('detailReservasi', function ($query) use ($checkin, $checkout) {
                $query->whereHas('reservasi', function ($q) use ($checkin, $checkout) {
                    $q->where(function ($q2) use ($checkin, $checkout) {
                        $q2->whereBetween('tanggal_checkin', [$checkin, $checkout])
                           ->orWhereBetween('tanggal_checkout', [$checkin, $checkout])
                           ->orWhere(function ($q3) use ($checkin, $checkout) {
                               $q3->where('tanggal_checkin', '<=', $checkin)
                                  ->where('tanggal_checkout', '>=', $checkout);
                           });
                    });
                });
            })
            ->where('kapasitas_kamar', '>=', $jumlahOrang)
            ->get();

        // Jika tidak ada kamar yang tersedia
        if ($kamarTersedia->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada kamar yang tersedia pada tanggal yang dipilih.');
        }

        return view('dashboard', compact('kamarTersedia'));
    }
}