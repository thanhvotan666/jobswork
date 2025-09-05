@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('categories'))
@section('content')
    <main>
        @php
            $location_selects = \App\Models\LocationSelect::all();
        @endphp
        <section>
            <div class="container-fluid px-5">
                <div class="container p-5 d-flex flex-column gap-4 bg-white border rounded-4">
                    <h2>{{__('location')}}</h2>
                    <div class="d-flex flex-wrap justify-content-around gap-3">
                        <form action="{{ route('admin.location_select.update', 0) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-floating mb-3">
                                <select class="form-select" name="location_id">
                                    @foreach ($location_selects as $location_select)
                                        <option value="{{ $location_select->id }}">{{ $location_select->location }}</option>
                                    @endforeach
                                </select>
                                <label>{{ __('select location to update') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="location" required>
                                <label>{{ __('new location name') }}</label>
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('update') }}</button>
                        </form>
                        <form action="{{ route('admin.location_select.store') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="location">
                                <label>{{ __('new location') }}</label>
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('add') }}</button>
                        </form>

                        <form action="{{ route('admin.location_select.destroy', 0) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-floating mb-3">
                                <select class="form-select" name="location_id" required>
                                    <option value="" disabled selected>{{ __('choose a location') }}</option>
                                    @foreach ($location_selects as $location_select)
                                        <option value="{{ $location_select->id }}">{{ $location_select->location }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>{{ __('delete location') }}</label>
                            </div>
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('{{ __('are you sure you want to delete this location?') }}')">
                                {{ __('delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @php
            $professions = \App\Models\Profession::all();
        @endphp
        <section>
            <div class="container-fluid px-5 my-5">
                <div class="container p-5 d-flex flex-column gap-4 bg-white border rounded-4">
                    <h2>{{__('profession')}}</h2>
                    <div class="d-flex flex-wrap justify-content-around gap-3">
                        <form action="{{ route('admin.professions.update', 0) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-floating mb-3">
                                <select class="form-select" name="profession_id">
                                    @foreach ($professions as $profession)
                                        <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                                    @endforeach
                                </select>
                                <label>{{ __('select profession to update') }}</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name" required>
                                <label>{{ __('new profession name') }}</label>
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('update') }}</button>
                        </form>
                        <form action="{{ route('admin.professions.store') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="name">
                                <label>{{ __('new profession') }}</label>
                            </div>
                            <button type="submit" class="btn btn-success">{{ __('add') }}</button>
                        </form>

                        <form action="{{ route('admin.professions.destroy', 0) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="form-floating mb-3">
                                <select class="form-select" name="profession_id" required>
                                    <option disabled selected>{{ __('choose a profession') }}</option>
                                    @foreach ($professions as $profession)
                                        <option value="{{ $profession->id }}">{{ $profession->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label>{{ __('delete profession') }}</label>
                            </div>
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('{{ __('are you sure you want to delete this profession?') }}')">
                                {{ __('delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <br>
        @php
            $footer = \App\Models\Footer::first();
        @endphp
        <section>
            <div class="container-fluid px-5">
                <div class="container p-5 d-flex flex-column gap-4 bg-white border rounded-4">
                    <h2>{{ __('footer information')}}</h2>
                    <form action="{{ route('admin.footer.update', $footer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="company" value="{{ $footer->company }}"
                                >
                            <label>{{ __('company') }}</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="address_n" value="{{ $footer->address_n }}"
                                >
                            <label>{{ __('northern office') }}</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="phone_n" value="{{ $footer->phone_n }}"
                                >
                            <label>{{ __('phone') }}</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="address_s" value="{{ $footer->address_s }}"
                                >
                            <label>{{ __('southern office') }}</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="phone_s" value="{{ $footer->phone_s }}"
                                >
                            <label>{{ __('phone') }}</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" name="email" value="{{ $footer->email }}"
                                >
                            <label>{{ __('email') }}</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="hotline" value="{{ $footer->hotline }}"
                                >
                            <label>{{ __('hotline') }}</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="facebook" value="{{ $footer->facebook }}"
                                >
                            <label>Link Facebook</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="instagram" value="{{ $footer->instagram }}"
                                >
                            <label>Link Instagram</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="linkedin" value="{{ $footer->linkedin }}"
                                >
                            <label>Link Linkedin</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="tiktok" value="{{ $footer->tiktok }}"
                                >
                            <label>Link Tiktok</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="threads" value="{{ $footer->threads }}"
                                >
                            <label>Link Threads</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="zalo" value="{{ $footer->zalo }}"
                                >
                            <label>Link Zalo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="bottom" id="bottom" class="form-control text-center" style="height: 200px">{{ $footer->bottom }}</textarea> 
                            <label>{{__('bottom information')}}</label>
                        </div>
                        <button type="submit" class="btn btn-success">{{ __('update') }}</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
