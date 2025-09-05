@extends('layouts.employer.index')

@section('title', request()->getHost() . ': '. __('payment information'))

@section('breadcrumb-item')
    <li class="breadcrumb-item">
        {{__('payment information')}}
    </li>
@endsection

@section('content')
    <main>
        <div class="container-fluid">
            <div class="container mt-5">
                <h2 class="mb-4">{{__('payment information')}}</h2>
        
                @forelse ($paymentInfos as $paymentInfo)
                        <div class="card shadow-sm">
                        <div class="card-body d-flex flex-wrap">
                            <div class="col-md-6 p-4">
                                <h4 class="card-title">{{__('Bank')}}: {{ $paymentInfo->bank_name }}</h4>
                                <p><strong>{{__('Account Holder Name')}}:</strong> {{ $paymentInfo->account_name }}</p>
                                <p><strong>{{__('Account Number')}}:</strong> {{ $paymentInfo->account_number }}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <div class="mb-3">
                                    <img src="
                                    {{
                                    $paymentInfo->qr_code ?
                                    asset($paymentInfo->qr_code)
                                    :
                                    "https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1024px-QR_code_for_mobile_English_Wikipedia.svg.png"
                                    }}
                                    "
                                        alt="QR Code" class="img-fluid border rounded" width="250">
                                    <p class="mt-2">{{__('scan QR code to pay')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info" role="alert">
                        {{ __('no payment information available') }}.
                    </div>
                @endforelse
            </div>
        </div>
    </main>
@endsection