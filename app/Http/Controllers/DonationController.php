<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DonationController extends Controller
{
    // ✅ Safaricom sandbox credentials
    private $consumerKey = 'Tz1iMZT9AaYLKl375a88groRocepHFV1uArSDtGUGGewmX4A';
    private $consumerSecret = '6GLK76V5BxKOwtCGJirSKiU6c9oTidSAAaPGUfC6Pc09kosRhG4ABtQL7v2zfPLZ';
    private $shortcode = '174379'; // Default Paybill for sandbox
    private $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

    /**
     * Show donation form
     */
    public function index()
    {
        return view('donate');
    }

    /**
     * Send M-Pesa STK Push request
     */
    public function stkPush(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'phone' => 'required|regex:/^2547\d{8}$/',
        ]);

        // 1️⃣ Generate access token
        $tokenResponse = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');

        if ($tokenResponse->failed()) {
            Log::error('Failed to get access token', ['response' => $tokenResponse->body()]);
            return response()->json(['error' => 'Failed to connect to M-Pesa API.'], 500);
        }

        $accessToken = $tokenResponse->json()['access_token'];

        // 2️⃣ Generate STK password and timestamp
        $timestamp = date('YmdHis');
        $password = base64_encode($this->shortcode . $this->passkey . $timestamp);

        // 3️⃣ Define your ngrok callback URL (replace when hosted)
        $callbackUrl = 'https://epistemologically-murrey-lyda.ngrok-free.dev/api/mpesa/callback';

        // 4️⃣ Build STK Push request payload
        $stkRequest = [
            'BusinessShortCode' => $this->shortcode,
            'Password' => $password,
            'Timestamp' => $timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => (int) $request->amount,
            'PartyA' => $request->phone,
            'PartyB' => $this->shortcode,
            'PhoneNumber' => $request->phone,
            'CallBackURL' => $callbackUrl,
            'AccountReference' => 'KCCWG Donation',
            'TransactionDesc' => 'Climate Action Donation',
        ];

        Log::info('STK Push Request:', $stkRequest);

        // 5️⃣ Send STK Push request
        $stkResponse = Http::withToken($accessToken)
            ->post('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest', $stkRequest);

        Log::info('STK Push Response:', $stkResponse->json());

        // 6️⃣ Handle errors
        if ($stkResponse->failed() || isset($stkResponse->json()['errorCode'])) {
            Log::error('M-Pesa STK Push Error:', ['response' => $stkResponse->body()]);
            return response()->json(['error' => 'Failed to initiate M-Pesa STK Push. Check your callback URL or credentials.'], 500);
        }

        return response()->json($stkResponse->json());
    }

    /**
     * Handle M-Pesa callback (called by Safaricom after transaction)
     */
    public function callback(Request $request)
    {
        Log::info('📞 M-Pesa Callback Received:', $request->all());

        // You can process the transaction here (save to DB, verify amount, etc.)
        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Callback received successfully'
        ]);
    }
}
