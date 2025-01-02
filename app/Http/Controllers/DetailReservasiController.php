<?php

namespace App\Http\Controllers;

use App\Models\DetailReservasi;
use App\Models\Reservasi;
use App\Models\Kamar;
use Illuminate\Http\Request;
use App\Models\Tamu;

class DetailReservasiController extends Controller
{
    /**
     * Menampilkan semua detail reservasi
     */
public function index(Request $request)
{
    $search = $request->input('search');
    
    // Mengambil data reservasi yang diurutkan berdasarkan tanggal check-in terbaru
    $reservasiDetail = Reservasi::with(['tamu', 'detailReservasi.kamar'])
        ->when($search, function($query, $search) {
            return $query->whereHas('tamu', function($q) use ($search) {
                $q->where('nama_tamu', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        })
        ->orderBy('tanggal_checkin', 'desc') // Mengurutkan berdasarkan tanggal check-in terbaru
        ->get();

    return view('detail_reservasi.index', compact('reservasiDetail', 'search'));
}


    /**
     * Menampilkan detail reservasi tertentu
     */
    public function show($id)
    {
        $detailReservasi = DetailReservasi::with('reservasi', 'kamar')->find($id);
        if (!$detailReservasi) {
            return response()->json(['message' => 'Detail reservasi tidak ditemukan'], 404);
        }
        return response()->json($detailReservasi);
    }

    /**
     * Membuat detail reservasi baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasi,id_reservasi',
            'id_kamar' => 'required|exists:kamars,id',
            'jumlah_hari' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        $detailReservasi = DetailReservasi::create([
            'id_reservasi' => $request->id_reservasi,
            'id_kamar' => $request->id_kamar,
            'jumlah_hari' => $request->jumlah_hari,
            'total_harga' => $request->total_harga
        ]);

        return response()->json($detailReservasi, 201);
    }

    /**
     * Mengupdate detail reservasi tertentu
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_reservasi' => 'required|exists:reservasi,id_reservasi',
            'id_kamar' => 'required|exists:kamars,id',
            'jumlah_hari' => 'required|integer',
            'total_harga' => 'required|numeric',
        ]);

        $detailReservasi = DetailReservasi::find($id);
        if (!$detailReservasi) {
            return response()->json(['message' => 'Detail reservasi tidak ditemukan'], 404);
        }

        $detailReservasi->update([
            'id_reservasi' => $request->id_reservasi,
            'id_kamar' => $request->id_kamar,
            'jumlah_hari' => $request->jumlah_hari,
            'total_harga' => $request->total_harga
        ]);

        return response()->json($detailReservasi);
    }

    /**
     * Menghapus detail reservasi
     */
public function destroy($id)
{
    $reservasi = Reservasi::with('detailReservasi')->findOrFail($id);

    // Hapus detail reservasi terkait
    $reservasi->detailReservasi()->delete();

    // Hapus reservasi
    $reservasi->delete();

    return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
}

}
