@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('eidt') . ': ' . $employer->name)
@section('content')
    <main>
        <div class="container-fluid">
            <div class="container">
                <h1>{{ __('edit employer') }} - {{ __('id') }}: {{ $employer->id }}</h1>
                <div class="d-flex flex-column gap-4 bg-white rounded-3 p-4">
                    <!-- Email -->
                    <div class="d-flex gap-4">
                        <div>{{ __('email') }}: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#emailModal" style="text-decoration: underline">
                            {{ $employer->email }}</div>
                        <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change email') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="new_email"
                                                value="{{ $employer->email }}" required>
                                            <label>{{ __('new email') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Name -->
                    <div class="d-flex gap-4">
                        <div>{{ __('name') }}: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#nameModal" style="text-decoration: underline">
                            {{ $employer->name }}</div>
                        <div class="modal fade" id="nameModal" tabindex="-1" aria-labelledby="nameModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change name') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="new_name"
                                                value="{{ $employer->name }}" required>
                                            <label>{{ __('new name') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="d-flex gap-4">
                        <div>Phone: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#phoneModal" style="text-decoration: underline">
                            {{ $employer->phone }}</div>
                        <div class="modal fade" id="phoneModal" tabindex="-1" aria-labelledby="phoneModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change phone') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="new_phone"
                                                value="{{ $employer->phone }}" required>
                                            <label>{{ __('new phone') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Register Name -->
                    <div class="d-flex gap-4">
                        <div>{{ __('register name') }}: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#registerNameModal"
                            style="text-decoration: underline">
                            {{ $employer->register_name }}</div>
                        <div class="modal fade" id="registerNameModal" tabindex="-1"
                            aria-labelledby="registerNameModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change register name') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="new_register_name"
                                                value="{{ $employer->register_name }}" required>
                                            <label>{{ __('new register name') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="d-flex gap-4">
                        <div>{{ __('address') }}: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#addressModal" style="text-decoration: underline">
                            {{ $employer->address }}</div>
                        <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change address') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="new_address"
                                                value="{{ $employer->address }}" required>
                                            <label>{{ __('new address') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Tax Code -->
                    <div class="d-flex gap-4">
                        <div>{{ __('tax code') }}: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#taxCodeModal" style="text-decoration: underline">
                            {{ $employer->tax_code ?? "..." }}</div>
                        <div class="modal fade" id="taxCodeModal" tabindex="-1" aria-labelledby="taxCodeModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change tax code') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="new_tax_code"
                                                value="{{ $employer->tax_code }}" required>
                                            <label>{{ __('new tax code') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- website url -->
                    <div class="d-flex gap-4">
                        <div>Website: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#website_urlModal" style="text-decoration: underline">
                            {{ $employer->website_url ?? "..." }}</div>
                        <div class="modal fade" id="website_urlModal" tabindex="-1" aria-labelledby="website_urlModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change') }} Website Url</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" name="new_website_url"
                                                value="{{ $employer->website_url }}">
                                            <label>Website url</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- customer care -->
                    <div class="d-flex gap-4">
                        <div>{{__('customer care')}}: </div>
                        <div class="link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            data-bs-toggle="modal" data-bs-target="#customer_careModal" style="text-decoration: underline">
                            @if ($employer->support)
                            {{ $employer->support->customerCare->name}}
                            -
                            {{$employer->support->customerCare->phone }}
                            -
                            {{$employer->support->customerCare->email}}
                            @else
                                ...
                            @endif</div>
                        <div class="modal fade" id="customer_careModal" tabindex="-1" aria-labelledby="customer_careModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change') }} {{__('customer care')}}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <select class="form-select" name="customer_care_id" required>
                                                @php
                                                    $customer_cares = App\Models\CustomerCare::all()
                                                @endphp
                                                @foreach ($customer_cares as $customer_care)
                                                    <option value="{{ $customer_care->id }}">{{ $customer_care->name }}</option>
                                                @endforeach
                                            </select>

                                            <label>{{__('customer care')}}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Image -->
                    <form class="image-box d-flex flex-column gap-2" method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="d-flex gap-5">
                            <div style="min-width: max-content">{{ __('change image') }}:</div>
                            <input type="file" name="new_image" id="new_image" accept="image/*" class="form-control"
                                onchange="this.form.submit();">
                        </div>
                        <img src="{{ asset($employer->image) }}" alt="{{ $employer->email }}" height="150"
                            style="max-width: max-content">
                    </form>

                    <!-- Change Password -->
                    <div>
                        <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#passwordModal">
                            {{ __('change password') }}
                        </div>
                        <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('change password') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="new_password" required>
                                            <label>{{ __('new password') }}</label>
                                        </div>
                                        <br>
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="confirm_password" required>
                                            <label>{{ __('confirm password') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
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
                <div class="d-flex flex-column gap-4 bg-white rounded-3 p-4">
                    <div class="d-flex justify-content-between">
                        <h2>{{ __('services') }}</h2>
                        <div class="btn btn-primary " style="max-height: max-content" data-bs-toggle="modal"
                            data-bs-target="#serviceModal">
                            {{ __('add') }} {{ __('service') }}
                        </div>
                        <div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="serviceModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">{{ __('add') }} {{ __('service') }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <select class="form-select" name="new_service" required>
                                                {{ $services = App\Models\Service::whereDoesntHave('registrations', function ($query) use ($employer) {
                                                    $query->where('employer_id', $employer->id);
                                                })->get() }}
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                            <label>{{ __('new service') }}</label>
                                        </div>
                                        <br>
                                        <div class="d-flex gap-4">
                                            <div>{{ __('expired') }}: </div>
                                            <div class="form-floating">
                                                <input type="number" class="form-control" name="expired" value="0"
                                                    required>
                                                <label>{{ __('expired') }}</label>
                                            </div>
                                            <div class="form-floating">
                                                <select class="form-select" name="unit" required>
                                                    <option value="day">{{ __('day') }}</option>
                                                    <option value="month">{{ __('month') }}</option>
                                                    <option value="year">{{ __('year') }}</option>
                                                </select>
                                                <label>{{ __('unit') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('exit') }}
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save changes') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-4">
                        @foreach ($employer->registrations as $registration)
                            <div class="d-flex gap-4">
                                <div>- {{ $registration->service->name }}</div>
                                <div class="{{ $registration->expired < now() ? 'text-danger' : 'link-success' }}
                                link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                    data-bs-toggle="modal" data-bs-target="#serviceModal{{ $registration->id }}"
                                    style="text-decoration: underline">
                                    {{ $registration->expired }} {{ $registration->expired < now() ? 'expired' : '' }}
                                </div>
                                <form method="POST"
                                    action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="delete_service" value="{{ $registration->id }}">
                                    <button type="submit" class="btn btn-danger">{{ __('delete') }}</button>
                                </form>
                                <div class="modal fade" id="serviceModal{{ $registration->id }}" tabindex="-1"
                                    aria-labelledby="serviceModal{{ $registration->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form class="modal-content" method="POST"
                                            action="{{ route('admin.employers.update', ['employer' => $employer->id]) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    {{ __('edit service registration') }}:
                                                    {{ $registration->service->name }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="registration_id"
                                                    value="{{ $registration->id }}">
                                                <div class="d-flex gap-4">
                                                    <div>{{ __('expired') }}: </div>
                                                    <div class="form-floating">
                                                        <input type="number" class="form-control" name="expired"
                                                            value="{{ $registration->expired }}" value="0" required>
                                                        <label>{{ __('expired') }}</label>
                                                    </div>
                                                    <div class="form-floating">
                                                        <select class="form-select" name="unit" required>
                                                            <option value="day">
                                                                {{ __('day') }}</option>
                                                            <option value="month">
                                                                {{ __('month') }}</option>
                                                            <option value="year">
                                                                {{ __('year') }}</option>
                                                        </select>
                                                        <label>{{ __('unit') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('exit') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('save changes') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
