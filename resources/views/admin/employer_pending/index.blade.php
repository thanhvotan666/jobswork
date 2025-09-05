@extends('layouts.admin.index')

@section('title', request()->getHost() . ': ' . __('employer')." " . __('pending'))

@section('breadcrumb-item')
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('employer')." " . __('pending') }}
    </li>
@endsection

@section('content')
<main>
    <section>   
        <h1>
            {{  __('employer')." " . __('pending') }}
        </h1>
        @php
            $listStatus = ['all', 'pending','approved', 'rejected'];
        @endphp
        <div class="d-flex justify-content-between align-items-center p-3">
            <form method="GET">
                <div>
                    <div class="btn-group px-4" role="group" aria-label="Basic radio toggle button group">
                        {{-- new suitable contact interview offer success failed --}}
                        @foreach ($listStatus as $status)
                            <input type="radio" class="btn-check" name="status" id="{{ $status }}"
                                value="{{ $status }}" autocomplete="off" onclick="this.form.submit()"
                                {{ request('status', '') == $status ? 'checked' : 'all' }}>
                            <label
                                class="btn btn-outline-success text-capitalize {{ request('status', 'all') == $status ? 'active' : '' }}"
                                for="{{ $status }}">
                                {{ __($status) }}
                            </label>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        <hr>
    </section>
    <section>
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
                    @foreach ($employers as $employer)
                        <tr>
                            <th scope="row">{{ $employer->id }}</th>
                            <td class="">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal_{{$employer->id}}">
                                    <img class="rounded-5" src="{{ asset($employer->image) }}" alt=""
                                                                        height="30px">
                                </button>
                            </td>
                            <td class="">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal_{{$employer->id}}">
                                {{ $employer->name }}
                                </button>
                            </td>
                            <td class="">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modal_{{$employer->id}}">
                                {{ $employer->email }}
                                </button>
                            </td>

                            <td>
                                <div class="dropdown mb-3">
                                    <span
                                        class="dropdown-toggle badge 
                                        bg-{{ $employer->status == 'approved' ? 'success' : ($employer->status == 'rejected' ? 'danger' : 'warning') }}"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __($employer->status) }}
                                    </span>
                                    @if ($employer->status == 'pending')
                                        <ul class="dropdown-menu">
                                            @foreach ($listStatus as $status)
                                                @if ($status != 'all')
                                                    <li>
                                                        <form 
                                                            action="{{ route('admin.employer_pending.update', $employer->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('put')  
                                                            <input type="hidden" name="status" value="{{ $status }}">
                                                            @if ($status == 'rejected')
                                                                <input type="hidden" name="description" value="">
                                                                <button class="dropdown-item" type="button" onclick="rejected(this.form)">
                                                                    {{ __($status) }}
                                                                </button>
                                                            @else
                                                                <button class="dropdown-item" type="submit">
                                                                    {{ __($status) }}
                                                                </button>
                                                            @endif
                                                            
                                                        </form>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                {{ $employers->appends([
                        'status' => request('status'),
                    ])->links() }}
            </div>
        </div>
    </section>
    <section>
        @foreach ($employers as $employer)
        <div class="modal fade" id="modal_{{$employer->id}}" tabindex="-1" aria-labelledby="ModalLabel_{{$employer->id}}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="ModalLabel_{{$employer->id}}">
                            {{ __('employer details') }}: {{ $employer->name }}
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <img class="img-fluid rounded mb-3"
                                    src="{{ $employer->image ? asset($employer->image) : asset('path/to/default/avatar.png') }}"
                                    alt="{{ $employer->name }} logo"
                                    style="max-height: 150px; object-fit: contain;">
                                <p>
                                    <span class="badge rounded-pill
                                        bg-{{ $employer->status == 'approved' ? 'success' : ($employer->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ __('status') }}: {{ __($employer->status) }}
                                    </span>
                                </p>
                                @if($employer->status == 'rejected')
                                    <div class="alert alert-warning small p-2" role="alert">
                                        <strong>{{ __('rejection reason') }}:</strong> 
                                        {{ $employer?->description ?? __('no') ." ". __('description') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>{{ __('company name') }}:</strong> {{ $employer->name }}</li>
                                    <li class="list-group-item"><strong>{{ __('register name') }}:</strong> {{ $employer->register_name }}</li>
                                    <li class="list-group-item"><strong>{{ __('email') }}:</strong> {{ $employer->email }}</li>
                                    <li class="list-group-item"><strong>{{ __('phone') }}:</strong> {{ $employer->phone }}</li>
                                    <li class="list-group-item"><strong>{{ __('address') }}:</strong> {{ $employer->address }}</li>
                                    <li class="list-group-item"><strong>{{ __('tax code') }}:</strong> {{ $employer->tax_code ?? "..." }}</li>
                                    <li class="list-group-item"><strong>{{ __('admin ID') }}:</strong> {{ $employer->admin_id ?? "..." }}</li>
                                    <li class="list-group-item"><strong>{{ __('description') }}:</strong> 
                                        {{ $employer->description ?? __('no') ." ". __('description') }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </section>
</main>
    <script>
        function rejected(form) {
            if (confirm("{{__('are you sure you want to reject this employer?')}}")) {
                const description = prompt("{{__('please provide a reason for rejection (optional):')}}");
                form.querySelector('input[name="description"]').value = description || null;
                form.submit();
            }
        }
    </script>
    @endsection