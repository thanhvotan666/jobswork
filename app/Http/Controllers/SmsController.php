<?php

namespace App\Http\Controllers;

use App\Models\SmsOtp;
use App\Services\ZaloService;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    protected $zaloService;

    public function __construct(ZaloService $zaloService)
    {
        $this->zaloService = $zaloService;
    }

    public function sendSmsOtp(Request $request)
    {
        // return response()->json([
        //     'success' => false,
        //     'data' => 'Enter your phone!'
        // ]);
        
        if (!$request->has('phone')){
            return response()->json([
                'success' => false,
                'data' => 'Enter your phone!'
            ]);
        }

        $phone = $request->input('phone');
        $otp = random_int(100000, 999999);
        $message = "Otp của bạn là: $otp";
        SmsOtp::where('phone', $phone)->delete();
        SmsOtp::create([
            'phone' => $phone,
            'token' => $otp,
            'exopires_at' => now()->addMinutes(5),
        ]);

        // try {
        //     $result = $this->zaloService->sendMessageToPhone($phone, $otp);
        //     return response()->json(['data' => 'Otp sent your zalo phone!']);
        // } catch (\Throwable $th) {
        //     return response()->json(['data' => 'Error!']);
        // }
        return response()->json([
            'success' => false,
            'data' => 'Check your phone!'
        ]);
    }
}
