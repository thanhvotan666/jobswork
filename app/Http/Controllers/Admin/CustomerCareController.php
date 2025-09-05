<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerCare;
use App\Models\Support;
use Illuminate\Http\Request;

class CustomerCareController extends Controller
{
    public function index(Request $request)
    {
        if (!auth('admin')->user()->admin) {
            return back()->with('error', __('this function is not available'));
        }
        $query = CustomerCare::query();

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        $customerCares = $query->paginate(10);

        return view('admin.customer_cares.index', compact(
            'customerCares',
        ));
    }

    public function show(string $id)
    {
        if (!auth('admin')->user()->admin) {
            return back()->with('error', __('this function is not available'));
        }
        $customerCare = CustomerCare::findOrFail($id);

        $supports = $customerCare->supports()->paginate(10);

        return view('admin.customer_cares.show', compact(
            'customerCare',
            'supports',
        ));
    }


    public function create()
    {
        return view('admin.customer_cares.create');
    }
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|min:6|max:13'
            ]);
        CustomerCare::create($validateData);
        return redirect()->route('admin.customer_care.index')->with('success', __('customer care create successfully'));
    }
    public function edit(string $id)
    {
        $customerCare = CustomerCare::find($id);
        return view('admin.customer_cares.edit',compact('customerCare'));
    }
    public function update(Request $request, string $id)
    {
        $customerCare = CustomerCare::find($id);
        if($request->has('_support')){
            Support::updateOrCreate(
                ['employer_id' => $request->employer_id],
                    ['customer_care_id' => $customerCare->id]
            );
            return back()->with('success', __('more success'));
        }

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|min:6|max:13'
            ]);
        $customerCare->update($validateData);
        return back()->with('success', __('customer care updated successfully'));
    }
    public function destroy(string $id,Request $request)
    {
        $customerCare = CustomerCare::findOrFail($id);
        if($request->has('_support')){
            $support = $customerCare->supports()->findOrFail($request->input('_support'));
            $support->delete();
            return back()->with('success', __('deleted is successfully'));
        }else{
            $customerCare->delete();
        }
        return back()->with('success', __('deleted is successfully'));
    }
}
