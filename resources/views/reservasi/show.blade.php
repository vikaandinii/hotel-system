@extends('layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Detail Reservasi</h1>
        <ul class="list-disc pl-5">
            <li><strong>ID Reservasi:</strong> {{ $reservasi->id_reservasi }}</li>
            <li><strong>Nama Tamu:</strong> {{ $reservasi->tamu->nama_tamu }}</li>
            <li><strong>Tanggal Check-in:</strong> {{ $reservasi->tanggal_checkin }}</li>
            <li><strong>Tanggal Check-out:</strong> {{ $reservasi->tanggal_checkout }}</li>
            <li><strong>Total Harga:</strong> Rp{{ number_format($reservasi->total_harga, 0, ',', '.') }}</li>
            <li><strong>Status:</strong> {{ ucfirst($reservasi->status_reservasi) }}</li>
        </ul>
        <a href="{{ route('reservasi.index') }}" class="btn btn-primary mt-4">Kembali</a>
    </div>
</div>
@endsection
