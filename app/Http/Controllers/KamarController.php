<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    // Menampilkan daftar kamar dengan pencarian dan pagination
    public function index(Request $request)
    {
        $query = Kamar::query();

        // Jika ada pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nomor_kamar', 'like', "%{$search}%")
                ->orWhere('jenis_kamar', 'like', "%{$search}%")
                ->orWhere('status_kamar', 'like', "%{$search}%");
        }

        // Menggunakan pagination
        $kamars = $query->paginate(10); // Menampilkan 10 data per halaman

        return view('kamar.index', compact('kamars'));
    }

    // Menampilkan form untuk menambah kamar baru
    public function create()
    {
        return view('kamar.create');
    }

    // Menyimpan data kamar baru
    public function store(Request $request)
    {
        // Validasi form
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:255|unique:kamars',
            'jenis_kamar' => 'required|string|max:255',
            'harga_per_malam' => 'required|numeric',
            'status_kamar' => 'required|string|max:255',
            'kapasitas_kamar' => 'required|integer',
            'gambar_kamar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi gambar
        ]);

        // Proses penyimpanan gambar
        if ($request->hasFile('gambar_kamar')) {
            $gambar = $request->file('gambar_kamar');
            $gambar_path = $gambar->store('public/gambar_kamar'); // Menyimpan gambar di folder public/gambar_kamar
        } else {
            $gambar_path = null;
        }

        // Simpan data kamar ke database
        Kamar::create([
            'nomor_kamar' => $validated['nomor_kamar'],
            'jenis_kamar' => $validated['jenis_kamar'],
            'harga_per_malam' => $validated['harga_per_malam'],
            'status_kamar' => $validated['status_kamar'],
            'kapasitas_kamar' => $validated['kapasitas_kamar'],
            'gambar_kamar' => $gambar_path, // Menyimpan path gambar
        ]);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil disimpan.');
    }

    public function edit($id)
    {
        // If using the default 'id' as primary key
        $kamars = Kamar::findOrFail($id);  // Find the record by id

        // If using 'id_kamar' as primary key
        // $kamar = Kamar::where('id_kamar', $id)->firstOrFail();

        return view('kamar.edit', compact('kamars'));
    }

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class);
    }

    public function update(Request $request, $id_kamar)
    {
        // Validasi input
        $request->validate([
            'nomor_kamar' => 'required|string|max:255',
            'jenis_kamar' => 'required|string',
            'harga_per_malam' => 'required|numeric',
            'status_kamar' => 'required|string',
            'gambar_kamar' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $kamar = Kamar::findOrFail($id_kamar);

        // Mengupdate data kamar
        $kamar->nomor_kamar = $request->input('nomor_kamar');
        $kamar->jenis_kamar = $request->input('jenis_kamar');
        $kamar->harga_per_malam = $request->input('harga_per_malam');
        $kamar->status_kamar = $request->input('status_kamar');

        // Menangani file gambar kamar (jika ada)
        if ($request->hasFile('gambar_kamar')) {
            // Hapus gambar lama jika ada
            if ($kamar->gambar_kamar) {
                Storage::delete('public/' . $kamar->gambar_kamar);
            }

            // Simpan gambar baru
            $path = $request->file('gambar_kamar')->store('kamars', 'public');
            $kamar->gambar_kamar = $path;
        }

        $kamar->save();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui');
    }


    // Menghapus data kamar
    public function destroy($id)
    {
        $kamars = Kamar::findOrFail($id);

        // Hapus gambar dari storage
        if ($kamars->gambar_kamar) {
            Storage::disk('public')->delete($kamars->gambar_kamar);
        }

        // Hapus data kamar
        $kamars->delete();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus!');
    }
}
