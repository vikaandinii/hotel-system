@extends('layouts.app')
@vite('resources/css/app.css')

@section('title', 'Halaman Kamar')
@section('content')
<div class="relative">
    <!-- Latar belakang dengan gambar yang tetap di tempat saat di-scroll -->
    <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('{{ asset('images/tamu-bg.jpg') }}'); background-attachment: fixed; background-position: center; background-size: cover; height: 100%;"></div>

    <!-- Kontainer Daftar Kamar -->
    <div class="relative container mx-auto mt-12 p-8 rounded-lg shadow-lg max-w-6xl bg-white bg-opacity-85">
        <!-- Tombol Tambah Kamar -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-brown-800">Daftar Kamar Hotel</h2>
            <a href="{{ route('kamar.create') }}" class="px-6 py-3 bg-brown-600 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700 focus:outline-none focus:ring-2 focus:ring-brown-500">
                Menambah Kamar
            </a>
        </div>

        <!-- Form Pencarian Kamar -->
        <form method="GET" action="{{ route('kamar.index') }}" class="mb-6">
            <div class="flex items-center">
                <input type="text" name="search" class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brown-500" placeholder="Cari kamar berdasarkan nomor, jenis, atau status" value="{{ request()->query('search') }}">
                <button type="submit" class="ml-4 px-6 py-3 bg-brown-600 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700 focus:outline-none focus:ring-2 focus:ring-brown-500">
                    Cari
                </button>
            </div>
        </form>

        <!-- Daftar Kamar -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($kamars as $kamar)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Menampilkan gambar kamar -->
                <div class="gambar-kamar mt-4">
                    <img src="{{ $kamar->gambar_kamar ? asset('storage/' . $kamar->gambar_kamar) : asset('images/default.jpg') }}" alt="Gambar Kamar" class="w-full h-64 object-cover mb-4 rounded-md">
                </div>

                <!-- Info Kamar -->
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-brown-800">Nomor Kamar: {{ $kamar->nomor_kamar }}</h3>
                    <p class="text-gray-600">Jenis Kamar: {{ ucfirst($kamar->jenis_kamar) }}</p>
                    <p class="text-gray-600">Harga per Malam: Rp {{ number_format($kamar->harga_per_malam, 2, ',', '.') }}</p>
                    <p class="text-gray-600">Status: {{ ucfirst($kamar->status_kamar) }}</p>

                    <!-- Tindakan -->
                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('kamar.edit', $kamar->id) }}" class="text-brown-600 hover:text-brown-700 transition">Edit</a>
                        <form action="{{ route('kamar.destroy', $kamar->id) }}" method="POST" class="inline-block ml-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 transition">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $kamars->links() }} <!-- Menampilkan link paginasi -->
        </div>

    </div>
</div>
@endsection
