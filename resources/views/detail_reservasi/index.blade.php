@extends('layouts.app')
@vite('resources/css/app.css')

@section('title', 'Detail Reservasi')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 text-center mb-8">Daftar Riwayat Reservasi Hotel</h1>

        <!-- Form Pencarian -->
        <div class="mb-6">
            <form method="GET" action="{{ route('detailReservasi.index') }}" class="flex justify-center">
                <div class="flex items-center bg-white rounded-md shadow-md w-full max-w-lg">
                    <input type="text" name="search" value="{{ old('search', $search) }}" 
                           class="w-full p-3 border-0 focus:outline-none focus:ring focus:ring-blue-300" 
                           placeholder="Cari nama tamu atau email...">
                    <button type="submit" class="bg-brown-500 text-white px-6 py-3 hover:bg-brown-600 transition">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Data Reservasi -->
        @if ($reservasiDetail->isEmpty())
            <p class="text-center text-gray-500">Tidak ada data yang ditemukan.</p>
        @else
            <div class="space-y-8">
                @foreach ($reservasiDetail as $reservasi)
                    <div class="bg-white shadow-xl rounded-lg p-6 border border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-700 mb-6">Reservasi ID: {{ $reservasi->id_reservasi }}</h2>

                        <!-- Informasi Tamu -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h3 class="font-bold text-gray-600 mb-2">Informasi Tamu</h3>
                                <p><strong>Nama:</strong> {{ $reservasi->tamu->nama_tamu }}</p>
                                <p><strong>Email:</strong> {{ $reservasi->tamu->email }}</p>
                                <p><strong>Telepon:</strong> {{ $reservasi->tamu->no_telp }}</p>
                                <p><strong>Alamat:</strong> {{ $reservasi->tamu->alamat }}</p>
                            </div>

                            <!-- Informasi Reservasi -->
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h3 class="font-bold text-gray-600 mb-2">Informasi Reservasi</h3>
                                <p><strong>Check-in:</strong> {{ $reservasi->tanggal_checkin->format('d-m-Y H:i') }}</p>
                                <p><strong>Check-out:</strong> {{ $reservasi->tanggal_checkout->format('d-m-Y H:i') }}</p>
                                <p><strong>Total Harga:</strong> Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</p>
                                <p><strong>Pembayaran:</strong> {{ $reservasi->metode_pembayaran }}</p>
                            </div>
                        </div>

                        <!-- Detail Kamar -->
                        <div>
                            <h3 class="font-bold text-gray-600 mb-4">Detail Kamar yang Dipesan</h3>
                            <table class="w-full text-left table-auto border-collapse">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="border-b p-3 font-medium text-gray-600">No Kamar</th>
                                        <th class="border-b p-3 font-medium text-gray-600">Jenis Kamar</th>
                                        <th class="border-b p-3 font-medium text-gray-600">Harga/Malam</th>
                                        <th class="border-b p-3 font-medium text-gray-600">Kapasitas</th>
                                        <th class="border-b p-3 font-medium text-gray-600">Jumlah Hari Menginap</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservasi->detailReservasi as $detail)
                                        <tr class="hover:bg-gray-50">
                                            <td class="border-b p-3">{{ $detail->kamar->nomor_kamar }}</td>
                                            <td class="border-b p-3">{{ $detail->kamar->jenis_kamar }}</td>
                                            <td class="border-b p-3">Rp {{ number_format($detail->kamar->harga_per_malam, 0, ',', '.') }}</td>
                                            <td class="border-b p-3">{{ $detail->kamar->kapasitas_kamar }} org</td>
                                            <td class="border-b p-3">{{ $detail->jumlah_hari }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
