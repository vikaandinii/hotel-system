@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
<div class="relative">
    <!-- Latar belakang dengan efek blur -->
    <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('/images/tamu-bg.jpg');"></div>

    <!-- Kontainer Form Fasilitas Kamar -->
    <div class="relative container mx-auto mt-12 p-8 rounded-lg shadow-lg max-w-2xl bg-white bg-opacity-85">
        <!-- Pesan Sukses -->
        @if(session('success'))
            <div class="success-message bg-green-500 text-white p-4 mb-6 rounded-lg text-center">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-3xl font-semibold text-center text-brown-700 mb-6">Daftar Fasilitas Kamar</h2>

        <!-- Tombol Tambah Fasilitas -->
        <div class="mb-6 text-center">
            <a href="{{ route('fasilitas_kamar.create') }}" class="px-6 py-3 bg-brown-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                Tambah Fasilitas
            </a>
        </div>

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('fasilitas_kamar.index') }}" class="mb-6">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari fasilitas..." class="px-4 py-3 border border-gray-300 rounded-md w-full focus:ring-2 focus:ring-brown-500 transition">
            <button type="submit" class="mt-4 px-6 py-3 bg-brown-600 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700 focus:outline-none focus:ring-2 focus:ring-brown-500 transition">
                Cari
            </button>
        </form>

        <!-- Tabel Daftar Fasilitas Kamar -->
        <table class="w-full table-auto border-collapse">
            <thead>
                <tr class="bg-brown-100">
                    <th class="border px-4 py-2 text-left">Nama Fasilitas</th>
                    <th class="border px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fasilitas as $fasilitasItem)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $fasilitasItem->nama_fasilitas }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('fasilitas_kamar.edit', $fasilitasItem->id_fasilitas_kamar) }}" class="text-brown-600 hover:text-brown-800 transition">Edit</a> | 
                            <form action="{{ route('fasilitas_kamar.destroy', $fasilitasItem->id_fasilitas_kamar) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="border px-4 py-2 text-center text-gray-500">Tidak ada fasilitas ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
