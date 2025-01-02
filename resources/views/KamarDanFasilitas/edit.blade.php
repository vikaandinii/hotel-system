@extends('layouts.app')

@section('content')
<div class="relative">
    <!-- Latar belakang dengan efek blur -->
    <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('{{ asset('images/tamu-bg.jpg') }}'); height: 100vh;"></div>

    <!-- Kontainer Form Fasilitas Kamar -->
    <div class="relative container mx-auto mt-12 p-8 rounded-lg shadow-lg max-w-2xl bg-white bg-opacity-85">
        <!-- Pesan Kesalahan --
            <h2 class="text-2xl font-semibold text-center text-brown-700 mb-4">Edit Data Tamu</h2>

        <!-- Form Edit Fasilitas Kamar -->
        <div class="relative container mx-auto mt-8 p-8 rounded-lg shadow-lg max-w-2xl bg-white bg-opacity-85">
            <h2 class="text-2xl font-semibold text-center text-brown-700 mb-4">Edit Fasilitas untuk Kamar: <span class="font-bold text-blue-600">{{ $kamar->jenis_kamar }}</span></h2>

            <form action="{{ route('kamardanfasilitas.update', $kamar->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tampilkan jenis kamar -->
                <div class="mb-4">
                    <label for="jenis_kamar" class="block text-sm text-brown-700">Jenis Kamar:</label>
                    <input type="text" class="w-full px-4 py-2 border rounded-md bg-gray-100" 
                        id="jenis_kamar" name="jenis_kamar" value="{{ $kamar->jenis_kamar }}" disabled>
                </div>

                <!-- Pilih fasilitas kamar -->
                <div class="mb-6">
                    <label for="fasilitas_kamar" class="block text-sm text-brown-700 mb-2">Fasilitas Kamar:</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($fasilitasKamar as $fasilitas)
                            <div class="flex items-center space-x-2">
                                <input type="checkbox" name="fasilitas_kamar[]" value="{{ $fasilitas->id_fasilitas_kamar }}" 
                                    {{ in_array($fasilitas->id_fasilitas_kamar, $fasilitasKamarTerpilih) ? 'checked' : '' }} 
                                    class="h-5 w-5 text-blue-500 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-gray-700">{{ $fasilitas->nama_fasilitas }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tombol Update -->
                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-[#964B00] text-white px-6 py-2 rounded-md hover:bg-brown-700 transition-colors">
                        Update Fasilitas Kamar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
