<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $cred = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (!$token = auth('api')->attempt($cred)) {
            return response()->json(['errors' => ['Email hoặc mật khẩu không đúng']], 401);
        }

        return response()->json([
            'token'   => $token,
        ]);
    }

public function me(Request $request)
{
    $user = auth('api')->user();

    return response()->json([
        'id'    => $user->id,
        'email' => $user->email,
        'name'  => $user->name,
        'phone' => $user->phone,
        'image' => $user->image,
    ]);
}

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Đăng xuất thành công']);
    }
    public function changePassword(Request $request)
    {
        $user = User::find(auth('api')->id());
        $request->only(['current_password', 'new_password']);
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['errors' => ['Mật khẩu hiện tại không đúng']], 400);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json(['message' => 'Đổi mật khẩu thành công']);
    }
}
