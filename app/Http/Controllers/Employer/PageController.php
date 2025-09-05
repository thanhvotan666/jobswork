<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\EmployerPending;
use App\Models\RegistrationVerificationEmployer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employer.index');
    }
    public function login()
    {
        return view('employer.login');
    }
    public function register()
    {
        return view('employer.register');
    }
    public function checkLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('employer')->attempt($credentials)) {
            // Đăng nhập thành công
            $request->session()->regenerate();
            return redirect()->route('employer.dashboard.index');
        }

        $pending = EmployerPending::where('email', $credentials['email'])
        ->where('status', 'pending')
        ->first();
        if ($pending) {
            return back()->withErrors([
                'email' => __('your recruitment account is pending approval'),
            ])->withInput();
        }

        // Đăng nhập thất bại
        return back()->withErrors([
            'email' => __('incorrect login information'),
        ])->withInput();
    }
    public function checkRegister(Request $request)
    {

        $validate = $request->validate([
            'email' => 'required|email|unique:employers,email',
            'password' => 'required|min:8',
            'name' => 'required',
            'phone' => 'required',
            'register_name' => 'required',
            'address' => 'required',
            'tax_code' => 'nullable',
        ]);

        $request->validate([
            'code' => 'required'
        ]);

        $veri = RegistrationVerificationEmployer::where('email', $request->input('email'))->first();

        if (!$veri) {
            return back()->with('error', __('not checked email'));
        }

        if ($veri->expires_at < now()) {
            return back()->with('error', __('code is expired'));
        }
        $code = $request->code;
        if ($veri->token !== $code) {
            return back()->with('error', __('invalid verification code'));
        } else {
            $veri->delete();
        }

        $validate['password'] = Hash::make($request->input('password'));

        $imageName = '/image-' . time() . '.png';
        copy(
            public_path('storage/image/temp') . '/employer.png',
            public_path('storage/image/employer') . $imageName
        );
        $linkImage = 'storage/image/employer' . $imageName;
        $validate['image'] = $linkImage;

        $employer = EmployerPending::create($validate);
        $email = $employer->email;
        Mail::send(
            'mails.registration_employer',
            [],
            function ($message) use ($email) {
                $message->to($email);
                $message->subject(__('register successfully'));
            }
        );

        return redirect()->route('employer.index')->with('success', __('register is success'). ', ' .__('your recruitment account is pending approval'));
    }
    public function logout(Request $request)
    {
        Auth::guard('employer')->logout(); // Đăng xuất guard

        $request->session()->invalidate(); // Hủy session hiện tại
        $request->session()->regenerateToken(); // Tạo lại CSRF token mới

        return redirect()->route('employer.index')->with('success', __('logout completed')); // Chuyển hướng về trang login
    }

}
