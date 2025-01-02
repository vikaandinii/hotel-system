@extends('layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center">Detail Reservasi Hotel</h1>

        <!-- Form Pencarian -->
        <div class="mb-6 flex justify-center">
            <form method="GET" action="{{ route('detailReservasi.index') }}" class="w-full max-w-md">
                <div class="flex items-center bg-white rounded-lg shadow-lg overflow-hidden">
                    <input type="text" name="search" value="{{ old('search', $search) }}" class="p-3 w-full border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-blue-500" placeholder="Cari nama tamu atau email..." />
                    <button type="submit" class="p-3 bg-blue-500 text-white hover:bg-blue-600 transition duration-200 rounded-r-lg">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        @if($reservasiDetail->isEmpty())
            <p class="text-center text-gray-500">Tidak ada data yang ditemukan.</p>
        @else
            @foreach ($reservasiDetail as $reservasi)
                <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transition transform hover:scale-105">
                    <div class="text-center mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Reservasi ID: {{ $reservasi->id_reservasi }}</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Informasi Tamu -->
                        <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold text-gray-700 mb-4">Informasi Tamu</h3>
                            <p><strong class="font-medium">Nama Tamu:</strong> {{ $reservasi->tamu->nama_tamu }}</p>
                            <p><strong class="font-medium">Email Tamu:</strong> {{ $reservasi->tamu->email }}</p>
                            <p><strong class="font-medium">Nomor Telepon:</strong> {{ $reservasi->tamu->no_telp }}</p>
                            <p><strong class="font-medium">Alamat:</strong> {{ $reservasi->tamu->alamat }}</p>
                        </div>

                        <!-- Informasi Reservasi -->
                        <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold text-gray-700 mb-4">Informasi Reservasi</h3>
                            <p><strong class="font-medium">Tanggal Check-in:</strong> {{ $reservasi->tanggal_checkin->format('d-m-Y H:i') }}</p>
                            <p><strong class="font-medium">Tanggal Check-out:</strong> {{ $reservasi->tanggal_checkout->format('d-m-Y H:i') }}</p>
                            <p><strong class="font-medium">Total Harga:</strong> Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</p>
                            <p><strong class="font-medium">Metode Pembayaran:</strong> {{ $reservasi->metode_pembayaran }}</p>
                        </div>

                        <!-- Detail Kamar -->
                        <div class="bg-gray-50 p-4 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold text-gray-700 mb-4">Detail Kamar</h3>
                            @foreach ($reservasi->detailReservasi as $detail)
                                <div class="space-y-2 mb-4">
                                    <p><strong class="font-medium">Kamar Nomor:</strong> {{ $detail->kamar->nomor_kamar }}</p>
                                    <p><strong class="font-medium">Jenis Kamar:</strong> {{ $detail->kamar->jenis_kamar }}</p>
                                    <p><strong class="font-medium">Harga per Malam:</strong> Rp {{ number_format($detail->kamar->harga_per_malam, 0, ',', '.') }}</p>
                                    <p><strong class="font-medium">Kapasitas Kamar:</strong> {{ $detail->kamar->kapasitas_kamar }} orang</p>
                                    <p><strong class="font-medium">Jumlah Hari:</strong> {{ $detail->jumlah_hari }} hari</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
