@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('product list'))
@section('content')
    <main>
        <section>
            <div class="container-fluid d-flex flex-column gap-4 ">
                <form class="p-5 d-flex flex-column gap-4" action="{{ route('admin.product.store') }}" method="POST">
                    @csrf
                    <div class="d-flex justify-content-between">
                        <div class="h2 fw-bold ">
                            {{ __('product list') }}
                        </div>
                        <button class="h2 fw-bold btn btn-success px-3">
                            {{ __('save') }}
                        </a>
                    </div>
                    <div class="mb-3">
                        <label for="service_id" class="form-label">{{ __('service package') }}</label>
                        <select name="service_id" id="service_id" class="form-select" required>
                            @php
                                $services = \App\Models\Service::all();
                            @endphp
                            <option value="0" @selected(old('service_id') == 0)>Workpoint</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" @selected(old('service_id') == $service->id)>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('name') }} <sup class="text-danger">*</sup></label>
                        <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" required placeholder="EX: Vip 1 Month; Workpoint *1000">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">{{ __('image') }}</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">{{ __('list price') }} <sup class="text-danger">*</sup></label>
                        <input type="number" class="form-control"  value="{{ old('price') }}" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="price_discount" class="form-label">{{ __('promotional price') }}</label>
                        <input type="number" class="form-control"  value="{{ old('price_discount') }}" id="price_discount" name="price_discount">
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">{{ __('quantity') }} <sup class="text-danger">*</sup> ({{ __('days') }}, Workpoint)</label>
                        <input type="number" class="form-control"  value="{{ old('quantity') }}" id="quantity" name="quantity" required placeholder="EX: 1000; 10000">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description')}}</textarea>
                    </div>
                    
                </form>
            </div>
        </section>
    </main>
@endsection