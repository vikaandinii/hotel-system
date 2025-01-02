@extends('layouts.app')
@vite('resources/css/app.css')

@section('content')
    <!-- Latar belakang dengan efek blur -->
    <div class="relative">
        <div class="absolute inset-0 bg-cover bg-center filter blur-sm" style="background-image: url('/images/tamu-bg.jpg');"></div>

        <!-- Form Edit Data Tamu -->
        <div class="relative container mx-auto mt-8 p-8 rounded-lg shadow-lg max-w-2xl bg-white bg-opacity-85">
            <h2 class="text-2xl font-semibold text-center text-brown-700 mb-4">Edit Data Tamu</h2>
            
            <form action="{{ route('tamu.update', $tamus->id_tamu) }}" method="POST" class="mt-6">
                @csrf
                @method('PUT')

                <!-- Input Nama Tamu -->
                <div class="space-y-4">
                    <div>
                        <label for="nama_tamu" class="block text-sm text-brown-700">Nama Tamu</label>
                        <input type="text" id="nama_tamu" name="nama_tamu" value="{{ old('nama_tamu', $tamus->nama_tamu) }}" class="w-full px-4 py-2 border rounded-md" required>
                    </div>

                    <!-- Input No Telepon -->
                    <div>
                        <label for="no_telp" class="block text-sm text-brown-700">Nomor Telepon</label>
                        <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', $tamus->no_telp) }}" class="w-full px-4 py-2 border rounded-md" required>
                    </div>

                    <!-- Input Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm text-brown-700">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="w-full px-4 py-2 border rounded-md" required>
                            <option value="Laki-laki" {{ $tamus->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $tamus->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    <!-- Input Kewarganegaraan -->
                    <div>
                        <label for="kewarganegaraan" class="block text-sm text-brown-700">Kewarganegaraan</label>
                        <input type="text" id="kewarganegaraan" name="kewarganegaraan" value="{{ old('kewarganegaraan', $tamus->kewarganegaraan) }}" class="w-full px-4 py-2 border rounded-md" required>
                    </div>

                    <!-- Input Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm text-brown-700">Alamat</label>
                        <textarea id="alamat" name="alamat" class="w-full px-4 py-2 border rounded-md" required>{{ old('alamat', $tamus->alamat) }}</textarea>
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-sm text-brown-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $tamus->email) }}" class="w-full px-4 py-2 border rounded-md" required>
                    </div>

                    <!-- Tombol Update -->
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="bg-[#964B00] text-white px-6 py-2 rounded-md hover:bg-brown-700 transition-colors">Update Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
