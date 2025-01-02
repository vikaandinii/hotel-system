@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
<div class="relative min-h-screen">
    <!-- Background Full -->
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('{{ asset('images/tamu-bg.jpg') }}'); background-size: cover;">
    </div>

    <!-- Overlay -->
    <div class="absolute inset-0 bg-brown-900 opacity-60"></div>

    <!-- Main Content -->
    <div class="container mx-auto py-10 px-4 relative z-10">
        <h1 class="text-3xl font-bold text-center text-white mb-8">Daftar Kamar dan Fasilitas</h1>

        <!-- Search Form -->
        <form method="GET" action="{{ route('kamardanfasilitas.index') }}" class="mb-6">
            <div class="flex flex-wrap items-center justify-center gap-4">
                <div>
                    <label for="jenis_kamar" class="block text-sm font-medium text-white">Pilih Jenis Kamar:</label>
                    <select name="jenis_kamar" id="jenis_kamar"
                            class="w-40 mt-1 p-2 border border-white rounded-md bg-brown-700 text-white focus:ring-2 focus:ring-brown-500">
                        <option value="">Semua Jenis</option>
                        <option value="ekonomi" {{ request('jenis_kamar') == 'ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                        <option value="standard" {{ request('jenis_kamar') == 'standard' ? 'selected' : '' }}>Standard</option>
                        <option value="vip" {{ request('jenis_kamar') == 'vip' ? 'selected' : '' }}>VIP</option>
                    </select>
                </div>
                <button type="submit"
                        class="px-4 py-2 bg-brown-600 text-white rounded-md shadow-md hover:bg-brown-700 transition">
                    Cari
                </button>
            </div>
        </form>

        <!-- Daftar Kamar -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($kamars as $kamar)
                <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col">
                    <!-- Gambar Kamar dengan Status -->
                    <div class="relative h-56">
                        <!-- Status Kamar -->
                        <div class="absolute top-2 left-2 bg-opacity-75 px-3 py-1 rounded-br-lg text-white text-sm font-semibold
                            {{ $kamar->status_kamar === 'Available' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ $kamar->status_kamar === 'Available' ? 'Available' : 'Not Available' }}
                        </div>
                        <img src="{{ asset('storage/' . $kamar->gambar_kamar) }}" alt="Gambar Kamar" class="w-full h-full object-cover">
                    </div>

                    <!-- Informasi Kamar -->
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $kamar->nomor_kamar }} - {{ ucfirst($kamar->jenis_kamar) }}</h3>
                            <p class="text-gray-600 text-sm">
                                @if ($kamar->fasilitas->isEmpty())
                                    <span class="text-gray-500">Tidak ada fasilitas</span>
                                @else
                                    Fasilitas: {{ $kamar->fasilitas->pluck('nama_fasilitas')->implode(', ') }}
                                @endif
                            </p>
                            <p class="text-gray-600 text-sm">Kapasitas: {{ $kamar->kapasitas_kamar }} orang</p>
                            <p class="text-gray-800 text-md font-semibold mt-2">Harga: Rp {{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</p>
                        </div>
                        
                        <!-- Tombol Aksi -->
                        <div class="mt-4">
                            <a href="{{ route('kamardanfasilitas.edit', $kamar->id) }}" 
                               class="block text-center bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                               Tambah Fasilitas
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <p class="text-center text-gray-500 py-6">Tidak ada kamar ditemukan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
