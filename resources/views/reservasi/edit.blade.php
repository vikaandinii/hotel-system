@extends('layouts.app')

@section('title', 'Edit Reservasi')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#964B00] text-[#F0E4CC] shadow-lg rounded-lg p-8">
            <h1 class="text-4xl font-bold mb-4 text-center">Edit Reservasi</h1>

            <form action="{{ route('reservasi.update', $reservasi->id_reservasi) }}" method="POST">
                @csrf
                @method('PUT')


                <!-- Tamu: Pilih Nama Tamu -->
                <div class="mb-4">
                    <label for="id_tamu" class="block text-sm font-medium text-gray-700">Nama Tamu</label>
                    <select name="id_tamu" id="id_tamu" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        @foreach($tamus as $tamu)
                            <option value="{{ $tamu->id_tamu }}">{{ $tamu->nama_tamu }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Menampilkan Tanggal Check-in dan Check-out -->
                <div class="bg-[#F5F5DC] p-4 rounded-lg">
                    <div class="mb-4">
                        <label for="tanggal_checkin" class="block text-sm font-medium text-gray-700">Tanggal Check-in</label>
                        <input type="date" name="tanggal_checkin" id="tanggal_checkin" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('tanggal_checkin') }}" required>
                    </div>
                    <div class="mb-4">
                        <label for="tanggal_checkout" class="block text-sm font-medium text-gray-700">Tanggal Check-out</label>
                        <input type="date" name="tanggal_checkout" id="tanggal_checkout" class="mt-1 block w-full border-gray-300 rounded-md" value="{{ old('tanggal_checkout') }}" required>
                    </div>
                </div>

                <!-- Pilih Kamar -->
                <div class="mb-4">
                    <label for="kamar_ids" class="block text-sm font-medium text-gray-700">Pilih Kamar</label>
                    <select id="kamar_ids" name="kamar_ids[]" class="mt-1 block w-full border-gray-300 rounded-md" required multiple>
                        @foreach($kamars as $kamar)
                            <option value="{{ $kamar->id }}" data-harga="{{ $kamar->harga_per_malam }}">
                                Kamar {{ $kamar->nomor_kamar }} - Rp{{ number_format($kamar->harga_per_malam, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                
                <!-- Status Reservasi -->
                <div class="mb-4">
                    <label for="status_reservasi" class="block text-sm font-medium text-gray-700">Status Reservasi</label>
                    <select name="status_reservasi" id="status_reservasi" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        <option value="Dibatalkan" {{ $reservasi->status_reservasi == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        <option value="Dipesan" {{ $reservasi->status_reservasi == 'Dipesan' ? 'selected' : '' }}>Dipesan</option>
                        <option value="Tersedia" {{ $reservasi->status_reservasi == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    </select>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-4">
                    <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md" required>
                        <option value="Transfer Bank" {{ $reservasi->metode_pembayaran == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                        <option value="Kartu Kredit" {{ $reservasi->metode_pembayaran == 'Kartu Kredit' ? 'selected' : '' }}>Kartu Kredit</option>
                        <option value="Tunai" {{ $reservasi->metode_pembayaran == 'Tunai' ? 'selected' : '' }}>Tunai</option>
                    </select>
                </div>

                <!-- Total Harga -->
                <div class="mb-4">
                    <label for="total_harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
                    <input type="text" name="total_harga" id="total_harga" class="mt-1 block w-full border-gray-300 rounded-md" value="Rp0" readonly>
                </div>
                
                <div class="mt-6 text-center">
                    <button type="submit" class="bg-[#964B00] text-[#F0E4CC] px-4 py-2 rounded hover:bg-[#7a3b00]">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('kamar_ids').addEventListener('change', function() {
    const kamarIds = Array.from(this.selectedOptions).map(option => option.value);
    let totalHarga = 0;

    kamarIds.forEach(id => {
        const harga = parseFloat(document.querySelector(`option[value="${id}"]`).dataset.harga);
        if (!isNaN(harga)) {
            totalHarga += harga; // Hanya tambahkan harga yang valid
        }
    });

    // Cek apakah tanggal check-in dan check-out sudah dipilih
    const tanggal_checkin = document.getElementById('tanggal_checkin').value;
    const tanggal_checkout = document.getElementById('tanggal_checkout').value;

    if (!tanggal_checkin || !tanggal_checkout) {
        document.getElementById('total_harga').value = 0; // Tidak menggunakan format Rp di sini
        return; // Jika tanggal kosong, tidak lanjutkan perhitungan harga
    }

    const lamaMenginap = calculateDays(tanggal_checkin, tanggal_checkout);

    if (isNaN(lamaMenginap) || lamaMenginap <= 0) {
        document.getElementById('total_harga').value = 0; // Tampilkan 0 jika lama menginap tidak valid
        return;
    }

    totalHarga *= lamaMenginap;

    // Format angka tanpa simbol Rp
    document.getElementById('total_harga').value = totalHarga.toLocaleString(); // Format angka menggunakan pemisah ribuan
});

// Menghitung jumlah hari antara checkin dan checkout
function calculateDays(tanggal_checkin, tanggal_checkout) {
    const date1 = new Date(tanggal_checkin);
    const date2 = new Date(tanggal_checkout);
    const difference = date2 - date1;

    // Pastikan perbedaan tanggal valid
    return difference >= 0 ? difference / (1000 * 3600 * 24) : NaN;
}

</script>
@endsection
