<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKamar;
use Illuminate\Http\Request;

class FasilitasKamarController extends Controller
{
    // Menampilkan daftar fasilitas
    public function index(Request $request)
    {
        $search = $request->get('search');
        $fasilitas = FasilitasKamar::when($search, function ($query, $search) {
            return $query->where('nama_fasilitas', 'like', '%' . $search . '%');
        })->get();

        return view('fasilitasKamar.index', compact('fasilitas'));
    }

    // Menampilkan form tambah fasilitas
    public function create()
    {
        return view('fasilitasKamar.create');
    }

    // Menyimpan fasilitas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
        ]);

        FasilitasKamar::create($request->all());

        return redirect()->route('fasilitaskamar.index')->with('success', 'Fasilitas kamar berhasil ditambahkan.');
    }

    // Menampilkan form edit fasilitas
    public function edit($id)
    {
        $fasilitas = FasilitasKamar::findOrFail($id);
        return view('fasilitasKamar.edit', compact('fasilitas'));
    }

    // Memperbarui fasilitas
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255',
        ]);

        $fasilitas = FasilitasKamar::findOrFail($id);
        $fasilitas->update($request->all());

        return redirect()->route('fasilitasKamar.index')->with('success', 'Fasilitas kamar berhasil diperbarui.');
    }

    // Menghapus fasilitas
    public function destroy($id)
    {
        $fasilitas = FasilitasKamar::findOrFail($id);
        $fasilitas->delete();

        return redirect()->route('fasilitasKamar.index')->with('success', 'Fasilitas kamar berhasil dihapus.');
    }
}
