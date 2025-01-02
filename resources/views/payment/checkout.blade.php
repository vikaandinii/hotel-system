@extends('layouts.app')

@section('title', 'Payment Checkout')

@section('content')
<div class="py-12">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-bold text-center mb-6">Pembayaran</h1>

        <button id="pay-button" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">
            Bayar Sekarang
        </button>
    </div>
</div>

<!-- Midtrans Snap.js -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log('Success:', result);
                alert('Pembayaran berhasil!');
            },
            onPending: function(result) {
                console.log('Pending:', result);
                alert('Pembayaran tertunda!');
            },
            onError: function(result) {
                console.log('Error:', result);
                alert('Pembayaran gagal!');
            },
            onClose: function() {
                alert('Anda menutup pembayaran!');
            }
        });
    };
</script>
@endsection
