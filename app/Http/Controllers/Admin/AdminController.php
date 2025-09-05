<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->guard('admin')->user()->admin) {
            return back()->with('error', __('this function is not available'));
        }
        $perPage = $request->input('per_page', 10);
        $query = Admin::query();

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->has('email')) {
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }
        if ($request->has('admin')) {
            $query->where('admin', $request->input('admin'));
        }
        if ($request->has('service')) {
            $query->where('service', $request->input('service'));
        }
        if ($request->has('candidate')) {
            $query->where('candidate', $request->input('candidate'));
        }
        if ($request->has('employer')) {
            $query->where('employer', $request->input('employer'));
        }

        $admins = $query->paginate($perPage);

        return view('admin.admins.index', compact(
            'admins',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->guard('admin')->user()->admin) {
            return back()->with('error', __('this function is not available'));
        }
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->guard('admin')->user()->admin) {
            return back()->with('error', __('this function is not available'));
        }
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
            'admin' => 'boolean',
            'service' => 'boolean',
            'candidate' => 'boolean',
            'employer' => 'boolean',
        ]);

        // Handle file upload if present
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/admin'), $imageName);
        }

        // Create a new Admin record
        Admin::create([
            'name' => $request->input('name'),
            'image' => 'storage/image/admin/' . $imageName,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'admin' => $request->boolean('admin'),
            'service' => $request->boolean('service'),
            'candidate' => $request->boolean('candidate'),
            'employer' => $request->boolean('employer'),
        ]);

        // Redirect with success message
        return redirect()->route('admin.admins.index')->with('success', __('admin created successfully'));
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
        if (!auth()->guard('admin')->user()->admin) {
            return back()->with('error', __('this function is not available'));
        }
        $admin = Admin::find($id);
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->guard('admin')->user()->admin) {
            return back()->with('error', __('this function is not available'));
        }
        $user = Admin::find($id);
        if (!$user) {
            return back()->with('error', __('admin not found'));
        }
        if ($request->has('new_email')) {
            $request->validate([
                'new_email' => 'required|email',
            ]);

            $user->email = $request->new_email;
            $user->save();

            return back()->with('success', __('change email is success'));
        }
        if ($request->has('new_name')) {
            $request->validate([
                'new_name' => 'required',
            ]);

            $user->name = $request->new_name;
            $user->save();

            return back()->with('success', __('change email is success'));
        }
        if ($request->hasFile('new_image')) {
            $request->validate([
                'new_image' => 'required|image',
            ]);

            $image = $request->file('new_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/admin'), $imageName);

            unlink(public_path($user->image));

            $user->image = "storage/image/admin/" . $imageName;
            $user->save();

            return back()->with('success', __('change image is success'));
        }
        if ($request->has('new_password')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', __('current password is incorrect'));
            }

            // Cập nhật mật khẩu mới
            $user->password = Hash::make($request->new_password);
            $user->save();

            return back()->with('success', __('change password is success'));
        }
        if ($request->has('new_password_order')) {
            $request->validate([
                'new_password_order' => 'required|min:8',
                'confirm_password_order' => 'required|same:new_password_order',
            ]);

            // Cập nhật mật khẩu mới
            $user->password = Hash::make($request->new_password_order);
            $user->save();

            return back()->with('success', __('change password is success'));
        }
        if ($request->has('function')) {

            $validateData = $request->validate([
                'admin' => 'boolean',
                'service' => 'boolean',
                'candidate' => 'boolean',
                'employer' => 'boolean',
            ]);
            $validateData['admin'] = $validateData['admin'] ?? false;
            $validateData['service'] = $validateData['service'] ?? false;
            $validateData['candidate'] = $validateData['candidate'] ?? false;
            $validateData['employer'] = $validateData['employer'] ?? false;
            $user->update($validateData);

            return back()->with('success', __('change function is success'));
        }

        return back()->with('error', __('did not things'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->guard('admin')->user()->admin) {
            return back()->with('error', __('this function is not available'));
        }
        $user = Admin::find($id);
        if (!$user) {
            return back()->with('error', __('admin not found'));
        }
        $user->delete();
        return back()->with('success', __('delete admin is success'));
    }
}