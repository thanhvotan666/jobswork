<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentInfo;
use Illuminate\Http\Request;

class PaymentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.paymentInfos.index', [
            'paymentInfos' => PaymentInfo::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.paymentInfos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required|min:4',
            'account_number' => 'required|min:9',
        ]);
        //qr_code
        if ($request->hasFile('qr_code')) {
            $image = $request->file('qr_code');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/qrcode'), $imageName);
            $data['qr_code'] = 'storage/image/qrcode/'.$imageName;
        }

        PaymentInfo::create($data);
        return  redirect()->route('admin.payment_info.index')->with("success",__("create payment infomation is success"));
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
        $data = $request->validate([
            'bank_name' => 'required',
            'account_name' => 'required|min:4',
            'account_number' => 'required|min:9',
        ]);
        $paymentInfo = PaymentInfo::findOrFail($id);
        //qr_code

        if ($request->hasFile('qr_code')) {
            $image = $request->file('qr_code');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/image/qrcode'), $imageName);
            $data['qr_code'] = 'storage/image/qrcode/'.$imageName;
        }

        $paymentInfo->update($data);
        return back()->with("success",__("update payment infomation is success"));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymentInfo = PaymentInfo::findOrFail($id);
        $paymentInfo->delete();
        return back()->with("success",__("delete payment infomation is success"));
    }
}
