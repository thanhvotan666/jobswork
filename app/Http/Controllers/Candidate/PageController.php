<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\RegistrationVerificationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function index()
    {       
        return view('candidate.index');
    }
    public function login()
    {
        return view('candidate.login');
    }
    public function register()
    {
        return view('candidate.register');
    }

    public function checkLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt($credentials)) {
            // Đăng nhập thành công
            $request->session()->regenerate();
            return redirect()->route('index');
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'email' => __('incorrect login information'),
        ])->withInput();
    }
    public function checkRegister(Request $request)
    {
        if (strlen($request->input('password')) < 8 ) {
            return response()->json([
                'message' => __('passwork must be at least 8 characters'),
            ]);
        }

        if (strlen($request->input('name')) < 5){
            return response()->json([
                'message' => __('name must be at least 5 characters'),
            ]);
        }

        if(User::where('email', $request->input('email'))->exists()){
            return response()->json([
                'message' => __('email already exists'),
            ]);
        }

        $validate = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if (!$request->has('code')) {
            return response()->json([
                'message' => __('code is required'),
            ]);
        }

        $veri = RegistrationVerificationUser::where('email', $request->input('email'))->first();

        if (!$veri) {
            return response()->json([
                'message' => __('not checked'),
            ]);
        }

        if ($veri->token !== $request->code) {
            return response()->json([
                'message' => __('invalid verification code'),
            ]);
        } else {
            $veri->delete();
        }


        $validate['password'] = Hash::make($request->input('password'));

        $imageName = '/image-' . time() . '.png';
        copy(
            public_path('storage/image/temp') . '/user.png',
            public_path('storage/image/user') . $imageName
        );
        $linkImage = 'storage/image/user' . $imageName;
        $validate['image'] = $linkImage;

        User::create($validate);

        return response()->json([
            'success' => true,
            'message' => __('registration successful'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout(); // Đăng xuất guard

        $request->session()->invalidate(); // Hủy session hiện tại
        $request->session()->regenerateToken(); // Tạo lại CSRF token mới

        return redirect()->route('candidate.login')->with('success', __('logout completed')); // Chuyển hướng về trang login
    }
}
