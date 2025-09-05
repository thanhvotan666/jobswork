<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\GoogleEmployer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class GoogleEmployerController extends Controller
{
    public function checkLoginGoogleEmployer(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'code' => 'required|string',
        ]);

        $googleLogin = GoogleEmployer::where('email', $validated['email'])
                                     ->where('token', $validated['code'])
                                     ->first();

        if (!$googleLogin) {
            return back()->withErrors([
                'token' => __('invalid verification code'),
            ])->withInput();
        }

        if ($googleLogin->expires_at < now()) {
            $googleLogin->delete();
            return back()->withErrors([
                'token' => __('code is expired'),
            ])->withInput();
        }

        $employer = Employer::where('email', $googleLogin->email)->first();

        if (!$employer) {
             $googleLogin->delete();
            return back()->withErrors([
                'email' => __('email not found'),
            ])->withInput();
        }

        Auth::guard('employer')->login($employer);

        $googleLogin->used = true;
        $googleLogin->save();

        $request->session()->regenerate();
        return redirect()->intended(route('employer.dashboard.index'));
    }
    public function getGoogleEmployer(Request $request)
    {

        if (!$request->has('email')) {
            return response()->json([
                'message' => 'Email is required',
            ]);
        }

        if (Employer::where('email', $request->email)->exists()) {
            $email = $request->email;
            GoogleEmployer::where('email',$email)->delete();
            $token = rand(100000, 999999) . time();
            
            GoogleEmployer::create([
                'email' => $request->email,
                'token' => $token,
                'expires_at' => now()->addMinutes(10),
            ]);
            
            Mail::send(
                'mails.login_google_employer',
                ['token' => $token],
                function ($message) use ($email) {
                    $message->to($email);
                    $message->subject(__('Login with Google'));
                }
            );

            return response()->json([
                'message' => __('check email to login with google'),
            ]);
        } else {
            return response()->json([
                'message' => __('email not found'),
            ]);
        }
    }
}
