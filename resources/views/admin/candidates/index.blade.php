@extends('layouts.admin.index')
@section('title', request()->getHost() . ': Admin - ' . __('candidates'))
@section('content')
    <main>
        <div class="container-fluid d-flex flex-column gap-4 ">
            <div class="p-5 d-flex flex-column gap-4">
                <div class="d-flex justify-content-between">
                    <div class="h2 fw-bold ">
                        {{ __('candidates') }}
                    </div>
                    <a href="{{ route('admin.candidates.create') }}" class="h2 fw-bold btn btn-success px-3">
                        {{ __('add') }}
                    </a>
                </div>
                <div class="container-fluid bg-white border rounded-4">
                    <form action="{{ route('admin.candidates.index') }}">
                        <div class="navbar">
                            <div class="container-fluid">
                                <div class="d-flex gap-3 p-4 w-100  ">
                                    <div class="input-group" style="width: 100%;">
                                        <button class="input-group-text bg-white " id="basic-addon1" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                <path
                                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                            </svg>
                                        </button>
                                        <input name="name" type="text" class="form-control"
                                            placeholder="{{ __('search by candidate name ...') }}"
                                            value="{{ request('name') }}">
                                    </div>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                                        data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                                        aria-label="Toggle navigation">
                                        <div class="text-success d-flex align-items-center gap-2">
                                            <i class="bi bi-sliders"></i>
                                            {{ __('filter') }}
                                        </div>
                                    </button>
                                </div>
                                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar"
                                    aria-labelledby="offcanvasDarkNavbarLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">{{ __('filter') }}
                                            {{ __('candidates') }}</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body d-flex flex-column gap-4">
                                        <div class="d-flex">
                                            <input type="checkbox" class="form-check-input me-1"
                                                @checked(request()->has('email'))
                                                onclick="this.form.elements['email'].disabled = !this.checked;">
                                            <label class="w-25" for="email">
                                                {{ __('email') }}
                                            </label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                @disabled(!request()->has('email')) value="{{ request('email') }}">
                                        </div>

                                        <div class="text-center">
                                            <input type="submit" value="{{ __('filter') }}" class="btn btn-orange">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="py-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('id') }}</th>
                                        <th scope="col">{{ __('image') }}</th>
                                        <th scope="col">{{ __('name') }}</th>
                                        <th scope="col">{{ __('email') }}</th>

                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="result">
                                    @foreach ($candidates as $candidate)
                                        <tr>
                                            <th scope="row">{{ $candidate->id }}</th>
                                            <td class="">
                                                <img class="rounded-5" src="{{ asset($candidate->image) }}" alt=""
                                                    height="30px">
                                            </td>
                                            <td class="">{{ $candidate->name }}</td>
                                            <td class="">{{ $candidate->email }}</td>

                                            <td class="text-end">
                                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                    aria-expanded="false"></i>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.candidates.edit', ['candidate' => $candidate->id]) }}">
                                                            {{ __('edit') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li>
                                                        <form action=""></form>
                                                        <form
                                                            action="{{ route('admin.candidates.destroy', ['candidate' => $candidate->id]) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('{{ __('are you sure you want to delete this candidate?') }}')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="dropdown-item text-danger">{{ __('remove') }}</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="px-3 d-flex align-items-center gap-4 justify-content-center">
                                <div>
                                    <label for="per_page">{{ __('num of rows') }}:</label>
                                    <select name="per_page" id="per_page" onchange="this.form.submit()"
                                        class="form-select">
                                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>
                                            10
                                        </option>
                                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>
                                            20
                                        </option>
                                        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>
                                            30
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                                {{ $candidates->appends([
                                        'per_page' => request('per_page'),
                                        'name' => request('name'),
                                        'email' => request('email'),
                                    ])->links() }}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
