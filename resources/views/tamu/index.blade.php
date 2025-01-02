@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
    <!-- Background Image Section with Overlay -->
    <div class="relative bg-brown-100 min-h-screen">
        <!-- Image as Background with lower opacity for better visibility -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/images/tamu-bg.jpg'); height: 100%; opacity: 0.6;"></div>
        <!-- Overlay for better readability of text -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <!-- Main Content Over Background -->
        <div class="relative z-10 container mx-auto p-8 bg-transparent min-h-screen">
            <h1 class="text-4xl font-bold text-center text-white mb-8">Daftar Tamu</h1>

            <!-- Form Pencarian -->
            <div class="flex justify-between items-center mb-6">
                <form action="{{ route('tamu.index') }}" method="GET" class="flex space-x-4 items-center w-full max-w-3xl">
                    <input type="text" name="search" placeholder="Cari Nama Tamu..." value="{{ request()->query('search') }}" class="w-full px-4 py-2 border border-brown-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-brown-400 placeholder-gray-600 text-brown-800"/>
                    <button type="submit" class="px-6 py-2 bg-brown-600 text-white rounded-lg hover:bg-brown-700 transition-colors shadow-md">Cari</button>
                </form>
                <a href="{{ route('tamu.create') }}" class="px-6 py-2 bg-brown-600 text-white rounded-lg hover:bg-brown-700 transition-colors shadow-md">Tambah Tamu</a>
            </div>

            <!-- Table Daftar Tamu -->
            <div class="overflow-x-auto bg-transparent rounded-lg shadow-md">
                <table class="min-w-full border-collapse table-auto">
                    <thead class="bg-brown-600 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">Nama Tamu</th>
                            <th class="px-6 py-3 text-left">No. Telepon</th>
                            <th class="px-6 py-3 text-left">Jenis Kelamin</th>
                            <th class="px-6 py-3 text-left">Kewarganegaraan</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-brown-50 text-white">
                        @foreach ($tamus as $tamu)
                            <tr class="hover:bg-brown-100 transition-colors">
                                <td class="px-6 py-4 border-b border-gray-200">{{ $tamu->nama_tamu }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $tamu->no_telp }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $tamu->jenis_kelamin }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $tamu->kewarganegaraan }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">{{ $tamu->email }}</td>
                                <td class="px-6 py-4 border-b border-gray-200">
                                    <a href="{{ route('tamu.edit', $tamu->id_tamu) }}" class="text-blue-600 hover:text-blue-800 transition-colors">Edit</a>
                                    <form action="{{ route('tamu.destroy', $tamu->id_tamu) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $tamus->links() }}  <!-- Pagination links -->
            </div>
        </div>
    </div>
@endsection
