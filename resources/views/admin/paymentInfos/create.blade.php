@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('categories'))
@section('content')
    <main>
        <section>
            <div class="container-fluid px-5">
                <h2 class="mb-3">{{  __('create')." ".__('payment information')}}</h2>
                
                    <form action="{{ route('admin.payment_info.store') }}" method="POST" enctype="multipart/form-data"
                    class="container p-5 bg-white border rounded-4 ">
                          <div class="d-flex gap-5 justify-content-between">  
                            <div>
                                @csrf
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="bank_name" value="{{ old('bank_name') }}"
                                        required>
                                    <label>{{ __('bank name') }}</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="account_name" value="{{ old('account_name') }}"
                                        required>
                                    <label>{{ __('account name') }}</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="account_number" value="{{ old('account_number') }}"
                                        required>
                                    <label>{{ __('account number') }}</label>
                                </div>
                            </div>
                            <div>
                                <label>QR code</label>
                                <input type="file" class="form-control" name="qr_code" accept="image/*" onchange="changeQrCode(event)">
                                <img src="" alt="QR Code" class="img-fluid mt-2" style="max-width: 200px;" id="qrCodePreview">
                            </div>  
                        </div>         
                        <div class="d-flex justify-content-between mt-3">
                            <button type="submit" class="btn btn-success form-control" style="width: 200px ;">{{ __('create') }}</button>
                            <a href="{{ route('admin.payment_info.index') }}" class="btn btn-secondary">{{ __('cancel') }}</a>
                        </div>
                    </form>


            </div>
        </section>
    </main>
    <script>
        function changeQrCode(event) {
            const qrCodePreview = document.getElementById('qrCodePreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    qrCodePreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            } else {
                qrCodePreview.src = '';
            }
        }
    </script>
@endsection
