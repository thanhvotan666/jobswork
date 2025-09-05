<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerCare;
use App\Models\Employer;
use App\Models\EmployerPending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;

class EmployerPendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EmployerPending::query();

        if($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $employers = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.employer_pending.index', compact('employers'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employer = EmployerPending::findOrFail($id);

        if ($request->status == 'approved') {
            if ($employer->status == 'approved' || Employer::where('email', $employer->email)->exists()) {
                return back()->with('error', __('existing employer'));
            }
            $create = Employer::create([
                'email' => $employer->email,
                'password' => $employer->password,
                'image' => $employer->image,
                'name' => $employer->name,
                'phone' => $employer->phone,
                'register_name' => $employer->register_name,
                'address' => $employer->address,
                'tax_code' => $employer->tax_code,
            ]);
            $customerCare = CustomerCare::inRandomOrder()->first();
            $create->support()->create(['customer_care_id'=> $customerCare->id]);

            Mail::send(
                'mails.employer_registration_approved',
                [
                    'name' => $employer->name,
                    'customerCare' => $customerCare
                ],
                function ($message) use ($employer) {
                    $message->to($employer->email);
                    $message->subject(__('employer registration approved'));
                }
            );
        }

        if ($request->status == 'rejected') {
            $description = $request->input('description');
            $employer->description = $description;
            Mail::send(
                'mails.employer_registration_rejected',
                [
                    'name' => $employer->name,
                    'description' => $description
                ],
                function ($message) use ($employer) {
                    $message->to($employer->email);
                    $message->subject(__('employer registration rejected'));
                }
            );
        }

        $employer->status = $request->status;
        $employer->admin_id = auth('admin')->id();
        $employer->save();
        return back()->with('success', __('updated is success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
