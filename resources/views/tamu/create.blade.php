@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
    <!-- Latar belakang dengan efek blur -->
    <div class="relative">
        <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('/images/tamu-bg.jpg');"></div>

        <!-- Formulir Pengisian Data Tamu -->
        <div class="relative container mx-auto mt-8 p-8 rounded-lg shadow-lg max-w-2xl bg-white bg-opacity-85">
            <h2 class="text-2xl font-semibold text-brown-700 text-center">Tambah Tamu</h2>
            <form action="{{ route('tamu.store') }}" method="POST" class="mt-6">
                @csrf
                <div class="space-y-4">
                    <!-- Nama Tamu -->
                    <div>
                        <label for="nama_tamu" class="block text-sm text-brown-700">Nama Tamu</label>
                        <input type="text" id="nama_tamu" name="nama_tamu" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    <!-- Nomor Telepon -->
                    <div>
                        <label for="no_telp" class="block text-sm text-brown-700">Nomor Telepon</label>
                        <input type="text" id="no_telp" name="no_telp" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm text-brown-700">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-2 border rounded-md" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <!-- Kewarganegaraan -->
                    <div>
                        <label for="kewarganegaraan" class="block text-sm text-brown-700">Kewarganegaraan</label>
                        <input type="text" id="kewarganegaraan" name="kewarganegaraan" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm text-brown-700">Alamat</label>
                        <textarea id="alamat" name="alamat" class="w-full px-4 py-2 border rounded-md" required></textarea>
                    </div>
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm text-brown-700">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md" required>
                    </div>
                    <!-- Tombol Simpan -->
                    <button type="submit" class="mt-4 bg-[#964B00] text-white px-6 py-2 rounded-md hover:bg-green-700 transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
