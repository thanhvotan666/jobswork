@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('payment information'))
@section('content')
    <main>
        <section class="container-fluid px-5 d-flex justify-content-between align-items-center mb-3">
            <h2>{{  __('payment information')}}</h2>
            <a href="{{ route('admin.payment_info.create') }}" class="btn btn-primary">{{ __('create') }} {{__('new')}} +</a>
        </section>
        @foreach ($paymentInfos as $paymentInfo)
        <section>
            <div class="container-fluid px-5 mb-3">
                <form action="{{ route('admin.payment_info.update', $paymentInfo->id) }}" method="POST" enctype="multipart/form-data"
                class="container p-5 bg-white border rounded-4">
                    <div class="d-flex gap-5 justify-content-between">
                        <div>
                            @csrf
                            @method('PUT')
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="bank_name" value="{{ $paymentInfo->bank_name }}"
                                    required>
                                <label>{{ __('bank name') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="account_name" value="{{ $paymentInfo->account_name }}"
                                    required>
                                <label>{{ __('account name') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="account_number" value="{{ $paymentInfo->account_number }}"
                                    required>
                                <label>{{ __('account number') }}</label>
                            </div>
                        </div>
                        <div>
                            <label>QR code</label>
                            <input type="file" class="form-control" name="qr_code" accept="image/*" onchange="changeQrCode(event)">
                            <img src="{{ asset($paymentInfo->qr_code) }}" alt="QR Code" class="img-fluid mt-2" style="max-width: 200px;" id="qrCodePreview">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-success form-control" style="width: 200px ;">{{ __('update') }}</button>
                        <form action=""></form>
                        <form action="{{ route('admin.payment_info.destroy', $paymentInfo->id) }}" method="POST" onsubmit="return confirm('{{ __('are you sure you want to delete this payment information?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger form-control mt-2" style="width: 200px;">{{ __('delete') }}</button>
                        </form>
                    </div>
                </form>     
            </div>
        </section>
        @endforeach
       
    </main>
@endsection
