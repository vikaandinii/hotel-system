@extends('layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Struk Reservasi</h1>
        <div class="border-b pb-4 mb-4">
            <p><strong>Nama Tamu:</strong> {{ $reservasi->tamu->nama_tamu }}</p>
            <p><strong>No. Telepon:</strong> {{ $reservasi->tamu->no_telp }}</p>
            <p><strong>Alamat:</strong> {{ $reservasi->tamu->alamat }}</p>
        </div>
        <div class="border-b pb-4 mb-4">
            <p><strong>Tanggal Check-in:</strong> {{ $reservasi->tanggal_checkin }}</p>
            <p><strong>Tanggal Check-out:</strong> {{ $reservasi->tanggal_checkout }}</p>
            <p><strong>Status Reservasi:</strong> {{ $reservasi->status_reservasi }}</p>
        </div>
        <div class="border-b pb-4 mb-4">
            <h2 class="font-semibold mb-2">Detail Kamar:</h2>
            <ul>
                @foreach($reservasi->kamars as $kamar)
                    <li>Kamar {{ $kamar->nomor_kamar }} - Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</li>
                @endforeach
            </ul>
        </div>
        <div class="text-right">
            <h3 class="text-xl font-bold">Total Harga: Rp{{ number_format($reservasi->total_harga, 0, ',', '.') }}</h3>
        </div>
        <div class="mt-4 text-center">
            <button onclick="window.print()" class="bg-blue-500 text-white px-4 py-2 rounded">Cetak Struk</button>
        </div>
    </div>
</div>
@endsection
