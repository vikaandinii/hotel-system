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
    }
    .card img {
        border-radius: 8px 8px 0 0;
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

        <!-- Form Pencarian -->
        <form action="{{ route('reservasi.create', ['id_tamu' => $tamu->id_tamu]) }}" method="GET" class="card p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Cari Kamar</h2>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label for="checkin" class="block text-sm font-medium">Tanggal Check-in</label>
                    <input type="date" name="checkin" id="checkin" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('checkin') }}" required>
                </div>
                <div>
                    <label for="checkout" class="block text-sm font-medium">Tanggal Check-out</label>
                    <input type="date" name="checkout" id="checkout" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('checkout') }}" required>
                </div>
                <div>
                    <label for="jumlah_orang" class="block text-sm font-medium">Jumlah Orang</label>
                    <select name="jumlah_orang" id="jumlah_orang" class="mt-1 block w-full border-gray-300 rounded-md">
                        <option value="1">1 Orang Dewasa</option>
                        <option value="3">2 Dewasa + 1 Anak</option>
                        <option value="4">4 Orang Dewasa</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn-primary mt-4">Cari Kamar</button>
        </form>

        <!-- Menampilkan Kamar -->
        @if($kamarTersedia->isEmpty())
            <p class="text-center text-white">Tidak ada kamar tersedia untuk tanggal tersebut.</p>
        @else
            <form action="{{ route('reservasi.index') }}" method="GET">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($kamarTersedia as $kamar)
                        <div class="card overflow-hidden">
                            <img src="{{ asset('storage/' . $kamar->gambar_kamar) }}" alt="Kamar {{ $kamar->nomor_kamar }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-800">Kamar {{ $kamar->nomor_kamar }}</h3>
                                <p class="text-gray-600">Jenis: {{ ucfirst($kamar->jenis_kamar) }}</p>
                                <p class="text-gray-600">Harga: Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}/malam</p>
                                <p class="text-gray-600">Kapasitas: {{ $kamar->kapasitas_kamar }} Orang</p>
                                <div class="mt-4">
                                    <input type="checkbox" name="kamar_ids[]" value="{{ $kamar->id }}" id="kamar_{{ $kamar->id }}" class="form-checkbox">
                                    <label for="kamar_{{ $kamar->id }}" class="ml-2 text-sm text-gray-800">Pilih Kamar</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-8">
                    <button type="submit" class="btn-primary">Reservasi Kamar</button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
