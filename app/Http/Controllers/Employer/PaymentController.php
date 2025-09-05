<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Service;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


class PaymentController extends Controller
{
    public function momo(Request $request){
        $endpoint = env('MOMO_ENDPOINT');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey = env('MOMO_ACCESS_KEY');
        $secretKey = env('MOMO_SECRET_KEY');

        $orderId = time(); // Mã đơn hàng
        $amount = $request->input('amount'); // Số tiền cần thanh toán
        $orderInfo = "Thanh toán đơn hàng #$orderId";
        $redirectUrl = env('MOMO_REDIRECT_URL');
        $ipnUrl = env('MOMO_IPN_URL');
        $extraData = ""; 

        $requestId = time() . "";
        $requestType = "captureWallet";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MoMoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        $response = Http::post($endpoint, $data);
        return redirect($response['payUrl']);
    }

    public function vnpay(Request $request)
    {
        $employer = auth()->guard("employer")->user();
        if(!$employer){
            return redirect()->back()->with("error","error");
        }
        $vnp_TmnCode = "BEOLHNO9";
        $vnp_HashSecret = "9UF9EOK7KLCM8VCJWS1ISJY7KXJSI5QN";
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('employer.vnpayReturn'); // URL trả về sau thanh toán

        $vnp_OrderInfo = __("order payment");
        $vnp_OrderType = 'billpayment';

        $vnp_Locale = app()->getLocale();
        $vnp_BankCode = '';

        
        $quantityDetails = [];
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'quantity_') === 0) {
            $keyId = substr($key, 9);
            $quantityDetails[$keyId] = $value;
            }
        }

        $order = Order::create([
            'employer_id' => $employer->id,
            'employer_name' => $employer->name,
            'employer_email' => $employer->email,
            'employer_phone' => $employer->phone,
            'name' => $vnp_OrderInfo,
            'type'=> $vnp_OrderType,
            'amount' => 0,
            'locale' => $vnp_Locale,
            'bankCode' => $vnp_BankCode,
        ]);

        $amount = 0;
        foreach ($quantityDetails as $id => $quantity) {
            if(!$quantity){
                continue;
            }

            $product = Product::find($id);
            $price = $product->price_discount ?? $product->price;
            OrderDetail::create([
                'order_id' => $order->id,
                'quantity' => $quantity,
                'service_id' => $product->service_id,
                'name' => $product->name,
                'price' => $price,
                'total' => $price * $quantity,
            ]);
            $amount += $price * $quantity;
        }

        $vnp_Amount = $amount * 100; // Số tiền (VND) nhân 100
        $vnp_TxnRef = $order->id;
        $startTime = date("YmdHis");
        $expire = date('YmdHis', strtotime('+435 minutes', strtotime($startTime)));
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $startTime,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => request()->ip(),
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate"=> $expire
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        $orderId = $request->input('vnp_TxnRef');
        $employer = Employer::find(auth()->guard('employer')->id());
        $order = Order::findOrFail($orderId);
        if ($request->vnp_ResponseCode == '00') {
            $amount = $order->orderDetails->pluck('total')->sum();
            $order->is_paid = true;
            $order->amount = $amount;
            $order->save();

            foreach ($order->orderDetails as $orderDetail) {
                $product = Product::where('name', $orderDetail->name)->first();
                if($orderDetail->service_id == null){
                    $quantityGem = $orderDetail->quantity * $product->quantity;
                    $employer->point += $quantityGem;
                    $employer->save();
                    $serRes = [
                        'employer_id' => $employer->id,
                        'order_id' => $order->id,
                        'quantity' => $quantityGem,
                    ];
                    $employer->logServices()->create($serRes);
                    continue;
                }
                $registration = $employer->registrations()->where('service_id' , $orderDetail->service_id)->first();
                if($registration){
                    $is_expired = $registration->expired < now();
                    if($is_expired){
                        $registration->expired = now();
                        $registration->created_at = now();
                    }
                    $expired = Carbon::parse($registration->expired)
                        ->addDays($product->quantity * $orderDetail->quantity);
                    $registration->update([
                        'expired' => $expired, 
                        'created_at' => $registration->created_at
                    ]);
                    $serRes = [
                        'employer_id' => $employer->id,
                        'service_id' => $orderDetail->service_id,
                        'expired' => $expired,
                    ];
                    $serRes['order_id'] = $order->id;
                    $serRes['quantity'] = $orderDetail->quantity;
                    if($is_expired){
                        $serRes['start'] = now();
                    }else{
                        $serRes['start'] = Carbon::parse($registration->created_at);
                    }
                    $employer->logServices()->create($serRes);
                }else{
                    $expired = now()->addDays($product->quantity * $orderDetail->quantity);
                    $serRes = [
                        'employer_id' => $employer->id,
                        'service_id' => $orderDetail->service_id,
                        'expired' => $expired,
                    ];
                    $employer->registrations()->create($serRes);
                    $serRes['order_id'] = $order->id;
                    $serRes['quantity'] = $product->quantity * $orderDetail->quantity;
                    $serRes['start'] = now();
                    $employer->logServices()->create($serRes);
                }
            }

            return redirect()->route('employer.orders.index')
                                ->with('success', __('payment and order update successful'));
        } else {
            $order->delete();
            return redirect()->route('employer.orders.create')
                             ->with('error', __('payment failed'));
        }
    }
}
