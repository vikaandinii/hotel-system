@extends('layouts.app')

@section('title', 'Pembayaran Berhasil')

@section('content')
<div class="py-12">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-center mb-6">Pembayaran Berhasil</h1>

        <!-- Informasi Pembayaran -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">Informasi Pembayaran</h2>
            <p><strong>Jumlah Pembayaran:</strong> Rp{{ number_format(session('totalHarga'), 0, ',', '.') }}</p>  <!-- Tampilkan totalHarga dari session -->
            <p><strong>Tanggal Pembayaran:</strong> {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>

        <!-- Cetak Struk -->

    </div>
</div>
@endsection