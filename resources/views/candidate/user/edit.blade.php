@extends('layouts.user.index')

@section('title', request()->getHost() . ': Tìm việc mong ước')

@php
    $auth = auth()->guard('user')->user();
@endphp

@section('content')
    <main>
        <section>
            <div class="container-fluid p-0">
                <div class="container">
                    <div>
                        <div class="px-3" style="background-color: rgba(173, 216, 230, 0.5);">
                            {{ config('app.name') }} / {{ __('update profile') }}
                        </div>
                        <div class="px-3 py-2 bg-white fw-bold border-bottom border-primary ">{{ __('update profile') }}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-8 p-4">
                            <div class="border border-primary rounded-3 bg-white p-4 ">
                                <div class="d-flex gap-4 px-3">
                                    <div class="text-center w-50">
                                        <div>
                                            <img src="{{ asset($auth->image) }}" alt="{{ $auth->name }}" width="200"
                                                height="200" class="rounded-3" data-bs-toggle="modal"
                                                data-bs-target="#imageModal">
                                            <div class="modal fade" id="imageModal" tabindex="-1"
                                                aria-labelledby="imageModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <form class="modal-content" method="POST" enctype="multipart/form-data"
                                                        action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">{{ __('change profile picture') }}
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <input type="file" name="new_image" class="form-control"
                                                                accept="image/*" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">{{ __('close') }}</button>
                                                            <button type="submit" class="btn btn-primary">
                                                                {{ __('save changes') }}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100">
                                        <div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">{{ __('name') }}:</strong>
                                                <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                                    data-bs-target="#nameModal">{{ $auth->name }}</u>
                                                <div class="modal fade" id="nameModal" tabindex="-1"
                                                    aria-labelledby="nameModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form class="modal-content" method="POST"
                                                            action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5">
                                                                    {{ __('edit name') }}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-floating">
                                                                    <input class="form-control" type="text"
                                                                        name="new_name" value="{{ $auth->name }}"
                                                                        required>
                                                                    <label>{{ __('new name') }}</label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">{{ __('close') }}</button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('save changes') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex">
                                                <strong style="width: 200px;">{{ __('date of birth') }}:</strong>
                                                <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                                    data-bs-target="#dateOfBirthModal">
                                                    {{ $auth->date_of_birth ?? __('not updated') }}
                                                </u>
                                                <div class="modal fade" id="dateOfBirthModal" tabindex="-1"
                                                    aria-labelledby="dateOfBirthModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form class="modal-content" method="POST"
                                                            action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5">
                                                                    {{ __('edit date of birth') }}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div>
                                                                    <input class="form-control" type="date"
                                                                        name="new_date_of_birth">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">{{ __('close') }}</button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('save changes') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">{{ __('sex') }}:</strong>
                                                <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                                    data-bs-target="#sexModal">
                                                    {{ $auth->sex ?? __('not updated') }}
                                                </u>
                                                <div class="modal fade" id="sexModal" tabindex="-1"
                                                    aria-labelledby="sexModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form class="modal-content" method="POST"
                                                            action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5">
                                                                    {{ __('edit sex') }}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <select name="new_sex" class="form-select">
                                                                    <option value="male" selected>
                                                                        {{ __('male') }}
                                                                    </option>
                                                                    <option value="female">
                                                                        {{ __('female') }}
                                                                    </option>
                                                                    <option value="other">
                                                                        {{ __('other') }}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    {{ __('close') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('save changes') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">
                                                    {{ __('desired location') }}:
                                                </strong>
                                                <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                                    data-bs-target="#desiredLocationModal">
                                                    {{ $auth->desired_location ?? __('not updated') }}
                                                </u>
                                                <div class="modal fade" id="desiredLocationModal" tabindex="-1"
                                                    aria-labelledby="desiredLocationModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form class="modal-content" method="POST"
                                                            action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5">
                                                                    {{ __('edit desired location') }}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-floating">
                                                                    <input class="form-control" type="text"
                                                                        name="new_desired_location">
                                                                    <label>
                                                                        {{ __('desired location') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    {{ __('close') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('save changes') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">{{ __('position') }}:</strong>
                                                <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                                    data-bs-target="#positionModal">
                                                    {{ $auth->position ?? __('not updated') }}
                                                </u>
                                                <div class="modal fade" id="positionModal" tabindex="-1"
                                                    aria-labelledby="positionModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form class="modal-content" method="POST"
                                                            action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5">
                                                                    {{ __('edit position') }}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-floating">
                                                                    <input class="form-control" type="text"
                                                                        name="new_position">
                                                                    <label>
                                                                        {{ __('position') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    {{ __('close') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('save changes') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <strong
                                                    style="width: 200px;">{{ __('status looking for a job') }}:</strong>
                                                @if ($auth->job_search_status)
                                                    <green data-bs-toggle="modal" data-bs-target="#jobSearchStatusModal">
                                                        {{ __('looking for a job') }}
                                                    </green>
                                                @else
                                                    <red data-bs-toggle="modal" data-bs-target="#jobSearchStatusModal">
                                                        {{ __('not looking for a job') }}
                                                    </red>
                                                @endif

                                                <div class="modal fade" id="jobSearchStatusModal" tabindex="-1"
                                                    aria-labelledby="jobSearchStatusModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form class="modal-content" method="POST"
                                                            action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5">
                                                                    {{ __('edit status looking for a job') }}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <select name="new_job_search_status" class="form-select">
                                                                    <option value="1">
                                                                        <div class="text-success">
                                                                            {{ __('looking for a job') }}
                                                                        </div>
                                                                    </option>
                                                                    <option value="0">
                                                                        <div class="text-danger">
                                                                            {{ __('not looking for a job') }}
                                                                        </div>
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    {{ __('close') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('save changes') }}
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">{{ __('updated date') }}:</strong>
                                                <u style="text-decoration: none;">
                                                    {{ $auth->updated_at }}
                                                </u>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div><strong class="text-uppercase">{{ __('basic information') }}</strong></div>
                                <br>
                                <div class="d-flex flex-column gap-2">
                                    <div>
                                        <strong>{{ __('email') }}:</strong>
                                        {{ $auth->email }}
                                    </div>
                                    <div>
                                        <strong>{{ __('myself intro') }}:</strong>
                                        <div>
                                            <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                                data-bs-target="#introduceModal">
                                                <pre>{{ $auth->introduce ?? __('not selected') }}</pre>
                                            </u>
                                        </div>
                                        <div class="modal fade" id="introduceModal" tabindex="-1"
                                            aria-labelledby="introduceModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form class="modal-content" method="POST"
                                                    action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">
                                                            {{ __('edit myself intro') }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-floating">
                                                            <textarea class="form-control" name="new_introduce" style="height: 100px"></textarea>
                                                            <label>
                                                                {{ __('myself intro') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('close') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('save changes') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ __('phone') }}:</strong>
                                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                            data-bs-target="#phoneModal">
                                            {{ $auth->phone ?? __('not updated') }}
                                        </u>
                                        <div class="modal fade" id="phoneModal" tabindex="-1"
                                            aria-labelledby="phoneModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form class="modal-content" method="POST"
                                                    action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">
                                                            {{ __('edit phone') }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" name="new_phone">
                                                            <label>{{ __('phone') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('close') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('save changes') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ __('current address') }}:</strong>
                                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                            data-bs-target="#addressModal">
                                            {{ $auth->address ?? __('not updated') }}
                                        </u>
                                        <div class="modal fade" id="addressModal" tabindex="-1"
                                            aria-labelledby="addressModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form class="modal-content" method="POST"
                                                    action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">{{ __('edit current address') }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control"
                                                                name="new_address">
                                                            <label>{{ __('current address') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('close') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('save changes') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ __('location') }}:</strong>
                                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                            data-bs-target="#locationModal">
                                            {{ $auth->location ?? __('not updated') }}
                                        </u>
                                        <div class="modal fade" id="locationModal" tabindex="-1"
                                            aria-labelledby="locationModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form class="modal-content" method="POST"
                                                    action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">
                                                            {{ __('edit location') }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control"
                                                                name="new_location">
                                                            <label>
                                                                {{ __('location') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('close') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('save changes') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ __('degree') }}:</strong>
                                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                            data-bs-target="#degreeModal">
                                            {{ $auth->degree ?? __('not updated') }}
                                        </u>
                                        <div class="modal fade" id="degreeModal" tabindex="-1"
                                            aria-labelledby="degreeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form class="modal-content" method="POST"
                                                    action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">{{ __('edit degree') }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" name="new_degree">
                                                            <label>{{ __('degree') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('close') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('save changes') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ __('current salary') }}:</strong>
                                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                            data-bs-target="#currentSalaryModal">
                                            {{ $auth->current_salary ?? __('not updated') }}
                                        </u>
                                        <div class="modal fade" id="currentSalaryModal" tabindex="-1"
                                            aria-labelledby="currentSalaryModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form class="modal-content" method="POST"
                                                    action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">
                                                            {{ __('edit current salary') }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control"
                                                                name="new_current_salary">
                                                            <label>
                                                                {{ __('current salary') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('close') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('save changes') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <strong>{{ __('desired salary') }}:</strong>
                                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                                            data-bs-target="#desiredSalaryModal">
                                            {{ $auth->desired_salary ?? 'Chưa cập nhập' }}
                                        </u>
                                        <div class="modal fade" id="desiredSalaryModal" tabindex="-1"
                                            aria-labelledby="desiredSalaryModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form class="modal-content" method="POST"
                                                    action="{{ route('candidate.user.update', ['user' => $auth->id]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">
                                                            {{ __('edit desired salary') }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-floating">
                                                            <input type="number" class="form-control"
                                                                name="new_desired_salary">
                                                            <label>
                                                                {{ __('desired salary') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('close') }}
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
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong class="text-uppercase">
                                            {{ __('professional skills') }}
                                        </strong>
                                    </div>
                                    <div><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#addProfessionalSkillModal">+</button></div>
                                    <div class="modal fade" id="addProfessionalSkillModal" tabindex="-1"
                                        aria-labelledby="addProfessionalSkillModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form class="modal-content" method="POST"
                                                action="{{ route('candidate.user.store') }}">
                                                @csrf
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">
                                                        {{ __('add professional skill') }}
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control"
                                                            name="professional_skill">
                                                        <label>
                                                            {{ __('professional skill') }}
                                                        </label>
                                                    </div>
                                                    <br>
                                                    <div class="form-floating">
                                                        <select class="form-select" name="year">
                                                            <option value="0" selected>{{ __('no experience') }}
                                                            </option>
                                                            <option value="1">1 {{ __('years') }}</option>
                                                            <option value="2">2 {{ __('years') }}</option>
                                                            <option value="3">3 {{ __('years') }}</option>
                                                            <option value="4">4 {{ __('years') }}</option>
                                                            <option value="5">5 {{ __('years') }}</option>
                                                            <option value="6">{{ __('over 5 years') }}</option>
                                                        </select>
                                                        <label>
                                                            {{ __('experience years number') }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        {{ __('close') }}
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('add') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                @php
                                    $user = App\Models\User::find($auth->id);
                                @endphp
                                <div class="d-flex flex-wrap gap-5">

                                    @foreach ($user->professionalSkills as $p)
                                        <div class="position-relative">
                                            <div class="btn btn-primary">
                                                <strong>{{ $p->professional_skill }}</strong>
                                            </div>
                                            <div class="text-info text-center">
                                                @if ($p->year == 0)
                                                    {{ __('no experience') }}
                                                @elseif ($p->year == 6)
                                                    {{ __('over 5 years') }}
                                                @else
                                                    {{ $p->year }} {{ __('years') }}
                                                @endif
                                            </div>
                                            <form class="text-end"
                                                action="{{ route('candidate.user.destroy', ['user' => $user->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="professional_skill"
                                                    value="{{ $p->id }}">
                                                <button
                                                    class="position-absolute top-0 start-100 
                                                            translate-middle badge border border-light rounded-circle bg-danger p-2 
                                                            btn btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div><strong class="text-uppercase">
                                            {{ __('work experiences') }}
                                        </strong></div>
                                    </strong>
                                </div>
                                <div><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addWorkExperienceModal">+</button></div>
                                <div class="modal fade" id="addWorkExperienceModal" tabindex="-1"
                                    aria-labelledby="addWorkExperienceModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form class="modal-content" method="POST"
                                            action="{{ route('candidate.user.store') }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    {{ __('add work experience') }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" name="start_date"
                                                        required>
                                                    <label>
                                                        {{ __('start date') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        onchange="this.form.elements['end_date'].disabled = this.checked;">
                                                    <label class="form-check-label" for="now_work">
                                                        {{ __('now work') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    <input type="date" class="form-control" name="end_date" required>
                                                    <label>
                                                        {{ __('end date') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="company" required>
                                                    <label>
                                                        {{ __('company') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    <textarea class="form-control" name="work_experience" style="height: 100px" required></textarea>
                                                    <label>
                                                        {{ __('work experience') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">

                                                    {{ __('add') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                @foreach ($user->workExperiences->sortBy('start_date') as $p)
                                    <div class="timeline-item">
                                        <div class="timeline-line"></div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content ms-4">
                                            <div class="d-flex text-info gap-3">
                                                <div>{{ date('m/Y', strtotime($p->start_date)) }}</div>
                                                <div><i class="bi bi-arrow-right"></i></div>
                                                <div>
                                                    @if ($p->end_date)
                                                        {{ date('m/Y', strtotime($p->end_date)) }}
                                                    @else
                                                        {{ __('now') }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column gap-2">
                                                <form class="text-end"
                                                    action="{{ route('candidate.user.destroy', ['user' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="work_experience"
                                                        value="{{ $p->id }}">
                                                    <button class="btn btn-outline-danger" type="submit">
                                                        <i class="bi bi-trash"></i>
                                                        {{ __('delete') }}
                                                    </button>
                                                </form>
                                                <div class="fs-5">
                                                    {{ $p->company }}
                                                </div>
                                                <pre class="text-secondary">{{ $p->work_experience }}</pre>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div><strong class="text-uppercase">
                                        {{ __('learning processes') }}
                                    </strong></div>
                                <div><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addLearningProcessModal">+</button></div>
                                <div class="modal fade" id="addLearningProcessModal" tabindex="-1"
                                    aria-labelledby="addLearningProcessModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form class="modal-content" action="{{ route('candidate.user.store') }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="learning_process">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    {{ __('add learning process') }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" name="year">
                                                    <label>
                                                        {{ __('graduation year') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="school">
                                                    <label>
                                                        {{ __('school/center') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="degree">
                                                    <label>
                                                        {{ __('degree') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="specialized">
                                                    <label>
                                                        {{ __('specialized') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('add') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                @foreach ($user->learningProcesses as $p)
                                    <div class="timeline-item">
                                        <div class="timeline-line"></div>
                                        <div class="timeline-dot"></div>
                                        <div class="timeline-content ms-4">
                                            <div class="d-flex text-secondary">
                                                <div>
                                                    {{ __('graduation year') }}:
                                                </div>
                                                <div>{{ date('m/Y', strtotime($p->year)) }}</div>
                                            </div>
                                            <div class="d-flex flex-column gap-2">
                                                <form class="text-end"
                                                    action="{{ route('candidate.user.destroy', ['user' => $user->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="learning_process"
                                                        value="{{ $p->id }}">
                                                    <button class="btn btn-outline-danger" type="submit">
                                                        <i class="bi bi-trash"></i>
                                                        {{ __('delete') }}
                                                    </button>
                                                </form>
                                                <div class="fs-5">
                                                    {{ __('school/center') }}: {{ $p->school }}
                                                </div>
                                                <div class="text-secondary">
                                                    {{ __('degree') }}:
                                                    {{ $p->degree }}
                                                </div>
                                                <div class="text-secondary">
                                                    {{ __('specialized') }}:
                                                    {{ $p->specialized }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div><strong class="text-uppercase">
                                        {{ __('language proficiency') }}
                                    </strong></div>
                                <div><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addLanguageModal">+</button></div>
                                <div class="modal fade" id="addLanguageModal" tabindex="-1"
                                    aria-labelledby="addLanguageModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form class="modal-content" action="{{ route('candidate.user.store') }}"
                                            method="post">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    {{ __('add language proficiency') }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <select class="form-select" name="language">
                                                        <option value="Vietnamese" selected>Tiếng việt</option>
                                                        <option value="English">english</option>
                                                        <option value="Japanese">日本語</option>
                                                        <option value="Chinese">中国人</option>
                                                    </select>
                                                    <label>
                                                        {{ __('language') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    <select class="form-select" name="proficient">
                                                        <option value="basic" selected>
                                                            {{ __('basic') }}
                                                        </option>
                                                        <option value="intermediate">
                                                            {{ __('intermediate') }}
                                                        </option>
                                                        <option value="advanced">
                                                            {{ __('advanced') }}
                                                        </option>
                                                        <option value="proficient">
                                                            {{ __('proficient') }}
                                                        </option>
                                                    </select>
                                                    <label>
                                                        {{ __('proficient') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('add') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex flex-wrap gap-5">
                                @foreach ($user->languages as $p)
                                    <div class="position-relative">
                                        <button type="button" class="btn btn-primary">
                                            <strong>{{ $p->language }}</strong></button>
                                        <div class="text-info text-center">{{ $p->proficient }}</div>
                                        <form class="text-end"
                                            action="{{ route('candidate.user.destroy', ['user' => $user->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="language" value="{{ $p->id }}">
                                            <button
                                                class="position-absolute top-0 start-100 
                                                            translate-middle badge border border-light rounded-circle bg-danger p-2 
                                                            btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div><strong class="text-uppercase">
                                        {{ __('soft skills') }}
                                    </strong></div>
                                <div><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addSoftSkillModal">+</button></div>
                                <div class="modal fade" id="addSoftSkillModal" tabindex="-1"
                                    aria-labelledby="addSoftSkillModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form class="modal-content" action="{{ route('candidate.user.store') }}"
                                            method="post">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    {{ __('add soft skill') }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="soft_skill">
                                                    <label>
                                                        {{ __('soft skill') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="form-floating">
                                                    <select class="form-select" name="proficient">
                                                        <option value="basic" selected>
                                                            {{ __('basic') }}
                                                        </option>
                                                        <option value="intermediate">
                                                            {{ __('intermediate') }}
                                                        </option>
                                                        <option value="advanced">
                                                            {{ __('advanced') }}
                                                        </option>
                                                        <option value="proficient">
                                                            {{ __('proficient') }}
                                                        </option>
                                                    </select>
                                                    <label>
                                                        {{ __('proficient') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('add') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex flex-wrap gap-5">
                                @foreach ($user->softSkills as $p)
                                    <div class="position-relative">
                                        <button type="button" class="btn btn-primary">
                                            <strong>{{ $p->soft_skill }}</strong></button>
                                        <div class="text-info text-center">{{ $p->proficient }}</div>

                                        <form class="text-end"
                                            action="{{ route('candidate.user.destroy', ['user' => $user->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="soft_skill" value="{{ $p->id }}">
                                            <button
                                                class="position-absolute top-0 start-100 
                                                            translate-middle badge border border-light rounded-circle bg-danger p-2 
                                                            btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div><strong class="text-uppercase">
                                        {{ __('hobbies') }}
                                    </strong></div>
                                <div><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addHobbyModal">+</button></div>
                                <div class="modal fade" id="addHobbyModal" tabindex="-1"
                                    aria-labelledby="addHobbyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form class="modal-content" action="{{ route('candidate.user.store') }}"
                                            method="post">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    {{ __('add hobby') }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="hobby" required>
                                                    <label>
                                                        {{ __('hobby') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('add') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex flex-wrap gap-5">
                                @foreach ($user->hobbies as $p)
                                    <div class="position-relative">
                                        <button type="button" class="btn btn-primary">
                                            <strong>{{ $p->hobby }}</strong>
                                        </button>
                                        <form class="text-end"
                                            action="{{ route('candidate.user.destroy', ['user' => $user->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="hobby" value="{{ $p->id }}">
                                            <button
                                                class="position-absolute top-0 start-100 
                                                            translate-middle badge border border-light rounded-circle bg-danger p-2 
                                                            btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div><strong class="text-uppercase">
                                        {{ __('desired locations') }}
                                    </strong></div>
                                <div><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addDesiredLocationModal">+</button></div>
                                <div class="modal fade" id="addDesiredLocationModal" tabindex="-1"
                                    aria-labelledby="addDesiredLocationModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form class="modal-content" action="{{ route('candidate.user.store') }}"
                                            method="post">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    {{ __('add desired location') }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="desired_location">
                                                    <label>
                                                        {{ __('desired location') }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('add') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex flex-wrap gap-5">
                                @foreach ($user->desiredLocations as $p)
                                    <div class="position-relative">
                                        <button type="button" class="btn btn-primary">
                                            <strong>{{ $p->desired_location }}</strong>
                                        </button>
                                        <form class="text-end"
                                            action="{{ route('candidate.user.destroy', ['user' => $user->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="desired_location" value="{{ $p->id }}">
                                            <button
                                                class="position-absolute top-0 start-100 
                                                            translate-middle badge border border-light rounded-circle bg-danger p-2 
                                                            btn btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div><strong class="text-uppercase">
                                        {{ __('attachments') }}
                                    </strong></div>
                                <div><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#addAttachmentModal">+</button></div>
                                <div class="modal fade" id="addAttachmentModal" tabindex="-1"
                                    aria-labelledby="addAttachmentModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form class="modal-content" action="{{ route('candidate.user.store') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    {{ __('add attachment') }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="attachment"
                                                        required>
                                                    <label>
                                                        {{ __('attachment') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <input type="file" name="file" class="form-control" accept=".pdf"
                                                    required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('add') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row row-cols-3">
                                @foreach ($user->attachments as $p)
                                    <div class="col">
                                        <div class="p-1">
                                            <div class="p-4 border border-primary rounded-3 bg-white">
                                                <div class="overflow-auto" style="height: 100px;">
                                                    <img src="{{ asset('storage/image/temp/cv-default.png') }}"
                                                        alt="{{ $p->attachment }}" class="w-100">
                                                </div>
                                                <br>
                                                <div class="text-success text-truncate">{{ $p->attachment }}</div>
                                                <br>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ asset($p->link) }}"
                                                        class="btn btn-light border border-primary">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('candidate.user.destroy', ['user' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="attachment"
                                                            value="{{ $p->id }}">
                                                        <button type="submit"
                                                            class="btn btn-light border border-primary">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <div><strong class="text-uppercase">
                                        {{ __('certificates') }}
                                    </strong></div>

                                <div><button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#CertificateModal">+</button></div>
                                <div class="modal fade" id="CertificateModal" tabindex="-1"
                                    aria-labelledby="CertificateModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form class="modal-content" action="{{ route('candidate.user.store') }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    {{ __('add certificate') }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="certificate"
                                                        required>
                                                    <label>
                                                        {{ __('certificate') }}
                                                    </label>
                                                </div>
                                                <br>
                                                <input type="file" name="file" class="form-control" accept=".pdf"
                                                    required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    {{ __('close') }}
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('add') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row row-cols-3">
                                @foreach ($user->certificates as $p)
                                    <div class="col">
                                        <div class="p-1">
                                            <div class="p-4 border border-primary rounded-3 bg-white">
                                                <div class="overflow-auto" style="height: 100px;">
                                                    <img src="{{ asset('storage/image/temp/cv-default.png') }}"
                                                        alt="{{ $p->certificate }}" class="w-100">
                                                </div>
                                                <br>
                                                <div class="text-success text-truncate">{{ $p->certificate }}</div>
                                                <br>
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ asset($p->link) }}"
                                                        class="btn btn-light border border-primary">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                    <form
                                                        action="{{ route('candidate.user.destroy', ['user' => $user->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="certificate"
                                                            value="{{ $p->id }}">
                                                        <button type="submit"
                                                            class="btn btn-light border border-primary">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <div>
                                <div class="d-flex rounded-3 bg-white border border-primary">
                                    <div class="p-4">
                                        <div class="px-1">
                                            <h2>
                                                {{ __('suitable jobs') }}
                                            </h2>
                                            <br>
                                            @php
                                                $suitableJobs = App\Models\Job::whereHas(
                                                    'professions.profession',
                                                    function ($query) use ($user) {
                                                        foreach (
                                                            $user->professionalSkills->pluck('professional_skill')
                                                            as $professional_skill
                                                        ) {
                                                            $query->orWhere(
                                                                'name',
                                                                'like',
                                                                '%' . $professional_skill . '%',
                                                            );
                                                        }
                                                    },
                                                )
                                                    ->orWhere('name', 'like', '%' . $user->desired_location . '%')
                                                    ->limit(6)
                                                    ->get();
                                            @endphp
                                            <div class="row">
                                                @foreach ($suitableJobs as $job)
                                                    <a href="{{ route('job', $job->id) }}"
                                                        class="text-decoration-none text-dark col-6 mt-3">
                                                        <div class="border border-primary rounded-3 p-2 d-flex gap-3">
                                                            <div>
                                                                <img src="{{ asset($job->employer->image) }}"
                                                                    alt="{{ $job->name }}"
                                                                    style="height: 100px; width: 100px;">
                                                            </div>
                                                            <div>
                                                                <div class="text-success">
                                                                    <strong>
                                                                        {{ $job->name }}
                                                                    </strong>
                                                                </div>
                                                                <div class="text-secondary">
                                                                    {{ $job->employer->name }}
                                                                </div>
                                                                <div class="d-flex flex-wrap gap-3"
                                                                    style="font-size: 12px;">
                                                                    <div class="border border-primary p-1 rounded-2"
                                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                                        @if (is_null($job->min_salary) && is_null($job->max_salary))
                                                                            {{ __('negotiate') }}
                                                                        @elseif (is_null($job->max_salary))
                                                                            {{ __('over') }}
                                                                            {{ $job->min_salary }}
                                                                            {{ __($job->type_salary) }}
                                                                        @elseif (is_null($job->min_salary))
                                                                            {{ __('up to') }}
                                                                            {{ $job->max_salary }}
                                                                            {{ __($job->type_salary) }}
                                                                        @else
                                                                            {{ $job->min_salary }}
                                                                            -
                                                                            {{ $job->max_salary }}
                                                                            {{ __($job->type_salary) }}
                                                                        @endif
                                                                    </div>
                                                                    <div class="border border-primary p-1 rounded-2"
                                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                                        {{ $job->location }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                @endforeach
                                                {{-- <a href="#" class="bg-white p-3 rounded-2 d-flex gap-3 border">
                                                    <div>
                                                        <img src="../storage/app/public/image/employer/1.jpg" alt=""
                                                            style="height: 100px; width: 100px;">
                                                    </div>
                                                    <div>
                                                        <div class="text-danger card-content">
                                                            <strong>
                                                                Vinwonders Phú Quốc - Kỹ Sư Trưởng (Chief Engineer)
                                                                Vinwonders Phú Quốc
                                                                - Kỹ Sư Trưởng (Chief Engineer)
                                                            </strong>
                                                        </div>
                                                        <div class="text-secondary card-content" style="font-size: 12px;">
                                                            Công Ty Cổ Phần Dịch Vụ Bất Động Sản Eximrs
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-3" style="font-size: 12px;">
                                                            <div class="border border-primary p-1 rounded-2"
                                                                style="background-color: rgba(127, 255, 212, 0.3);"> 7 - 10
                                                                triệu VNĐ
                                                            </div>
                                                            <div class="border border-primary p-1 rounded-2"
                                                                style="background-color: rgba(127, 255, 212, 0.3);"> Hồ Chí
                                                                Minh, Hà Nội
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            </div>
        </section>
    </main>
@endsection
