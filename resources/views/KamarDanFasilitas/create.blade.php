@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-500 text-white text-lg font-semibold p-4">
            Tambah Kamar dan Fasilitas
        </div>
        <div class="p-6">
            <form action="{{ route('kamardanfasilitas.store') }}" method="POST">
                @csrf

                <!-- Nomor Kamar -->
                <div class="mb-6">
                    <label for="nomor_kamar" class="block text-gray-700 font-medium mb-2">Nomor Kamar</label>
                    <select name="nomor_kamar" id="nomor_kamar" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300">
                        <option value="" disabled selected>Pilih Nomor Kamar</option>
                        @foreach ($kamars as $kamar)
                            <option value="{{ $kamar->id }}">
                                {{ $kamar->nomor_kamar }} - {{ ucfirst($kamar->jenis_kamar) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Fasilitas Kamar -->
                <div class="mb-6">
                    <label for="fasilitas_kamar" class="block text-gray-700 font-medium mb-2">Fasilitas Kamar</label>
                    <select name="fasilitas_kamar[]" id="fasilitas_kamar" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300" multiple>
                        @foreach ($fasilitasKamars as $fasilitas)
                            <option value="{{ $fasilitas->id_fasilitas_kamar }}">
                                {{ $fasilitas->nama_fasilitas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="text-right">
                    <button type="submit" class="bg-blue-500 text-white font-medium px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
