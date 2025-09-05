@extends('layouts.user.index')

@section('title', request()->getHost() . ': ' . $job->name)

@section('content')
    <main>
        <section>
            <div class="container-fluid px-0">
                <div class="container-fluid row p-0">
                    <div class="col-md-8 p-0">
                        <form class="px-5" style="position: relative;" action="{{ route('jobs') }}" method="GET">
                            <div class="p-3" style="background-color: darkblue;position: sticky;top:60px">
                                <div class="d-flex">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold bg-white border-end-0 p-3">
                                            {{ __('keyword') }}:
                                        </span>
                                        <input type="text" aria-label="key_word" class="form-control border-start-0 p-3"
                                            name="key_word" placeholder="{{ __('job, company, profession...') }}">
                                        <span class="input-group-text fw-bold  bg-white border-end-0 p-3">
                                            {{ __('location') }}:
                                        </span>
                                        <input type="text" aria-label="location" class="form-control border-start-0 p-3"
                                            name="location" placeholder="{{ __('city, district...') }}">
                                    </div>
                                    <button type="submit" class="btn ms-3 text-white w-25"
                                        style="background-color: dodgerblue;">
                                        <strong> {{ __('search job') }}</strong>
                                    </button>
                                </div>
                            </div>
                            <div class="px-3" style="background-color: rgba(173, 216, 230, 0.5);">
                                {{ config('app.name') }} / {{ __('job') }} / {{ $job->name }}
                            </div>
                        </form>

                        <div class="p-5">
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
                            <div class="d-flex gap-4">
                                <div class="w-100">

                                    <button
                                        class="text-uppercase btn btn-primary w-100 fw-bold @disabled($job->expired < now())"
                                        data-bs-toggle="modal" data-bs-target="#appliedModal">
                                        <i class="bi bi-send-fill"></i>
                                        @if ($job->expired >= now())
                                            {{ __('apply now') }}
                                        @else
                                            {{ __('job expired') }}
                                        @endif

                                    </button>
                                    @auth('user')
                                        <div class="modal fade" id="appliedModal" tabindex="-1"
                                            aria-labelledby="appliedModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form class="modal-content" method="POST"
                                                    action="{{ route('candidate.applieds.store') }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="appliedModalLabel">
                                                            {{ __('choose attachment') }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="attachment"
                                                                id="default" value="" checked>
                                                            <label class="form-check-label" for="default">
                                                                {{ __('no attachment') }}
                                                            </label>
                                                        </div>

                                                        @php
                                                            $attachments = \App\Models\Attachment::where(
                                                                'user_id',
                                                                auth()->guard('user')->id(),
                                                            )->get();
                                                        @endphp
                                                        @foreach ($attachments as $attachment)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="attachment"
                                                                    id="{{ $attachment->id }}" value="{{ $attachment->id }}">
                                                                <label class="form-check-label" for="{{ $attachment->id }}">
                                                                    {{ $attachment->attachment }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            {{ __('close') }}
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-send-plus-fill"></i>
                                                            {{ __('apply now') }}
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endauth
                                    @guest('user')
                                        <div class="modal fade" id="appliedModal" tabindex="-1"
                                            aria-labelledby="appliedModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="appliedModalLabel">
                                                            {{ __('choose attachment') }}
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('you need to login to apply for this job') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endguest
                                </div>
                                <form class="w-50" method="POST"
                                    action="{{ route('candidate.saveds.store', $job->id) }}">
                                    @csrf
                                    <button type="submit" @disabled(auth()->guard('user')->guest())
                                        class="btn w-100 
                                        {{ \App\Models\Saved::where('user_id', auth()->guard('user')->id())->where('job_id', $job->id)->exists()? 'btn-primary disabled': 'btn-outline-primary' }}"
                                        value="{{ $job->id }}" name="job_id">
                                        <i class="bi bi-heart"></i>
                                        {{ \App\Models\Saved::where('user_id', auth()->guard('user')->id())->where('job_id', $job->id)->exists()? __('saved'): __('save') }}
                                    </button>
                                </form>
                                <div class="w-50">
                                    <button class="btn btn-outline-primary w-100">
                                        <i class="bi bi-share"></i>
                                        {{ __('share') }}
                                    </button>
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
                            {{-- <br>
                            <div class="container">
                                <div class="alert alert-danger">
                                    <i>
                                        <strong>{{ Chú ý }}:</strong>
                                        Nếu bạn thấy rằng tin tuyển dụng này không đúng hoặc có dấu hiệu lừa đảo,
                                        <a href="" class="text-primary" style="text-decoration: underline;">hãy
                                            gửi phản
                                            ánh đến chúng tôi</a>
                                    </i>
                                </div>
                            </div> --}}
                            <br>
                            <div class="container">
                                <div class="d-flex justify-content-between">
                                    <h5 class="h3">{{ __('RELATED JOBS') }}</h5>
                                    <a class="text-primary" href="{{ route('jobs') }}">
                                        {{ __('see more') }}
                                        <i class="bi bi-caret-right-fill"></i>
                                    </a>
                                </div>
                                <br>
                                @php
                                    $relatedJobs = \App\Models\Job::whereNotNull('admin_id')
                                    ->where('is_stop',  false)
                                    ->where('expired', '>=', now())
                                    ->where('id', '!=', $job->id)
                                    ->WhereHas('employer.professions', function ($q) use ($job) {
                                        $q->whereIn('id', $job->employer->professions->pluck('id'));
                                    })
                                    ->limit(8)
                                    ->get();
                                @endphp
                                <div class="row row-cols-2 g-2">
                                    @foreach ($relatedJobs as $relatedJob)
                                        <div class="col">
                                            <a href="{{ route('job', $relatedJob->id) }}"
                                                class="bg-white p-3 rounded-2 d-flex gap-3 border">
                                                <div>
                                                    <img src="{{ asset($relatedJob->employer->image) }}"
                                                        alt="{{ $relatedJob->employer->name }}"
                                                        style="height: 100px; width: 100px;">
                                                </div>
                                                <div>
                                                    <div class="text-danger card-content">
                                                        <strong>
                                                            {{ $relatedJob->name }}
                                                        </strong>
                                                    </div>
                                                    <div class="text-secondary card-content" style="font-size: 12px;">
                                                        {{ $relatedJob->employer->name }}
                                                    </div>
                                                    <div class="d-flex flex-wrap gap-3" style="font-size: 12px;">
                                                        <div class="border border-primary p-1 rounded-2"
                                                            style="background-color: rgba(127, 255, 212, 0.3);">
                                                            @if (is_null($relatedJob->min_salary) && is_null($relatedJob->max_salary))
                                                                {{ __('negotiate') }}
                                                            @elseif (is_null($relatedJob->max_salary))
                                                                {{ __('over') }} {{ $relatedJob->min_salary }}
                                                                {{ __($relatedJob->type_salary) }}
                                                            @elseif (is_null($relatedJob->min_salary))
                                                                {{ __('up to') }} {{ $relatedJob->max_salary }}
                                                                {{ __($relatedJob->type_salary) }}
                                                            @else
                                                                {{ $relatedJob->min_salary }} -
                                                                {{ $relatedJob->max_salary }}
                                                                {{ __($relatedJob->type_salary) }}
                                                            @endif
                                                        </div>
                                                        <div class="border border-primary p-1 rounded-2"
                                                            style="background-color: rgba(127, 255, 212, 0.3);">
                                                            {{ $relatedJob->location }}
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
                    <div class="col-md-4 p-0">
                        <div class="px-1">
                            <div class="bg-white border rounded-2 p-4">
                                <div class="text-center">
                                    <img src="{{ asset($job->employer->image) }}" alt="{{ $job->employer->name }}"
                                        height="100" class="rounded-3 w-100">
                                </div>
                                <br>
                                <h4 class="text-center fw-bold ">

                                    {{ $job->employer->name }}

                                </h4>
                                <br>
                                <div>
                                    <div>
                                        <i class="bi bi-briefcase text-primary"></i>
                                        <strong>{{ __('field') }}:</strong>
                                        @foreach ($job->employer->professions as $profession)
                                            {{ $profession->name }}
                                        @endforeach
                                    </div>
                                    <div>
                                        <i class="bi bi-geo-alt text-primary"></i>
                                        <strong>{{ __('address') }}:</strong>
                                        {{ $job->employer->address }}
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <div class="fw-bold">{{ __('OTHER JOBS WITH THE COMPANY') }}</div>
                                    <a class="text-primary"
                                        href="{{ route('jobs', ['employer' => $job->employer_id]) }}">
                                        {{ __('see more') }}
                                        <i class="bi bi-caret-right-fill"></i>
                                    </a>
                                </div>
                                <br>
                                <div class="d-flex flex-column gap-4">
                                    @php
                                        $employerJobs = $job->employer->jobs()
                                        ->whereNot('id', $job->id)
                                        ->whereNotNull('admin_id')
                                        ->where('is_stop',  false)
                                        ->where('expired', '>=', now())
                                        ->get()
                                        ->take(5);
                                    @endphp
                                    @foreach ($employerJobs as $employerJob)
                                        <a href="{{ route('job', $employerJob->id) }}"
                                            class="bg-white p-3 rounded-2 d-flex gap-3 border">
                                            <div>
                                                <img src="{{ asset($job->employer->image) }}"
                                                    alt="{{ $employerJob->employer->name }}"
                                                    style="height: 100px; width: 100px;">
                                            </div>
                                            <div>
                                                <div class="text-danger card-content">
                                                    <strong>
                                                        {{ $employerJob->name }}
                                                    </strong>
                                                </div>
                                                <div class="text-secondary card-content" style="font-size: 12px;">
                                                    {{ $employerJob->employer->name }}
                                                </div>
                                                <div class="d-flex flex-wrap gap-3" style="font-size: 12px;">
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        @if (is_null($employerJob->min_salary) && is_null($employerJob->max_salary))
                                                            {{ __('negotiate') }}
                                                        @elseif (is_null($employerJob->max_salary))
                                                            {{ __('over') }} {{ $employerJob->min_salary }}
                                                            {{ __($employerJob->type_salary) }}
                                                        @elseif (is_null($employerJob->min_salary))
                                                            {{ __('up to') }} {{ $employerJob->max_salary }}
                                                            {{ __($employerJob->type_salary) }}
                                                        @else
                                                            {{ $employerJob->min_salary }} -
                                                            {{ $employerJob->max_salary }}
                                                            {{ __($employerJob->type_salary) }}
                                                        @endif
                                                    </div>
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        {{ $employerJob->location }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
