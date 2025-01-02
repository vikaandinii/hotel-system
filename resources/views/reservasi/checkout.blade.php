@extends('layouts.app')

@section('title', 'Checkout Reservasi')

@section('content')
<div class="py-12">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-center mb-6">Checkout Reservasi</h1>

        <!-- Informasi Tamu -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">Informasi Tamu</h2>
            <p><strong>Nama:</strong> {{ $tamu->nama_tamu }}</p>
            <p><strong>Email:</strong> {{ $tamu->email }}</p>
            <p><strong>No. Telepon:</strong> {{ $tamu->no_telp }}</p>
            <p><strong>Kewarganegaraan:</strong> {{ $tamu->kewarganegaraan }}</p>
            <p><strong>Alamat:</strong> {{ $tamu->alamat }}</p>
        </div>

        <!-- Informasi Reservasi -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">Detail Reservasi</h2>
            <p><strong>Tanggal Check-in:</strong> {{ $tanggalCheckin }}</p>
            <p><strong>Tanggal Check-out:</strong> {{ $tanggalCheckout }}</p>
            <p><strong>Jumlah Orang:</strong> {{ $jumlahTamu }}</p>
        </div>

        <!-- Daftar Kamar -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">Kamar yang Dipesan</h2>
            <ul class="list-disc pl-6">
                @foreach ($kamars as $kamar)
                    <li>
                        <p><strong>Kamar:</strong> {{ $kamar->nomor_kamar }}</p>
                        <p><strong>Jenis:</strong> {{ $kamar->jenis_kamar }}</p>
                        <p><strong>Harga per Malam:</strong> Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</p>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Total Harga -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">Total Harga</h2>
            <p class="text-xl font-bold text-blue-600">Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
        </div>

        <!-- Pilihan Metode Pembayaran -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-lg font-semibold mb-4">Pilih Metode Pembayaran</h2>
            <form action="{{ route('reservasi.store') }}" method="POST">
                @csrf

                <!-- Hidden Inputs for Checkout -->
                <input type="hidden" name="id_tamu" value="{{ $tamu->id_tamu }}"> <!-- ID Tamu -->
                <input type="hidden" name="tanggal_checkin" value="{{ $tanggalCheckin }}"> <!-- Tanggal Check-in -->
                <input type="hidden" name="tanggal_checkout" value="{{ $tanggalCheckout }}"> <!-- Tanggal Check-out -->
                <input type="hidden" name="total_harga" value="{{ $totalHarga }}"> <!-- Total Harga -->

                <!-- Payment Method Selection -->
                <div class="mb-4">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700">Pilih Metode Pembayaran</label>
                    <select name="payment_method" id="payment_method" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="qris">QRIS</option>
                        <option value="ovo">OVO</option>
                        <option value="shopeepay">ShopeePay (Mobile Only)</option>
                        <option value="bca_va">BCA Virtual Account</option>
                        <option value="mandiri_va">Mandiri Virtual Account</option>
                        <option value="credit_card">Kartu Kredit</option>
                    </select>
                </div>

                <!-- Handling Multiple Room Selections -->
                @foreach ($kamars as $kamar)
                    <input type="hidden" name="id_kamars[]" value="{{ $kamar->id }}"> <!-- ID Kamar yang dipilih -->
                @endforeach

                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
                    Bayar Sekarang (Simulasi)
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
