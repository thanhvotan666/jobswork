@extends('layouts.admin.index')
@section('title', request()->getHost() . ': ' . __('admin') . ' - ' . __('create'))
@section('content')
    <main>
        <div class="container">
            <h1>{{ __('create') }} {{ __('admin') }}</h1>
            <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
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
                        name="image" required>
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

                <!-- Admin -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="admin" name="admin"
                        {{ old('admin') ? 'checked' : '' }} value="1">
                    <label class="form-check-label" for="admin">{{ __('admin') }}</label>
                </div>

                <!-- Service -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="service" name="service"
                        {{ old('service') ? 'checked' : '' }} value="1">
                    <label class="form-check-label" for="service">{{ __('service') }}</label>
                </div>

                <!-- Candidate -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="candidate" name="candidate"
                        {{ old('candidate') ? 'checked' : '' }} value="1">
                    <label class="form-check-label" for="candidate">{{ __('candidate') }}</label>
                </div>

                <!-- Employer -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="employer" name="employer"
                        {{ old('employer') ? 'checked' : '' }} value="1">
                    <label class="form-check-label" for="employer">{{ __('employer') }}</label>
                </div>

                <button type="submit" class="btn btn-primary">{{ __('create') }}</button>
            </form>
        </div>
    </main>
@endsection
