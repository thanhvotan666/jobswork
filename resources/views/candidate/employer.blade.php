@extends('layouts.user.index')

@section('title', request()->getHost() . ': Tìm việc mong ước')

@section('content')
    <main>
        <section>
            <div class="container">
                <form class="d-flex p-2" method="GET" action="{{ route('jobs') }}">
                    <div class="input-group">
                        <span class="input-group-text fw-bold bg-white border-end-0 p-3">
                            {{ __('keywords') }}:
                        </span>
                        <input type="text" aria-label="key_word" class="form-control border-start-0 p-3" name="key_word"
                            value="{{ request('key_word') }}" placeholder="{{ __('job, company, profession...') }}">
                        <span class="input-group-text fw-bold  bg-white border-end-0 p-3">
                            {{ __('location') }}:
                        </span>
                        <select name="location" class="form-select border-start-0 p-3">
                            <option value="" @selected(request('location', '') == '')>
                                {{ __('city, district...') }}
                            </option>
                            @foreach (\App\Models\LocationSelect::all() as $location)
                                <option value="{{ $location->location }}" @selected(request('location', '') == $location->location)>
                                    {{ $location->location }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn ms-3 text-white w-25" style="background-color: dodgerblue;">
                        <strong> {{ __('search job') }}</strong>
                    </button>
                </form>
            </div>
        </section>
        <section class="py-4">
            <div class="container">
                <div class="bg-white rounded-3 px-4 pt-4">
                    <div class="d-flex gap-4">
                        <div><img src="{{ asset($employer->image) }}" alt="{{ $employer->name }}"></div>
                        <div>
                            <h3>{{ $employer->name }}</h3>
                            <div style="font-size: larger;"></div>
                            <div>
                                @foreach ($employer->professions as $profession)
                                    <a href="{{ route('jobs', ['profession' => $profession->id]) }}"
                                        class="text-info">{{ $profession->name }}</a>{{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="tongquan" 
        class="change-show py-4 d-flex flex-column justify-content-center align-items-center gap-4">
            <div class="container p-0 row">
                <div class="col-lg-8">
                    <div class="pe-3">
                        <div class="d-flex flex-column gap-4">
                            <div class="bg-white rounded-3 p-4">
                                <h4>
                                    {{ __('description')}} {{__('company') }}
                                </h4>
                                <div>
                                    {{ $employer->description }}
                                </div>
                            </div>
                            <div class="bg-white rounded-3 p-4">
                                @php
                                    $jobs = $employer->jobs()->where('is_stop',0)->whereNotNull('admin_id')->get();
                                @endphp
                                <h3>
                                    {{ __('jobs are online') }}
                                    ({{ $jobs->count() }})
                                </h3>
                                <br>
                                <div class="row row-cols-2 g-2">
                                    @foreach ($jobs as $job)
                                        <div class="col">
                                            <a href="{{ route('job', $job->id) }}"
                                                class="bg-white p-3 rounded-2 d-flex gap-3 border">
                                                <div>
                                                    <img src="{{ asset($job->employer->image) }}"
                                                        alt="{{ $job->employer->name }}"
                                                        style="height: 100px; width: 100px;">
                                                </div>
                                                <div>
                                                    <div class="text-danger card-content" style="height: 48px">
                                                        <strong>
                                                            {{ $job->name }}
                                                        </strong>
                                                    </div>
                                                    <div class="text-secondary card-content" style="font-size: 12px;height: 36;">
                                                        {{ $job->employer->name }}
                                                    </div>
                                                    <div class="d-flex flex-wrap gap-3" style="font-size: 12px;">
                                                        <div class="badge rounded text-bg-success p-1"
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
                                                        <div class="badge rounded text-bg-success p-1"
                                                            style="background-color: rgba(127, 255, 212, 0.3);">
                                                            {{ $job->location }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ps-3">
                        <div class="d-flex flex-column gap-4">
                            <div class="bg-white rounded-3 p-4 d-flex flex-column gap-4">
                                <h4>
                                    {{ __('employer information') }}
                                </h4>
                                <div class="d-flex gap-3">
                                    <div class="text-center rounded-circle"
                                        style="align-content: center; min-width: 50px; height: 50px; background-color: rgba(127, 255, 212, 0.6);">
                                        <i class="bi bi-geo-alt text-primary"></i>
                                    </div>
                                    <div>{{ $employer->address }}</div>
                                </div>
                                <div class="d-flex gap-3">
                                    <div class="text-center rounded-circle"
                                        style="align-content: center; min-width: 50px; height: 50px; background-color: rgba(127, 255, 212, 0.6);">
                                        <i class="bi bi-person-circle text-primary"></i>
                                    </div>
                                    <div>
                                        <div>{{ __('view candidate profile') }} {{ 100 }}%</div>
                                        <div>({{ __("average") }} {{ 5 }} {{ __('hours') }})</div>
                                    </div>
                                </div>
                                <div class="d-flex gap-3">
                                    <a href="{{ $employer->facebook }}"><i class="bi bi-facebook"></i></a>
                                    <a href="{{ $employer->google }}"><i class="bi bi-google"></i></a>
                                    <a href="{{ $employer->linkedin }}"><i class="bi bi-linkedin"></i></a>
                                </div>
                                <div id="map" style="height: 300px;"></div>
                                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
                                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
                                <script>
                                    // Khởi tạo bản đồ
                                    const map = L.map('map').setView([10.0299, 105.7706], 13); // Tọa độ: Cần Thơ, zoom: 13

                                    // Thêm layer bản đồ OpenStreetMap
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                    }).addTo(map);

                                    // Thêm một marker
                                    L.marker([10.0299, 105.7706]).addTo(map)
                                        .bindPopup('Cần Thơ')
                                        .openPopup();
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container bg-white rounded-3 p-4 d-flex flex-column gap-4">
                <h4>
                    {{ __('employer images') }}
                </h4>
                <div class="d-flex gap-3">
                    {{-- @foreach ($employer->images as $image)
                        <img src="{{ asset($image->image) }}" alt="{{ $employer->name }}" height="150" width="150">
                    @endforeach --}}
                </div>
            </div>
        </section>
        {{-- <section id="danhgia"
            class="change-show py-4 d-flex flex-column justify-content-center align-items-center gap-4">
            <div class="container p-0 row">
                <div class="col-lg-8">
                    <div class="pe-3">
                        <div class="d-flex gap-4">
                            <div class="rounded-3 p-5 d-flex flex-column gap-5 w-100" style="background-color: steelblue;">
                                <div class="text-white">
                                    {{ __('rated') }}
                                </div>
                                <div class="d-flex align-items-end">
                                    <h2>4.0</h2>
                                    <h4>/ 5</h4>
                                </div>
                                <div class="d-flex gap-2">
                                    <i class="bi bi-star-fill text-white btn btn-warning"></i>
                                    <i class="bi bi-star-fill text-white btn btn-warning"></i>
                                    <i class="bi bi-star-fill text-white btn btn-warning"></i>
                                    <i class="bi bi-star-fill text-white btn btn-warning"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                </div>
                            </div>
                            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                            <div class="d-flex flex-column justify-content-between w-100" style="height: 300px;">
                                <div>{{ __('salary & benefits') }}</div>
                                <div style="background-color: lightgray;">
                                    <div style="height:24px;width:80%;background-color: steelblue;"></div>
                                </div>
                                <div>{{ __('training & learning') }}</div>
                                <div style="background-color: lightgray;">
                                    <div style="height:24px;width:80%;background-color: steelblue;"></div>
                                </div>
                                <div>{{ __('employee care') }}</div>
                                <div style="background-color: lightgray;">
                                    <div style="height:24px;width:80%;background-color: steelblue;"></div>
                                </div>
                                <div>{{ __('company culture') }}</div>
                                <div style="background-color: lightgray;">
                                    <div style="height:24px;width:80%;background-color: steelblue;"></div>
                                </div>
                                <div>{{ __('workplace') }}</div>
                                <div style="background-color: lightgray;">
                                    <div style="height:24px;width:80%;background-color: steelblue;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ps-3">
                        <div class="d-flex flex-column gap-4">
                            <form class="bg-white rounded-3 p-4 d-flex flex-column gap-4" action="">
                                <h4>{{ __('write a review about the company') }}</h4>
                                <div>{{ __('salary & benefits') }} <sup class="text-danger">*</sup></div>
                                <div class="d-flex gap-2 luong">
                                    <input type="hidden" name="luong" id="luong" value="1">
                                    <i class="bi bi-star-fill text-white btn btn-warning"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                </div>
                                <div>{{ __('training & learning') }} <sup class="text-danger">*</sup></div>
                                <div class="d-flex gap-2 dao">
                                    <input type="hidden" name="dao" id="dao" value="1">
                                    <i class="bi bi-star-fill text-white btn btn-warning"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                </div>
                                <div>{{ __('employee care') }} <sup class="text-danger">*</sup></div>
                                <div class="d-flex gap-2 su">
                                    <input type="hidden" name="su" id="su" value="1">
                                    <i class="bi bi-star-fill text-white btn btn-warning"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                </div>
                                <div>{{ __('company culture') }} <sup class="text-danger">*</sup></div>
                                <div class="d-flex gap-2 vanhoa">
                                    <input type="hidden" name="vanhoa" id="vanhoa" value="1">
                                    <i class="bi bi-star-fill text-white btn btn-warning"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                </div>
                                <div>{{ __('workplace') }} <sup class="text-danger">*</sup></div>
                                <div class="d-flex gap-2 vanphong">
                                    <input type="hidden" name="vanphong" id="vanphong" value="1">
                                    <i class="bi bi-star-fill text-white btn btn-warning"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                    <i class="bi bi-star-fill text-white btn btn-secondary"></i>
                                </div>
                                <div><input type="text" class="form-control" name="title" placeholder="{{ __('title') }} *">
                                </div>
                                <div><input type="text" class="form-control" name="content" placeholder="{{ __('content') }} *">
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('submit review') }}
                                </button>
                                <ul class="small">
                                    <li>{{ __('your review will be anonymous') }}</li>
                                    <li>{{ __('help job seekers understand more about the company') }}</li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </main>
@endsection
