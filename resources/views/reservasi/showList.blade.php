@extends('layouts.app')

@section('title', 'Daftar Detail Reservasi')

@section('content')
<div class="relative">
    <!-- Latar belakang dengan efek blur -->
    <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('{{ asset('images/tamu-bg.jpg') }}'); height: 100vh;"></div>

    <!-- Kontainer untuk tabel Detail Reservasi -->
    <div class="relative container mx-auto mt-12 p-8 rounded-lg shadow-lg max-w-4xl bg-white bg-opacity-85">
        <h1 class="text-5xl font-semibold mb-6 text-center text-[#3E2723]">Detail Reservasi</h1>

        @if ($reservasi->detailReservasi->isEmpty())
            <p class="text-center text-gray-500 italic">Belum ada detail reservasi yang dibuat.</p>
        @else
            <!-- Tampilkan detail reservasi dalam tabel -->
            <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Detail</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Kamar</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Hari</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($reservasi->detailReservasi as $detail)
                        <tr class="border-t border-b">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $detail->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $detail->id_kamar }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $detail->jumlah_hari }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $detail->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
