@extends('layouts.admin.index')
@section('title', __('customer care') . ' - ' . __('edit'))
@section('content')
    <main>
        <section>
            <div class="container-fluid px-5 mt-5">
                <div class="container p-5 bg-white border rounded-4">
                    <h1>{{ __('update') }} {{ __('customer care') }}</h1>
                    <form action="{{ route('admin.customer_care.update',$customerCare->id) }}" method="POST" class="bg-white rounded p-5">
                        @csrf
                        @method('PUT')
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name',$customerCare->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email',$customerCare->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">{{ __('phone') }}</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone',$customerCare->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('update') }}</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
