<!DOCTYPE html>
<html lang="{{__('lang')}}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="{{ asset('storage/css/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('storage/css/body.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <style>
        main {
            padding: 0;
        }
    </style>
</head>

<body>
    @include('layouts.include.alert')
    @include('layouts.employer.header')
    <div class="d-flex position-relative" style="">
        @include('layouts.employer.sidebar')
        <div class="container-fluid p-0">
            <section class="w-100" style="padding-top: 60px">
                <div class="container-fluid p-0 bg-white">
                    <div class="border-bottom border-dark d-flex flex-wrap justify-content-between p-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('employer.dashboard.index') }}">{{ __('dashboard') }}</a>
                                </li>
                                @yield('breadcrumb-item')
                            </ol>
                        </nav>
                        <div class="d-flex gap-3">
                            @php
                                $zalo = \App\Models\Footer::first()->zalo;
                            @endphp
                            @if ($zalo)
                                <a href="{{ $zalo }}">
                                    <i class="bi bi-question-circle-fill"></i>
                                    {{ __('support') }}
                                </a>
                            @endif
                            <a class="btn btn-warning" href="{{ route('employer.jobs.create') }}">
                                <i class="bi bi-file-earmark-plus"></i>
                                {{ __('post new job') }}
                            </a>
                        </div>
                        
                    </div>
                </div>
            </section>
            @yield('content')
        </div>
    </div>
    @include('layouts.include.zalo')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</body>

</html>
