<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KamarController extends Controller
{
    public function index(Request $request)
    {
        $query = Kamar::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nomor_kamar', 'like', "%{$search}%")
                ->orWhere('jenis_kamar', 'like', "%{$search}%")
                ->orWhere('status_kamar', 'like', "%{$search}%");
        }

        $kamars = $query->paginate(100);

        return view('kamar.index', compact('kamars'));
    }


    public function create()
    {
        return view('kamar.create');
    }


    public function store(Request $request)
    {
        // Validasi form
        $validated = $request->validate([
            'nomor_kamar' => 'required|string|max:255|unique:kamars',
            'jenis_kamar' => 'required|string|max:255',
            'harga_per_malam' => 'required|numeric',
            'status_kamar' => 'required|string|max:255',
            'kapasitas_kamar' => 'required|integer',
            'gambar_kamar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        // Proses penyimpanan gambar
        $gambar_path = null;
        if ($request->hasFile('gambar_kamar')) {
            $gambar = $request->file('gambar_kamar');
            $gambar_path = $gambar->store('gambar_kamar', 'public'); 
        }

        // Simpan data kamar ke database
        Kamar::create([
            'nomor_kamar' => $validated['nomor_kamar'],
            'jenis_kamar' => $validated['jenis_kamar'],
            'harga_per_malam' => $validated['harga_per_malam'],
            'status_kamar' => $validated['status_kamar'],
            'kapasitas_kamar' => $validated['kapasitas_kamar'],
            'gambar_kamar' => $gambar_path, 
        ]);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil disimpan.');
    }


    public function edit($id)
    {
        $kamars = Kamar::findOrFail($id);  

        return view('kamar.edit', compact('kamars'));
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
