@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('product list'))
@section('content')
    <main>
        <section>
            <div class="container-fluid d-flex flex-column gap-4 ">
                <form class="p-5 d-flex flex-column gap-4" action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-between">
                        <div class="h2 fw-bold ">
                            {{ __('edit product') }}
                        </div>
                        <button class="h2 fw-bold btn btn-success px-3">
                            {{ __('update') }}
                        </button>
                    </div>
                    <div class="mb-3">
                        <label for="service_id" class="form-label">{{ __('service package') }}</label>
                        <select name="service_id" id="service_id" class="form-select" required>
                            @php
                                $services = \App\Models\Service::all();
                            @endphp
                            <option value="0" {{ old('service_id',$product->service_id)  == 0 ? 'selected' : '' }}>Workpoint</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{  old('service_id',$product->service_id) == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('name') }} <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" value="{{ old('name', $product->name) }}" id="name" name="name" required placeholder="EX: Vip 1 Month; Workpoint *1000">
                    </div>
                    <script>
                        function showImage(input) {
                            if (input.files && input.files[0]) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    document.getElementById('image_show').src = e.target.result;
                                };
                                reader.readAsDataURL(input.files[0]);
                            }
                        }
                    </script>
                    <div class="mb-3">
                        <label for="image" class="form-label">{{ __('image') }}</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="showImage(this)">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" id="image_show" class="img-thumbnail mt-2" style="max-width: 150px;">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">{{ __('list price') }} <sup class="text-danger">*</sup></label>
                        <input type="number" class="form-control" value="{{ old('price', $product->price) }}" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="price_discount" class="form-label">{{ __('promotional price') }}</label>
                        <input type="number" class="form-control" value="{{ old('price_discount', $product->price_discount) }}" id="price_discount" name="price_discount">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">{{ __('quantity') }} <sup class="text-danger">*</sup></label>
                        <input type="number" class="form-control" value="{{ old('quantity', $product->quantity) }}" id="quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $product->description) }}</textarea>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection