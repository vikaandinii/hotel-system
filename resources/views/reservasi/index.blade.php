@extends('layouts.app')

@section('title', 'Cari Tamu')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-center mb-6">Cari Tamu</h1>

        <!-- Form Pencarian -->
        <form action="{{ route('reservasi.index') }}" method="GET" class="mb-6">
            <div class="relative">
                <input
                    type="text"
                    name="search"
                    placeholder="Masukkan nama atau email tamu"
                    value="{{ request('search') }}"
                    class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring focus:ring-blue-500"
                />
                <button
                    type="submit"
                    class="absolute right-2 top-2 bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
                >
                    Cari
                </button>
            </div>
        </form>

        <!-- Hasil Pencarian -->
        @if(isset($tamus) && count($tamus) > 0)
            <ul class="divide-y divide-gray-200 bg-white rounded-lg shadow-md">
                @foreach ($tamus as $tamu)
                    <li class="px-4 py-3 flex justify-between items-center">
                        <span>{{ $tamu->nama_tamu }} ({{ $tamu->email }})</span>
                        <a 
                            href="{{ route('reservasi.create', ['id_tamu' => $tamu->id_tamu]) }}" 
                            class="text-blue-500 hover:underline"
                        >
                            Pilih
                        </a>
                    </li>
                @endforeach
            </ul>
        @elseif(isset($tamus) && count($tamus) === 0)
            <p class="text-center text-gray-600">
                Tidak ada tamu ditemukan. 
                <a href="{{ route('tamu.create') }}" class="text-blue-500 hover:underline">Daftar Tamu Baru</a>
            </p>
        @else
            <p class="text-center text-gray-600">
                Silakan masukkan nama atau email untuk mencari tamu.
            </p>
        @endif
    </div>
</div>
@endsection
