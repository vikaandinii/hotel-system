@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
<div class="relative">
    <!-- Latar belakang dengan efek blur -->
    <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('{{ asset('images/tamu-bg.jpg') }}'); height: 100vh;"></div>

    <!-- Kontainer Form Fasilitas Kamar -->
    <div class="relative container mx-auto mt-12 p-8 rounded-lg shadow-lg max-w-2xl bg-white bg-opacity-85">
        <!-- Pesan Sukses -->
        @if(session('success'))
            <div class="success-message bg-green-500 text-white p-4 mb-6 rounded-lg text-center">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-3xl font-semibold text-center text-brown-700 mb-6">Tambah Fasilitas Kamar</h2>

        <!-- Form Tambah Fasilitas -->
        <form action="{{ route('fasilitas_kamar.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Nama Fasilitas -->
            <div>
                <label for="nama_fasilitas" class="block text-sm font-medium text-brown-600">Nama Fasilitas</label>
                <input type="text" name="nama_fasilitas" id="nama_fasilitas" 
                       class="mt-2 px-4 py-3 border border-gray-300 rounded-md w-full focus:ring-2 focus:ring-brown-500 focus:border-brown-500"
                       placeholder="Masukkan nama fasilitas" required>
            </div>

            <!-- Tombol Submit -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('fasilitas_kamar.index') }}" class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-brown-600 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700 focus:outline-none focus:ring-2 focus:ring-brown-500 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
