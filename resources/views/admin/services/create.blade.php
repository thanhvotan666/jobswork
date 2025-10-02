@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Services - Create')
@section('content')
    <main>
        <div class="container">
            <h1>{{ __('create') }} {{ __('service') }}</h1>
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
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

                <!-- Show contact candidate -->
                <div class="mb-3">
                    <label for="show_contact_candidate" class="form-label"> {{ __('show contact candidate') }}</label>
                    <select class="form-select @error('show_contact_candidate') is-invalid @enderror"
                        id="show_contact_candidate" name="show_contact_candidate" required>
                        <option value="1" @if (old('show_contact_candidate') == 1) selected @endif>Yes</option>
                        <option value="0" @if (old('show_contact_candidate') == 0) selected @endif>No</option>
                    </select>
                    @error('show_contact_candidate')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- hot job -->
                <div class="mb-3">
                    <label for="hot_job" class="form-label"> {{ __('hot job') }}</label>
                    <select class="form-select @error('hot_job') is-invalid @enderror"
                        id="hot_job" name="hot_job" required>
                        <option value="1" @if (old('hot_job') == 1) selected @endif>Yes</option>
                        <option value="0" @if (old('hot_job') == 0) selected @endif>No</option>
                    </select>
                    @error('hot_job')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('description') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                        id="description" name="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ __('create') }}</button>
            </form>
        </div>
    </main>
@endsection
