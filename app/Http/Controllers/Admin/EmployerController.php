<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\LogService;
use App\Models\Service;
use App\Models\ServiceRegistration;
use App\Models\Support;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->guard('admin')->user()->employer) {
            return back()->with('error', __('this function is not available'));
        }
        $perPage = $request->input('per_page', 10);
        $query = Employer::query();

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }
        if ($request->has('email')) {
            $query->where('email', 'LIKE', '%' . $request->input('email') . '%');
        }

        $employers = $query->paginate($perPage);

        return view('admin.employers.index', compact(
            'employers',
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->guard('admin')->user()->employer) {
            return back()->with('error', __('this function is not available'));
        }
        return view('admin.employers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->guard('admin')->user()->employer) {
            return back()->with('error', __('this function is not available'));
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image',
            'email' => 'required|email|unique:employers,email',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:15',
            'register_name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'tax_code' => 'nullable|string|max:50',
        ]);

        // Handle file upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/employer'), $imageName);
        } else {
            $imageName = time() . '.png';
            copy(
                public_path('storage/image/temp') . '/employer.png',
                public_path('storage/image/employer/') . $imageName
            );
        }

        // Create the employer record
        $employer = Employer::create([
            'name' => $request->input('name'),
            'image' =>  'storage/image/employer/' . $imageName,
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
            'register_name' => $request->input('register_name'),
            'address' => $request->input('address'),
            'tax_code' => $request->input('tax_code'),
        ]);
        $employer->support()->create(['customer_care_id'=>1]);
        // Redirect to employer list with success message
        return redirect()->route('admin.employers.index')->with('success', __('employer created successfully'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!auth()->guard('admin')->user()->employer) {
            return back()->with('error', __('this function is not available'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!auth()->guard('admin')->user()->employer) {
            return back()->with('error', __('this function is not available'));
        }
        $employer = Employer::find($id);
        if (!$employer) {
            return back()->with('error', __('employer not found'));
        }
        return view('admin.employers.edit', compact('employer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!auth()->guard('admin')->user()->employer) {
            return back()->with('error', __('this function is not available'));
        }
        $employer = Employer::find($id);
        if (!$employer) {
            return back()->with('error', __('employer not found'));
        }
        if ($request->has('new_email')) {
            $request->validate([
                'new_email' => 'required|email',
            ]);

            $employer->email = $request->new_email;
            $employer->save();

            return back()->with('success', __('change email is success'));
        }
        if ($request->has('new_name')) {
            $request->validate([
                'new_name' => 'required',
            ]);

            $employer->name = $request->new_name;
            $employer->save();

            return back()->with('success', __('change name is success'));
        }
        if ($request->hasFile('new_image')) {
            $request->validate([
                'new_image' => 'required|image',
            ]);

            $image = $request->file('new_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/employer'), $imageName);

            unlink(public_path($employer->image));

            $employer->image = "storage/image/employer/" . $imageName;
            $employer->save();

            return back()->with('success', __('change image is success'));
        }
        if ($request->has('new_password')) {
            $request->validate([
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            // Kiểm tra mật khẩu hiện tại
            if (!Hash::check($request->current_password, $employer->password)) {
                return back()->with('error', __('current password is incorrect'));
            }

            // Cập nhật mật khẩu mới
            $employer->password = Hash::make($request->new_password);
            $employer->save();

            return back()->with('success', __('change password is success'));
        }

        if ($request->has('new_phone')) {
            $request->validate([
                'new_phone' => 'required',
            ]);

            $employer->phone = $request->new_phone;
            $employer->save();

            return back()->with('success', __('change phone is success'));
        }

        if ($request->has('new_register_name')) {
            $request->validate([
                'new_register_name' => 'required',
            ]);

            $employer->register_name = $request->new_register_name;
            $employer->save();

            return back()->with('success', __('change register name is success'));
        }

        if ($request->has('new_address')) {
            $request->validate([
                'new_address' => 'required',
            ]);

            $employer->address = $request->new_address;
            $employer->save();

            return back()->with('success', __('change address is success'));
        }

        if ($request->has('new_tax_code')) {
            $request->validate([
                'new_tax_code' => 'required',
            ]);

            $employer->tax_code = $request->new_tax_code;
            $employer->save();

            return back()->with('success', __('change tax code is success'));
        }
        if ($request->has('new_website_url')) {
            $request->validate([
                'new_website_url' => 'nullable|url',
            ]);

            $employer->website_url = $request->new_website_url;
            $employer->save();

            return back()->with('success', __('updated is success'));
        }

        if ($request->has('customer_care_id')) {
            $request->validate([
                'customer_care_id' => 'required|exists:customer_cares,id',
            ]);

            Support::updateOrCreate(
                ['employer_id' => $employer->id],
                    ['customer_care_id' => $request->customer_care_id]
            );

            return back()->with('success', __('updated is success'));
        }

        if ($request->has('new_service')) {
            $request->validate([
                'new_service' => 'required',
                'expired' => 'required|numeric|min:1',
                'unit' => 'required|in:day,month,year',
            ]);

            $service = Service::find($request->new_service);
            if (!$service) {
                return back()->with('error', __('service not found'));
            }

            $expired = $request->expired;
            if ($request->unit == 'month') {
                $expired *= 30;
            } elseif ($request->unit == 'year') {
                $expired *= 365;
            }

            $employer->registrations()->create([
                'admin_id' => auth()->guard('admin')->id(),
                'service_id' => $service->id,
                'expired' => now()->addDays($expired),
            ]);

            $employer->logServices()->create([
                'start'=> now(),
                'expired' => now()->addDays($expired),
                'service_id' => $service->id,
            ]);

            return back()->with('success', 'add service is success');
        }
        //registration_id
        if ($request->has('registration_id')) {
            $request->validate([
                'registration_id' => 'required|exists:service_registrations,id',
                'expired' => 'required|numeric|min:1',
                'unit' => 'required|in:day,month,year',
            ]);

            $serviceRegistration = ServiceRegistration::find($request->registration_id);

            $expired = $request->expired;
            if ($request->unit == 'month') {
                $expired *= 30;
            } elseif ($request->unit == 'year') {
                $expired *= 365;
            }
            if ($serviceRegistration->expired < now()) {
                $serviceRegistration->created_at = now();
                $serviceRegistration->expired = now()->addDays($expired);
                $employer->logServices()->create([
                    'start'=> now(),
                    'expired' => $serviceRegistration->expired,
                    'service_id' => $serviceRegistration->id
                ]);
            } else {
                $serviceRegistration->expired = Carbon::parse($serviceRegistration->expired)->addDays($expired);
                $employer->logServices()->create([
                    'start'=> $serviceRegistration->created_at,
                    'expired' => $serviceRegistration->expired,
                    'service_id' => $serviceRegistration->id
                ]);
            }
            $serviceRegistration->save();

            return back()->with('success', __('edit service is success'));
        }
        if ($request->has('delete_service')) {
            $request->validate([
                'delete_service' => 'required|exists:service_registrations,id',
            ]);

            if ($employer->registrations()
                ->find($request->delete_service)
                ->delete()
            ) {
                return back()->with('success', __('delete service is success'));
            }
        }
        if ($request->has('description')) {
            $validateData = $request->validate([
                'description'=> 'nullable',
                'employee_count' => 'nullable',
                'average_age' => 'nullable',
            ]);
            $employer->update($validateData);
            return back()->with('success',__('update is success'));
        }

        return back()->with('error', __('did not things'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!auth()->guard('admin')->user()->employer) {
            return back()->with('error', __('this function is not available'));
        }
        $employer = Employer::find($id);
        if (!$employer) {
            return back()->with('error', __('employer not found'));
        }
        try {
            $img = $employer->image;
            $employer->delete();

            unlink(public_path($img));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return back()->with('success', __('delete employer is success'));
    }
}
