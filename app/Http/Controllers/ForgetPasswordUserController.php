<?php

namespace App\Http\Controllers;

use App\Models\ForgetPasswordUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordUserController extends Controller
{
    public function index()
    {
        return view('candidate.resetpassword');
    }

    public function store(Request $request)
    {
        if (!$request->has('email')) {
            return response()->json([
                'message' => __('email is required'),
            ]);
        }

        if (User::where('email', $request->email)->exists()) {
            ForgetPasswordUser::where('email', $request->email)->delete();
            $email = $request->email;
            $token = rand(100000, 999999) . time();

            ForgetPasswordUser::create([
                'email' => $request->email,
                'token' => $token,
                'expires_at' => now()->addMinutes(10),
            ]);
            $link = route('fp_user.index', ['token' => $token]);

            Mail::send(
                'mails.forgetpassword',
                ['link' => $link],
                function ($message) use ($email) {
                    $message->to($email);
                    $message->subject(__('reset password user'));
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
        $vire = ForgetPasswordUser::where('token', $token)->first();
        if (!$vire) {
            return back()->with('error', __('token not found'));
        }

        if ($vire->expires_at < now()) {
            return back()->with('error', __('token expired'));
        }
        if (User::where('email', $vire->email)
            ->update(['password' => Hash::make($password)])
        ) {
            $vire->delete();
            return redirect()->route('index')->with('success', __('password has been changed'));
        }
        return back()->with('error', __('password not changed'));
    }
}
