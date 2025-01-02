<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .content {
            margin-top: 20px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Struk Pembayaran</h1>
        <div class="content">
            <p><strong>Metode Pembayaran:</strong> {{ $paymentMethod }}</p>
            <p><strong>Jumlah Pembayaran:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
            <p><strong>Tanggal:</strong> {{ now()->format('d-m-Y H:i:s') }}</p>
        </div>
        <div class="footer">
            <p>Terima kasih atas transaksi Anda!</p>
        </div>
    </div>

    <script>
        window.onload = function () {
            window.print(); // Mencetak halaman secara otomatis saat dibuka
        };
    </script>
</body>
</html>
