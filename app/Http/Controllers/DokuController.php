<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DokuController extends Controller
{
    public function simulatePayment(Request $request)
    {
        $order_id = uniqid(); // ID unik untuk transaksi
        $amount = $request->amount; // Nominal transaksi

        // Data transaksi
        $data = [
            'order' => [
                'invoice_number' => $order_id,
                'amount' => $amount,
            ],
            'customer' => [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
            ],
            'payment' => [
                'payment_due_date' => 60,
            ],
        ];

        // Kirim permintaan ke API Doku Sandbox
        $response = Http::withHeaders([
            'Client-Id' => config('doku.client_id'),
            'Request-Id' => uniqid(),
            'Request-Timestamp' => now()->format('Y-m-d\TH:i:s\Z'),
            'Signature' => $this->generateSignature($data),
        ])->post(config('doku.api_url') . '/checkout/v1/payment', $data);

        if ($response->successful()) {
            // Redirect ke halaman pembayaran simulasi
            return redirect($response->json('payment_url'));
        }

        return back()->withErrors(['error' => 'Simulasi pembayaran gagal']);
    }

    private function generateSignature($data)
    {
        $data_json = json_encode($data);
        $digest = base64_encode(hash('sha256', $data_json, true));
        $string_to_sign = "Client-Id:" . config('doku.client_id') . "\n" .
                          "Request-Id:" . uniqid() . "\n" .
                          "Request-Timestamp:" . now()->format('Y-m-d\TH:i:s\Z') . "\n" .
                          "Request-Target:/checkout/v1/payment\n" .
                          "Digest:" . $digest;
        return base64_encode(hash_hmac('sha256', $string_to_sign, config('doku.shared_key'), true));
    }

    public function handleCallback(Request $request)
{
    // Validasi Signature
    $signature_key = $request->header('Signature');
    $body = $request->getContent();
    $valid_signature = base64_encode(hash_hmac('sha256', $body, config('doku.shared_key'), true));

    if ($signature_key !== $valid_signature) {
        return response()->json(['error' => 'Invalid signature'], 400);
    }

    // Proses callback transaksi
    $data = json_decode($body, true);
    if ($data['transaction']['status'] == 'SUCCESS') {
        // Update status transaksi di database
        // Contoh: Order::where('invoice', $data['order']['invoice_number'])->update(['status' => 'paid']);
    }

    return response()->json(['message' => 'Callback processed']);
}

}
