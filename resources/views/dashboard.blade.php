@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Background dengan gambar hotel */
    body {
        background: url('{{ asset('images/hotel-bg.jpg') }}') no-repeat center center fixed;
        background-size: cover;
    }
    /* Overlay untuk membuat teks lebih terlihat */
    .overlay {
        background: rgba(0, 0, 0, 0.5);
        padding: 2rem;
        border-radius: 8px;
    }
    .card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: relative;
    }
    .card img {
        border-radius: 8px 8px 0 0;
    }
    .status {
        position: absolute;
        top: 10px;
        left: 10px;
        padding: 5px 10px;
        border-radius: 8px;
        font-weight: bold;
        color: white;
    }
    .status-tersedia {
        background-color: #28a745; /* Green for available */
    }
    .status-tidak-tersedia {
        background-color: #dc3545; /* Red for not available */
    }
    .btn-primary {
        background: #964B00;
        color: #F0E4CC;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        display: inline-block;
    }
    .btn-primary:hover {
        background: #7a3b00;
    }
</style>

<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="overlay text-white text-center mb-8">
            <h1 class="text-4xl font-bold">Selamat Datang di Sistem Reservasi Hotel</h1>
            <p class="text-lg mt-2">Pilih kamar terbaik untuk pengalaman menginap yang tak terlupakan</p>
        </div>

        <!-- Menampilkan Kamar -->
        @if($kamarTersedia->isEmpty())
            <p class="text-center text-white">Tidak ada kamar yang tersedia saat ini.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($kamarTersedia as $kamar)
                    <div class="card overflow-hidden">
                        <!-- Status Kamar -->
                        <div class="status {{ $kamar->status_kamar === 'Tersedia' ? 'status-tersedia' : 'status-tidak-tersedia' }}">
                            {{ $kamar->status_kamar }}
                        </div>
                        <img src="{{ asset('storage/' . $kamar->gambar_kamar) }}" alt="Kamar {{ $kamar->nomor_kamar }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800">Kamar {{ $kamar->nomor_kamar }}</h3>
                            <p class="text-gray-600">Jenis: {{ ucfirst($kamar->jenis_kamar) }}</p>
                            <p class="text-gray-600">Harga: Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}/malam</p>
                            <p class="text-gray-600">Kapasitas: {{ $kamar->kapasitas_kamar }} Orang</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
