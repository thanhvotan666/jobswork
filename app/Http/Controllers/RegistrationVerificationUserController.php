<?php

namespace App\Http\Controllers;

use App\Models\RegistrationVerificationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class RegistrationVerificationUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json([
                'success' => false,
                'message' => __('email already registered'),
            ]);
        }
        // Delete previous token
        RegistrationVerificationUser::where('email', $request->email)->delete();
        $token = rand(100000, 999999);
        $expires_at = now()->addMinutes(10);
        $attempts = 0;
        RegistrationVerificationUser::create([
            'email' => $request->email,
            'token' => $token,
            'expires_at' => $expires_at,
            'attempts' => $attempts,
        ]);
        // Send email with token
        try {
            Mail::send('mails.registration_verification', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject(__('registration verification'));
            });
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => __('failed to send email'),
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => __('code sent to your email'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
