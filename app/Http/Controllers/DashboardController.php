<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Tamu;

class DashboardController extends Controller
{
    public function index()
    {
    // Ambil kamar yang tersedia saja
    $kamarTersedia = Kamar::where('status_kamar', 'Tersedia')->with('fasilitas')->get();
    // Ambil tamu tertentu (misalnya tamu dengan ID tertentu)
    $tamu = Tamu::find(1); // Ganti "1" dengan ID tamu yang sesuai

    // Pastikan tamu ditemukan
    if (!$tamu) {
    return redirect()->back()->with('error', 'Tamu tidak ditemukan.');
    }

    return view('dashboard', compact('kamarTersedia', 'tamu'));
    }

public function cariKamar(Request $request)
{
    $checkin = $request->input('checkin');
    $checkout = $request->input('checkout');
    
    // Pastikan tanggal check-in dan check-out valid
    if (!$checkin || !$checkout) {
        return redirect()->back()->with('error', 'Tanggal check-in dan check-out wajib diisi');
    }
    
    // Mengambil semua kamar yang tersedia pada rentang tanggal check-in dan check-out
    $kamarTersedia = Kamar::whereDoesntHave('reservasi', function ($query) use ($checkin, $checkout) {
        $query->where(function ($q) use ($checkin, $checkout) {
            $q->whereBetween('checkin', [$checkin, $checkout])
              ->orWhereBetween('checkout', [$checkin, $checkout])
              ->orWhere(function ($q2) use ($checkin, $checkout) {
                  $q2->where('checkin', '<=', $checkin)
                      ->where('checkout', '>=', $checkout);
              });
        });
    })->get();

    return view('dashboard', compact('kamarTersedia'));
}



}


