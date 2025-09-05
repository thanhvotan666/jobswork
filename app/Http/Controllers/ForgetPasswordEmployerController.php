<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\ForgetPasswordEmployer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordEmployerController extends Controller
{

    public function index(Request $request)
    {
        return view('employer.resetpassword');
    }
    public function store(Request $request)
    {
        if (!$request->has('email')) {
            return response()->json([
                'message' => 'Email is required',
            ]);
        }

        if (Employer::where('email', $request->email)->exists()) {
            ForgetPasswordEmployer::where('email', $request->email)->delete();
            $email = $request->email;
            $token = rand(100000, 999999) . time();

            ForgetPasswordEmployer::create([
                'email' => $request->email,
                'token' => $token,
                'expires_at' => now()->addMinutes(10),
            ]);
            $link = route('fp_employer.index', ['token' => $token]);

            Mail::send(
                'mails.forgetpassword',
                ['link' => $link],
                function ($message) use ($email) {
                    $message->to($email);
                    $message->subject(__('reset password employer'));
                }
            );

            return response()->json([
                'message' => __('sent email to reset password'),
            ]);
        } else {
            return response()->json([
                'message' => __('email not found'),
            ]);
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'new_password' => 'required|min:6|max:255',
            'confirm_password' => 'required|same:new_password',
        ]);
        $password = $request->new_password;
        $token =  $request->token;
        $vire = ForgetPasswordEmployer::where('token', $token)->first();
        if (!$vire) {
            return back()->with('error', 'Token not found');
        }

        if ($vire->expires_at < now()) {
            return back()->with('error', 'Token expired');
        }
        if (Employer::where('email', $vire->email)
            ->update(['password' => Hash::make($password)])
        ) {
            $vire->delete();
            return redirect()->route('employer.index')->with('success', 'Password has been changed');
        }
        return back()->with('error', 'Password not changed');
    }
}
