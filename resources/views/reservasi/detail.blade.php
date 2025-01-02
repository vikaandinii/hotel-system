@extends('layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
<div class="relative bg-cover bg-center min-h-screen" style="background-image: url('/images/tamu-bg.jpg');">

    <div class="relative py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg p-8 bg-opacity-60">
                <h1 class="text-5xl font-semibold mb-6 text-center leading-tight text-[#3E2723]">Detail Reservasi</h1>

                <div class="mb-6">
                    <p><strong>Nama Tamu:</strong> {{ $reservasi->tamu->nama_tamu }}</p>
                    <p><strong>Check-in:</strong> {{ $reservasi->tanggal_checkin }}</p>
                    <p><strong>Check-out:</strong> {{ $reservasi->tanggal_checkout }}</p>
                    <p><strong>Total Harga:</strong> Rp{{ number_format($reservasi->total_harga, 0, ',', '.') }}</p>
                    <p><strong>Status Reservasi:</strong> {{ $reservasi->status_reservasi }}</p>
                    <p><strong>Metode Pembayaran:</strong> {{ $reservasi->metode_pembayaran }}</p>

                    <h3 class="mt-4 text-xl font-semibold">Kamar yang Dipesan:</h3>
                    <ul class="list-disc ml-6">
                        @foreach ($reservasi->kamars as $kamar)
                            <li>Kamar Nomor: {{ $kamar->nomor_kamar }} ({{ $kamar->jenis_kamar }})</li>
                        @endforeach
                    </ul>
                </div>

                <a href="{{ route('reservasi.index') }}" class="text-blue-500 hover:underline">Kembali ke Daftar Reservasi</a>
            </div>
        </div>
    </div>
</div>
@endsection
