@extends('layouts.admin.index')
@section('title', request()->getHost() . ': '  . $job->name)
@section('content')
    <main>
        <section>
            <div class="container-fluid px-0">
                <div class="container-fluid">
                    <div class="p-0">
                            <h1>{{ $job->name }}</h1>
                            <br>
                            <div class="d-flex flex-wrap gap-3" style="font-size: 12px;">
                                <div class="border border-primary p-1 rounded-2"
                                    style="background-color: rgba(127, 255, 212, 0.3);">
                                    <i class="bi bi-clock"></i>
                                    @if ($job->expired >= today())
                                        {{ __('expired in') }}
                                        {{ \Carbon\Carbon::parse($job->expired)->diffInDays(today()) }}
                                        {{ __('days left') }}
                                    @else
                                        {{ __('job expired') }}
                                    @endif
                                </div>
                                <div class="border border-primary p-1 rounded-2"
                                    style="background-color: rgba(127, 255, 212, 0.3);">
                                    <i class="bi bi-cash"></i>
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
                            </div>
                            <br>
                            <div class="container text-center">
                                <div class="row row-cols-3 g-2 g-lg-3">
                                    <div class="col">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/image/icon/ic19.svg') }}" alt="demand">
                                            <div class="text-start ms-1">
                                                <div class="fw-bold">{{ __('demand job') }}</div>
                                                <div>{{ __($job->demand) }} </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/image/icon/ic20.svg') }}" alt="position">
                                            <div class="text-start ms-1">
                                                <div class="fw-bold">
                                                    {{ __('position') }}
                                                </div>
                                                <div>{{ $job->position }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/image/icon/ic21.svg') }}" alt="degree">
                                            <div class="text-start ms-1">
                                                <div class="fw-bold">
                                                    {{ __('degree required') }}
                                                    ({{ __('minimum') }})
                                                </div>
                                                <div>{{ $job->degree }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/image/icon/ic22.svg') }}" alt="">
                                            <div class="text-start ms-1">
                                                <div class="fw-bold">{{ __('experience required') }}</div>
                                                <div>
                                                    {{ $job->experience == 0
                                                        ? __('no experience')
                                                        : ($job->experience == 6
                                                            ? __('over 5 years')
                                                            : $job->experience . ' ' . __('years')) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/image/icon/ic27.svg') }}" alt="created_at">
                                            <div class="text-start ms-1">
                                                <div class="fw-bold">{{ __('created date') }} </div>
                                                <div>{{ $job->created_at }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col">
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/image/icon/ic26.svg') }}" alt="languare">
                                            <div class="text-start ms-1">
                                                <div class="fw-bold">Yêu cầu ngôn ngữ</div>
                                                <div>Tiếng Anh</div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                <br>
                                <div class="">
                                    <div>
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/image/icon/ic24.svg') }}" alt="professions">
                                            <div class="text-start ms-1">
                                                <div class="fw-bold">
                                                    {{ __('profession') }}
                                                </div>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($job->professions as $jobProfession)
                                                        <a href="{{ route('jobs', ['profession' => $jobProfession->profession->id]) }}"
                                                            class="text-info">{{ $jobProfession->profession->name }}</a>
                                                        {{ $loop->last ? '' : ',' }}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/image/icon/ic25.svg') }}" alt="skills">
                                            <div class="text-start ms-1">
                                                <div class="fw-bold">
                                                    {{ __('skills') }}
                                                </div>
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach ($job->skills as $skill)
                                                        <a href="{{ route('jobs', ['skill' => $skill->name]) }}"
                                                            class="text-info">{{ $skill->name }}</a>
                                                        {{ $loop->last ? '' : ',' }}
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <div class="d-flex">
                                            <img src="{{ asset('storage/image/icon/ic23.svg') }}" alt="location">
                                            <div class="text-start ms-1">
                                                <div class="fw-bold">
                                                    {{ __('location') }}
                                                </div>
                                                <div>- {{ $job->address }}</div>
                                                <div class="d-flex flex-wrap gap-4">
                                                    <a href="{{ route('jobs', ['location' => $job->location]) }}"
                                                        class="text-info">
                                                        <i class="bi bi-geo-alt"></i>
                                                        {{ __('job') }} {{ $job->location }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="container">
                                <div>
                                    <strong>
                                        {{ __('description') }}
                                    </strong>
                                </div>
                                <div>
                                    <pre>{{ $job->description }}</pre>
                                </div>
                                <div><strong>
                                        {{ __('requirement') }}
                                    </strong></div>
                                <div>
                                    <pre>{{ $job->requirement }}</pre>
                                </div>
                                <div><strong>
                                        {{ __('benefits') }}
                                    </strong></div>
                                <div>
                                    <pre>{{ $job->benefits }}</pre>
                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
