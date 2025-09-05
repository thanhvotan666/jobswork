<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            // Đăng nhập thành công
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'email' => 'incorrect login information',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout(); // Đăng xuất guard admin

        $request->session()->invalidate(); // Hủy session hiện tại
        $request->session()->regenerateToken(); // Tạo lại CSRF token mới

        return redirect()->route('admin.login')->with('success', __('logout completed')); // Chuyển hướng về trang login
    }

    public function categories()
    {
        return view('admin.categories.index');
    }
}
