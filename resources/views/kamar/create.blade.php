@extends('layouts.app')

@section('content')
<div class="relative">
    <!-- Latar belakang dengan efek blur dan posisi tetap -->
    <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('{{ asset('images/tamu-bg.jpg') }}'); position: fixed; top: 0; left: 0; height: 100vh; width: 100%; z-index: -1;"></div>

    <!-- Kontainer Form Tambah Kamar -->
    <div class="relative container mx-auto mt-12 p-8 rounded-lg shadow-lg max-w-2xl bg-white bg-opacity-85">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Tambah Kamar</h2>

        <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nomor Kamar -->
            <div class="mb-6">
                <label for="nomor_kamar" class="block text-gray-700 font-semibold mb-2">Nomor Kamar</label>
                <input type="text" id="nomor_kamar" name="nomor_kamar" value="{{ old('nomor_kamar') }}" class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Masukkan nomor kamar" required>
            </div>

            <!-- Jenis Kamar -->
            <div class="mb-6">
                <label for="jenis_kamar" class="block text-gray-700 font-semibold mb-2">Jenis Kamar</label>
                <select id="jenis_kamar" name="jenis_kamar" class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
                    <option value="ekonomi" {{ old('jenis_kamar') == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                    <option value="standard" {{ old('jenis_kamar') == 'standard' ? 'selected' : '' }}>Standard</option>
                    <option value="vip" {{ old('jenis_kamar') == 'vip' ? 'selected' : '' }}>VIP</option>
                </select>
            </div>

            <!-- Harga per Malam -->
            <div class="mb-6">
                <label for="harga_per_malam" class="block text-gray-700 font-semibold mb-2">Harga per Malam (Rp)</label>
                <input type="number" id="harga_per_malam" name="harga_per_malam" value="{{ old('harga_per_malam') }}" class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" placeholder="Masukkan harga per malam" required>
            </div>

            <!-- Status Kamar -->
            <div class="mb-6">
                <label for="status_kamar" class="block text-gray-700 font-semibold mb-2">Status Kamar</label>
                <select id="status_kamar" name="status_kamar" class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
                    <option value="Tersedia" {{ old('status_kamar') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Dipesan" {{ old('status_kamar') == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                </select>
            </div>

            <!-- Kapasitas Kamar -->
            <div class="mb-6">
                <label for="kapasitas_kamar" class="block text-gray-700 font-semibold mb-2">Kapasitas Kamar</label>
                <select id="kapasitas_kamar" name="kapasitas_kamar" class="w-full px-4 py-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
                    <option value="1" {{ old('kapasitas_kamar') == '1' ? 'selected' : '' }}>1 Orang Dewasa</option>
                    <option value="2" {{ old('kapasitas_kamar') == '2' ? 'selected' : '' }}>2 Orang Dewasa dan 1 Anak</option>
                    <option value="4" {{ old('kapasitas_kamar') == '4' ? 'selected' : '' }}>4 Orang Dewasa</option>
                </select>
            </div>

            <!-- Input Gambar Kamar -->
            <div class="mb-6">
                <label for="gambar_kamar" class="block text-gray-700 font-semibold mb-2">Gambar Kamar</label>
                <input type="file" id="gambar_kamar" name="gambar_kamar" class="w-full p-2 border border-gray-300 rounded-md mt-1" accept="image/*" required>
            </div>

            <!-- Button Submit -->
            <div class="flex justify-center mt-8">
                <button type="submit" class="px-6 py-3 bg-[#964B00] text-white font-semibold rounded-lg shadow-md hover:bg-[#7f3e00] focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Simpan Kamar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
