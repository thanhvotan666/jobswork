<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return response()->json(['errors' => ['Thông tin đăng nhập không chính xác']], 404);
    }

    // Xóa token cũ (nếu muốn chỉ đăng nhập 1 nơi)
    $user->tokens()->where('name', 'android_app')->delete();

    // Tạo token mới cho guard android
    $token = $user->createToken('android_app')->plainTextToken;

    return response()->json([
        'message' => 'Đăng nhập thành công',
        'user'    => [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'image' => $user->image,
        ],
        'token'   => $token,
    ], 200);
}

public function logout(Request $request)
{
    
    $check = User::findOrFail(auth('android')->id())
    ->tokens()
    ->where('name', 'android_app')
    ->delete();
    
    if (!$check) {
        return response()->json(['errors' => ['Token không hợp lệ hoặc đã hết hạn']], 401);
    }

    return response()->json(['message' => 'Đăng xuất thành công']);
}

public function me(Request $request)
{
    $user = auth('android')->user();

    return response()->json([
        'id'    => $user->id,
        'email' => $user->email,
        'name'  => $user->name,
        'phone' => $user->phone,
        'image' => $user->image,
    ]);
}

}
