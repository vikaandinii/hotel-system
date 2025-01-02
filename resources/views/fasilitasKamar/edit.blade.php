@extends('layouts.app')

@section('content')
<div class="relative">
    <!-- Latar belakang dengan efek blur -->
    <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('{{ asset('images/tamu-bg.jpg') }}'); height: 100vh;"></div>

    <!-- Kontainer Form Fasilitas Kamar -->
    <div class="relative container mx-auto mt-12 p-8 rounded-lg shadow-lg max-w-2xl bg-white bg-opacity-85">
        <!-- Pesan Kesalahan -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Terjadi Kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h2 class="text-3xl font-semibold text-center text-brown-700 mb-6">Edit Fasilitas Kamar</h2>

        <form action="{{ route('fasilitaskamar.update', $fasilitas->id_fasilitas_kamar) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Fasilitas -->
            <div>
                <label for="nama_fasilitas" class="block text-sm font-medium text-brown-600">Nama Fasilitas</label>
                <input type="text" id="nama_fasilitas" name="nama_fasilitas" 
                    value="{{ old('nama_fasilitas', $fasilitas->nama_fasilitas) }}" 
                    class="mt-2 px-4 py-3 border border-gray-300 rounded-md w-full focus:ring-2 focus:ring-brown-500">
            </div>

            <!-- Tombol Submit dan Batal -->
            <div class="flex items-center justify-end space-x-4">
                <a href="{{ route('fasilitaskamar.index') }}" class="px-6 py-3 bg-gray-300 text-gray-700 font-semibold rounded-lg shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 bg-brown-600 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700 focus:outline-none focus:ring-2 focus:ring-brown-500 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
