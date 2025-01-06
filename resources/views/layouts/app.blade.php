<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-[#F5F5DC] min-h-screen">
    <!-- Navbar -->
    <nav class="bg-[#964B00] text-[#F0E4CC] p-4 flex justify-between items-center">
        <!-- Navigasi Menu -->
        <ul class="flex space-x-4">
            <li><a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a></li>
            <li><a href="{{ route('tamu.index') }}" class="hover:underline">Tamu</a></li>
            <li><a href="{{ route('kamar.index') }}" class="hover:underline">Kamar</a></li>
            <li><a href="{{ route('fasilitas.index') }}" class="hover:underline">Fasilitas</a></li>
            <li><a href="{{ route('reservasi.index') }}" class="hover:underline">Reservasi</a></li>
            <li><a href="{{ route('KamarDanFasilitas.index') }}" class="hover:underline">Kamar & Fasilitas</a></li>
            <li><a href="{{ route('detailReservasi.index') }}" class="hover:underline">Detail Reservasi</a></li>
        </ul>
        <!-- Info Admin -->
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="hover:underline text-red-500 ml-2 bg-transparent border-none cursor-pointer">
                Logout
            </button>
        </form>

    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>
</body>
</html>
