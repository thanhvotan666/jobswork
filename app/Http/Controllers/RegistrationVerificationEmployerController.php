<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\EmployerPending;
use App\Models\RegistrationVerificationEmployer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegistrationVerificationEmployerController extends Controller
{
    public function store(Request $request)
    {
        $employer = Employer::where('email', $request->email)->exists();
        if ($employer) {
            return response()->json([
                'success' => false,
                'message' => __('email already registered'),
            ]);
        }
        // Delete previous token
        RegistrationVerificationEmployer::where('email', $request->email)->delete();
        $token = rand(100000, 999999);
        $expires_at = now()->addMinutes(10);
        $attempts = 0;
        RegistrationVerificationEmployer::create([
            'email' => $request->email,
            'token' => $token,
            'expires_at' => $expires_at,
            'attempts' => $attempts,
        ]);
        // Send email with token
        try {
            Mail::send(
                'mails.registration_verification',
                ['token' => $token],
                function ($message) use ($request) {
                    $message->to($request->email);
                    $message->subject(__('registration verification'));
                }
            );
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
