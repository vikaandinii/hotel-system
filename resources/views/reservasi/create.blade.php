@extends('layouts.app')

@section('title', 'Buat Reservasi')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Buat Reservasi Baru</h1>

        <!-- Data Tamu -->
        <h2 class="text-lg font-semibold mb-4">Data Tamu</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Tamu</label>
                <input 
                    type="text" 
                    value="{{ $tamu->nama_tamu }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" 
                    readonly
                >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input 
                    type="text" 
                    value="{{ $tamu->email }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" 
                    readonly
                >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                <input 
                    type="text" 
                    value="{{ $tamu->no_telp }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" 
                    readonly
                >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kewarganegaraan</label>
                <input 
                    type="text" 
                    value="{{ $tamu->kewarganegaraan }}" 
                    class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" 
                    readonly
                >
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea 
                    class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" 
                    rows="2" 
                    readonly
                >{{ $tamu->alamat }}</textarea>
            </div>
        </div>

        <!-- Form Input Data Reservasi -->
        <form action="{{ route('reservasi.filterKamar') }}" method="POST" class="mt-6">
            @csrf
            <input type="hidden" name="id_tamu" value="{{ $tamu->id_tamu }}">

            <h2 class="text-lg font-semibold mb-4">Data Reservasi</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="tanggal_checkin" class="block text-sm font-medium text-gray-700">Tanggal Check-in</label>
                    <input 
                        type="date" 
                        name="tanggal_checkin" 
                        id="tanggal_checkin" 
                        class="mt-1 block w-full border-gray-300 rounded-md" 
                        required
                    >
                </div>
                <div>
                    <label for="tanggal_checkout" class="block text-sm font-medium text-gray-700">Tanggal Check-out</label>
                    <input 
                        type="date" 
                        name="tanggal_checkout" 
                        id="tanggal_checkout" 
                        class="mt-1 block w-full border-gray-300 rounded-md" 
                        required
                    >
                </div>
                <div class="col-span-2">
                    <label for="jumlah_tamu" class="block text-sm font-medium text-gray-700">Jumlah Tamu</label>
                    <input 
                        type="number" 
                        name="jumlah_tamu" 
                        id="jumlah_tamu" 
                        class="mt-1 block w-full border-gray-300 rounded-md" 
                        placeholder="Masukkan jumlah tamu" 
                        min="1" 
                        required
                    >
                </div>
            </div>

            <button 
                type="submit" 
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 mt-6"
            >
                Cari Kamar
            </button>
        </form>
    </div>
</div>
@endsection
