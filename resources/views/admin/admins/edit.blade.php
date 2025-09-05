@extends('layouts.admin.index')
@section('title', request()->getHost() . ': ' . __('admin') . ' - ' . __('edit') . ': ' . $admin->name)
@section('content')
    <main>
        <div class="container-fluid">
            <div class="container">
                <h1>{{ __('edit') }} {{ __('admmin') }} - {{ __('id') }}: {{ $admin->id }}</h1>
                <div class="d-flex flex-column gap-4 bg-white rounded-3 p-4">
                    <div class="d-flex gap-4 ">
                        <div>{{ __('email') }}: </div>
                        <div>{{ $admin->email }}</div>
                    </div>
                    <div class="d-flex gap-4 ">
                        <div>{{ __('name') }}: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#nameModal" style="text-decoration: underline">
                            {{ $admin->name }}</div>
                        <div class="modal fade" id="nameModal" tabindex="-1" aria-labelledby="nameModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.admins.update', ['admin' => $admin->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change name') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="new_name" required>
                                            <label>{{ __('new name') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <form class="image-box d-flex flex-column gap-2" method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.admins.update', ['admin' => $admin->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="d-flex gap-5">
                            <div style="min-width: max-content">{{ __('change image') }}:</div>
                            <input type="file" name="new_image" id="new_image" accept="image/*" class="form-control"
                                onchange="this.form.submit();">
                        </div>
                        <img src="{{ asset($admin->image) }}" alt="{{ $admin->email }}" height="150"
                            style="max-width: max-content">
                    </form>
                    <div>
                        <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#changePasswordOrderModal">
                            {{ __('change password') }}
                        </div>
                        <div class="modal fade" id="changePasswordOrderModal" tabindex="-1"
                            aria-labelledby="changePasswordOrderModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.admins.update', ['admin' => $admin->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change password') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="new_password_order" required>
                                            <label>{{ __('new password') }}</label>
                                        </div>
                                        <br>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="confirm_password_order"
                                                required>
                                            <label>{{ __('confirm password') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <form class="d-flex flex-column gap-3 bg-white p-5" method="POST"
                    action="{{ route('admin.admins.update', ['admin' => $admin->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="d-flex justify-content-between">
                        <h1>{{ __('function') }}</h1>
                        <button type="submit" class="btn btn-success" name="function" style="max-height: max-content">
                            {{ __('save changes') }}
                        </button>
                    </div>
                    <div>
                        <input type="checkbox" name="admin" value="1" @checked($admin->admin)>
                        <label>{{ __('admin') }}</label>
                    </div>
                    <div>
                        <input type="checkbox" name="service" value="1" @checked($admin->service)>
                        <label>{{ __('service') }}</label>
                    </div>
                    <div>
                        <input type="checkbox" name="candidate" value="1" @checked($admin->candidate)>
                        <label>{{ __('candidate') }}</label>
                    </div>
                    <div>
                        <input type="checkbox" name="employer" value="1" @checked($admin->employer)>
                        <label>{{ __('employer') }}</label>
                    </div>
                </form>
                <br>
                <br>
            </div>
        </div>
    </main>
@endsection
