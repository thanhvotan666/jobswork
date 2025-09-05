<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    public function sendVerificationCode(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(['success' => false, 'message' => __('email already registered')]);
        }
        $email = $request->email;
        $code = rand(100000, 999999); // Generate a 6-digit verification code

        // Save the code in the session or database
        session(['verification_code' => $code]);

        try {
            Mail::send([], [], function ($message) use ($email, $code) {
                $message->to($email)
                    ->subject('registration verification code')
                    ->setBody( __("your verification code is").": $code");
            });

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => __('Email could not be sent. Please try again later.')]);
        }
    }
}
