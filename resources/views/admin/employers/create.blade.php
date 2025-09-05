@extends('layouts.admin.index')
@section('title', request()->getHost() . ': ' . __('employer') . ' - ' . __('create'))
@section('content')
    <main>
        <div class="container">
            <h1>{{ __('create') }} {{ __('employer') }}</h1>
            <form action="{{ route('admin.employers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('name') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">{{ __('image') }}</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                        name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('password') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('phone') }}</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- User Name -->
                <div class="mb-3">
                    <label for="register_name" class="form-label">{{ __('register name') }}</label>
                    <input type="text" class="form-control @error('register_name') is-invalid @enderror"
                        id="register_name" name="register_name" value="{{ old('register_name') }}" required>
                    @error('register_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('address') }}</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tax Code -->
                <div class="mb-3">
                    <label for="tax_code" class="form-label">{{ __('tax code') }}</label>
                    <input type="text" class="form-control @error('tax_code') is-invalid @enderror" id="tax_code"
                        name="tax_code" value="{{ old('tax_code') }}">
                    @error('tax_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ __('create') }}</button>
            </form>
        </div>
    </main>
@endsection
