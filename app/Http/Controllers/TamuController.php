<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamu;

class TamuController extends Controller
{
    public function index(Request $request)
    {
        $query = Tamu::query();

        // Pencarian berdasarkan nama, nomor telepon, dan email
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama_tamu', 'like', "%{$search}%")
                ->orWhere('no_telp', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        }

        // Mengambil data tamu dengan pagination (10 data per halaman)
        $tamus = $query->paginate(10);  // Gunakan paginate() untuk menghasilkan paginator

        return view('tamu.index', compact('tamus'));
    }



    public function create()
    {
        return view('tamu.create');
    }

    public function store(Request $request)
    {
        Tamu::create($request->all());
        return redirect()->route('tamu.index')->with('success', 'Data Tamu berhasil ditambahkan');
    }

    public function show($id)
    {
    $tamu = Tamu::where('id_tamu', $id)->first();
    return view('tamu.show', compact('tamu'));
    }

    public function edit($id_tamu)
    {
        $tamus = Tamu::findOrFail($id_tamu); // Mencari tamu berdasarkan id_tamu
        return view('tamu.edit', compact('tamus')); // Mengirim data tamu ke view edit
    }


    public function update(Request $request, $id_tamu)
    {
        $tamus = Tamu::findOrFail($id_tamu); // Mencari tamu berdasarkan id_tamu
        $tamus->update($request->all()); // Melakukan pembaruan data dengan data yang diterima dari form

        return redirect()->route('tamu.index')->with('success', 'Data Tamu berhasil diupdate');
    }



    public function destroy($id_tamu)
    {
        $tamus = Tamu::findOrFail($id_tamu); // Menggunakan id_tamu, bukan id
        $tamus->delete();
        return redirect()->route('tamu.index')->with('success', 'Data Tamu berhasil dihapus');
    }



}

