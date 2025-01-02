@extends('layouts.app')

@section('title', 'Pilih Kamar')

@section('content')
<div class="py-12">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-center mb-6">Pilih Kamar Tersedia</h1>

        @if($kamarTersedia->isEmpty())
            <p class="text-center text-gray-600">Tidak ada kamar yang tersedia untuk jumlah tamu dan tanggal tersebut.</p>
        @else
        <form action="{{ route('reservasi.checkout') }}" method="POST">
            @csrf
            <input type="hidden" name="id_tamu" value="{{ $tamu->id_tamu }}">
            <input type="hidden" name="tanggal_checkin" value="{{ $tanggalCheckin }}">
            <input type="hidden" name="tanggal_checkout" value="{{ $tanggalCheckout }}">
            <input type="hidden" name="jumlah_tamu" value="{{ $jumlahTamu }}">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($kamarTersedia as $kamar)
                    <div class="bg-white p-4 rounded-lg shadow-md">
                        <!-- Checkbox Pilih Kamar -->
                        <div class="flex items-center mb-4">
                            <input 
                                type="checkbox" 
                                name="id_kamars[]" 
                                value="{{ $kamar->id }}" 
                                id="kamar_{{ $kamar->id }}" 
                                class="mr-2"
                            >
                            <label for="kamar_{{ $kamar->id }}" class="text-lg font-bold">
                                Kamar {{ $kamar->nomor_kamar }}
                            </label>
                        </div>

                        <!-- Gambar Kamar -->
                        <img 
                            src="{{ asset('storage/' . $kamar->gambar_kamar) }}" 
                            alt="Foto Kamar {{ $kamar->nomor_kamar }}" 
                            class="w-full h-48 object-cover rounded-md mb-4"
                        >

                        <!-- Informasi Kamar -->
                        <p>Jenis: {{ $kamar->jenis_kamar }}</p>
                        <p>Harga: Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}</p>
                        <p>Kapasitas: {{ $kamar->kapasitas_kamar }} orang</p>
                        <p class="text-sm text-gray-600">
                            Fasilitas: 
                            @if ($kamar->fasilitas->isEmpty())
                                Tidak ada fasilitas.
                            @else
                                {{ $kamar->fasilitas->pluck('nama_fasilitas')->implode(', ') }}
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>

            <!-- Tombol Submit -->
            <div class="text-center mt-6">
                <button 
                    type="submit" 
                    class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600"
                >
                    Lanjut ke Checkout
                </button>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection
