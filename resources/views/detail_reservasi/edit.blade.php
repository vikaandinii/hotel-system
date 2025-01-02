@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Detail Reservasi</h2>
    <form action="{{ route('detail_reservasi.update', $detailReservasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_reservasi" class="form-label">ID Reservasi</label>
            <select name="id_reservasi" id="id_reservasi" class="form-control" required>
                <option value="">-- Pilih Reservasi --</option>
                @foreach($reservasis as $reservasi)
                <option value="{{ $reservasi->id_reservasi }}" {{ $detailReservasi->id_reservasi == $reservasi->id_reservasi ? 'selected' : '' }}>
                    {{ $reservasi->id_reservasi }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_kamar" class="form-label">Kamar</label>
            <select name="id_kamar" id="id_kamar" class="form-control" required>
                <option value="">-- Pilih Kamar --</option>
                @foreach($kamars as $kamar)
                <option value="{{ $kamar->id }}" {{ $detailReservasi->id_kamar == $kamar->id ? 'selected' : '' }}>
                    {{ $kamar->nama_kamar }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah_hari" class="form-label">Jumlah Hari</label>
            <input type="number" name="jumlah_hari" id="jumlah_hari" class="form-control" value="{{ $detailReservasi->jumlah_hari }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
