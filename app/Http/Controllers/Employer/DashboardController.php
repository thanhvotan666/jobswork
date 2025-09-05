<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $auth = auth()->guard('employer')->user();
        $labels = [];
        $allApplieds = [];
        $allViews = [];
        $employer = employer::find(auth()->guard('employer')->user()->id);
        $dateStart = '';
        if( $request->has('date-start') ){
            $dateStart = $request->input('date-start');
        }else{
            $dateStart = Carbon::now()->startOfWeek()->toDateString();
        }
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::parse($dateStart)->addDays($i);
            $labels[] = $date->format('d/m');
            
            $applieds = $employer
            ->jobs()
            ->with(['applieds' => function ($query) use ($date) {
                $query->whereDate('created_at', $date->toDateString());
            }])
            ->get()
            ->pluck('applieds')
            ->flatten();
            $allApplieds[] = $applieds->count();

            $views = $employer
            ->jobs()
            ->with(['views' => function ($query) use ($date) {
                $query->whereDate('created_at', $date->toDateString());
            }])
            ->get()
            ->pluck('views')
            ->flatten();
            $allViews[] = $views->count();
        }
        $chartData = [
            'labels' => $labels,
            'allApplieds' => $allApplieds,
            'allViews' => $allViews,
        ];

        
        return view('employer.dashboard.index', compact('auth','chartData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $auth = auth()->guard('employer')->user();
        return view('employer.dashboard.edit', compact('auth'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $auth = Employer::find(auth()->guard('employer')->id());
        //password
        if ($request->has('new_password')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->current_password, $auth->password)) {
                return back()->with('error', __('current password is incorrect'));
            }

            // Cập nhật mật khẩu mới
            $auth->password = Hash::make($request->new_password);
            $auth->save();

            return back()->with('success', __('change password is success'));
        }
        //image
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image',
            ]);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/employer'), $imageName);

            unlink(public_path($auth->image));

            $auth->image = "storage/image/employer/" . $imageName;
            $auth->save();

            return back()->with('success', __('change image is success'));
        }
        //name
        if ($request->has('name')) {
            $request->validate([
                'name' => 'required',
            ]);

            $auth->name = $request->name;
            $auth->save();

            return back()->with('success', __('change company is success'));
        }
        //phone
        if ($request->has('phone')) {
            $request->validate([
                'phone' => 'required',
            ]);

            $auth->phone = $request->phone;
            $auth->save();

            return back()->with('success', __('change phone is success'));
        }
        //register_name
        if ($request->has('register_name')) {
            $request->validate([
                'register_name' => 'required',
            ]);

            $auth->register_name = $request->register_name;
            $auth->save();

            return back()->with('success', __('change register name is success'));
        }
        //address
        if ($request->has('address')) {
            $request->validate([
                'address' => 'required',
            ]);

            $auth->address = $request->address;
            $auth->save();

            return back()->with('success', __('change address is success'));
        }
        //tax_code
        if ($request->has('tax_code')) {
            $request->validate([
                'tax_code' => 'required',
            ]);

            $auth->tax_code = $request->tax_code;
            $auth->save();

            return back()->with('success', __('change tax code is success'));
        }
        //website_url
        if ($request->has('website_url')) {
            $request->validate([
                'website_url' => 'nullable|url',
            ]);

            $auth->website_url = $request->website_url;
            $auth->save();

            return back()->with('success', __('updated is success'));
        }
        return back()->with('error', __('did not things'));
    }
}
