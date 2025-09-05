<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employer = Employer::find(auth()->guard("employer")->user()->id);
        
        $orders = $employer->orders()->orderBy('created_at', 'desc')->get();
        $logServices = $employer->logServices;

        return view("employer.orders.index", compact("orders",'logServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('is_gem')->get();
        
        return view("employer.orders.create",compact("products"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if ($request->vnp_ResponseCode == '00') {
            return "Thanh toán thành công!";
        } else {
            return "Thanh toán thất bại!";
        }
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
        $order = Order::findOrFail($id);
        if($request->status == "paid"){
            $amount = $order->orderDetails->pluck('total')->sum();
            $order->is_paid = true;
            $order->amount = $amount;
            $order->save();    
        }
        return response()->json([
            'message' => 'Cập nhật đơn hàng thành công!',
            'order' => $order
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
