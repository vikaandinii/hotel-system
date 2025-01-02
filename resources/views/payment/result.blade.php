@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="py-12">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-center mb-6">Pembayaran Berhasil</h1>

        <!-- Informasi Pembayaran -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">Informasi Pembayaran</h2>
            <p><strong>Metode Pembayaran:</strong> {{ $paymentMethod }}</p>
            <p><strong>Jumlah Pembayaran:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
            <p><strong>Tanggal Pembayaran:</strong> {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>

        <!-- Cetak Struk -->
        <div class="text-center">
            <button class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">
                Cetak Struk
            </button>
        </div>
    </div>
</div>
@endsection
