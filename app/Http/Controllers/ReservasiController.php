<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;
use App\Models\kamar;
use App\Models\Reservasi;
use App\Models\DetailReservasi;

class ReservasiController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search', '');

    // Jika ada pencarian, ambil data tamu
    $tamus = [];
    if ($search) {
        $tamus = \App\Models\Tamu::where('nama_tamu', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->get();
    }

    // Kirim data ke view
    return view('reservasi.index', compact('tamus', 'search'));
}




    public function show($id)
    {
        // Cari reservasi berdasarkan ID
        $reservasi = Reservasi::findOrFail($id);

        // Tampilkan view dengan data reservasi
        return view('reservasi.show', compact('reservasi'));
    }

    public function create($id_tamu)
    {
    // Cari data tamu berdasarkan ID
    $tamu = \App\Models\Tamu::findOrFail($id_tamu);

    // Tampilkan view untuk membuat reservasi baru
    return view('reservasi.create', compact('tamu'));
    }


    

    public function pilihKamar(Request $request, $id_tamu)
    {
        $tamu = Tamu::findOrFail($id_tamu);
    
        $kamarTersedia = Kamar::with('fasilitas')
            ->where('status_kamar', 'Available')
            ->get();
    
        return view('reservasi.pilih-kamar', [
            'tamu' => $tamu,
            'kamarTersedia' => $kamarTersedia,
            'tanggalCheckin' => $request->input('tanggal_checkin', now()->toDateString()),
            'tanggalCheckout' => $request->input('tanggal_checkout', now()->addDays(1)->toDateString()),
        ]);
    }
    


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_tamu' => 'required|exists:tamus,id_tamu',
            'id_kamars' => 'required|array',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'total_harga' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);
    
        // Menyimpan data reservasi ke tabel reservasi
        $reservasi = Reservasi::create([
            'id_tamu' => $request->id_tamu,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'total_harga' => $request->total_harga,
            'metode_pembayaran' => $request->payment_method,
        ]);
    
        // Menghitung jumlah hari menginap
        $tanggalCheckin = new \DateTime($request->tanggal_checkin);
        $tanggalCheckout = new \DateTime($request->tanggal_checkout);
        $jumlahHari = $tanggalCheckin->diff($tanggalCheckout)->days;
    
        // Menyimpan data detail kamar yang dipilih dan mengubah status kamar menjadi tidak tersedia
        foreach ($request->id_kamars as $id_kamar) {
            // Simpan detail reservasi kamar
            DetailReservasi::create([
                'id_reservasi' => $reservasi->id_reservasi,
                'id_kamar' => $id_kamar,
                'jumlah_hari' => $jumlahHari,
            ]);
    
            // Perbarui status kamar menjadi tidak tersedia
            $kamar = Kamar::find($id_kamar);
            if ($kamar) {
                $kamar->status_kamar = 'tidak tersedia'; 
                $kamar->save();
            }
        }
    
    
        return redirect()->route('payment.result')->with('success', 'Reservasi berhasil dibuat!');
    }



public function filterKamar(Request $request)
{
    $request->validate([
        'id_tamu' => 'required|exists:tamus,id_tamu',
        'tanggal_checkin' => 'required|date',
        'tanggal_checkout' => 'required|date|after:tanggal_checkin',
        'jumlah_tamu' => 'required|integer|min:1',
    ]);

    $tamu = Tamu::findOrFail($request->id_tamu); // Pastikan id_tamu valid
    $tanggalCheckin = $request->tanggal_checkin;
    $tanggalCheckout = $request->tanggal_checkout;
    $jumlahTamu = $request->jumlah_tamu;

    // Filter kamar tersedia
    $kamarTersedia = Kamar::with('fasilitas')
        ->where('kapasitas_kamar', '>=', $jumlahTamu)
        ->where('status_kamar', 'Tersedia')
        ->get();

    return view('reservasi.pilih-kamar', compact('tamu', 'kamarTersedia', 'tanggalCheckin', 'tanggalCheckout', 'jumlahTamu'));
}




public function checkout(Request $request)
{
    // Validasi input
    $request->validate([
        'id_tamu' => 'required|exists:tamus,id_tamu',
        'id_kamars' => 'required|array',
        'tanggal_checkin' => 'required|date',
        'tanggal_checkout' => 'required|date|after:tanggal_checkin',
    ]);

    // Ambil data tamu
    $tamu = \App\Models\Tamu::findOrFail($request->id_tamu);

    // Ambil data kamar
    $kamars = \App\Models\Kamar::whereIn('id', $request->id_kamars)->get();

    // Hitung total harga
    $jumlahHari = (new \DateTime($request->tanggal_checkin))
        ->diff(new \DateTime($request->tanggal_checkout))->days;

    $totalHarga = $kamars->sum(fn($kamar) => $kamar->harga_per_malam * $jumlahHari);

    // Kirim data ke view checkout
    return view('reservasi.checkout', [
        'tamu' => $tamu,
        'tanggalCheckin' => $request->tanggal_checkin,
        'tanggalCheckout' => $request->tanggal_checkout,
        'jumlahTamu' => $request->jumlah_tamu,
        'kamars' => $kamars,
        'totalHarga' => $totalHarga,
    ]);
}






public function showCheckout()
{
    // Ambil data dari session
    $data = session('checkout_data');

    if (!$data) {
        return redirect()->route('reservasi.index')->with('error', 'Data checkout tidak ditemukan.');
    }

    // Ambil data tamu dan kamar
    $tamu = Tamu::findOrFail($data['id_tamu']);
    $kamars = Kamar::whereIn('id', $data['id_kamars'])->get();

    // Hitung total harga
    $jumlahHari = (new \DateTime($data['tanggal_checkin']))->diff(new \DateTime($data['tanggal_checkout']))->days;
    $totalHarga = $kamars->sum(fn($kamar) => $kamar->harga_per_malam * $jumlahHari);

    return view('reservasi.checkout', [
        'tamu' => $tamu,
        'tanggalCheckin' => $data['tanggal_checkin'],
        'tanggalCheckout' => $data['tanggal_checkout'],
        'jumlahTamu' => $data['jumlah_tamu'],
        'kamars' => $kamars,
        'totalHarga' => $totalHarga,
    ]);
}





}
