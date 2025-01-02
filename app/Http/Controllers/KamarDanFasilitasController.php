<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\FasilitasKamar;
use Illuminate\Http\Request;

class KamarDanFasilitasController extends Controller
{
    public function index(Request $request)
    {
        $jenisKamar = $request->input('jenis_kamar');

        // Ambil data kamar, dengan atau tanpa filter
        $kamars = Kamar::with('fasilitas')
            ->when($jenisKamar, function ($query) use ($jenisKamar) {
                $query->where('jenis_kamar', $jenisKamar);
            })
            ->get();

        // Return ke view
        return view('kamardanfasilitas.index', compact('kamars'));
    }


    public function create()
    {
        $kamars = Kamar::all();
        $fasilitasKamars = FasilitasKamar::all();
        return view('KamarDanFasilitas.create', compact('kamars', 'fasilitasKamars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|string|max:255',
            'jenis_kamar' => 'required|string|max:255',
            'fasilitas_kamar' => 'required|array|min:1',
            'fasilitas_kamar.*' => 'exists:fasilitas_kamars,id_fasilitas_kamar',
        ]);

        $kamar = Kamar::create($request->only('nomor_kamar', 'jenis_kamar'));
        $kamar->fasilitas()->sync($request->fasilitas_kamar);

        return redirect()->route('kamardanfasilitas.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kamar = Kamar::findOrFail($id);
        $fasilitasKamar = FasilitasKamar::all();
        $fasilitasKamarTerpilih = $kamar->fasilitas->pluck('id_fasilitas_kamar')->toArray();

        return view('KamarDanFasilitas.edit', compact('kamar', 'fasilitasKamar', 'fasilitasKamarTerpilih'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fasilitas_kamar' => 'required|array|min:1',
            'fasilitas_kamar.*' => 'exists:fasilitas_kamars,id_fasilitas_kamar',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($request->only('nomor_kamar', 'jenis_kamar'));
        $kamar->fasilitas()->sync($request->fasilitas_kamar);

        return redirect()->route('kamardanfasilitas.index')->with('success', 'Kamar berhasil diperbarui.');
    }
}
