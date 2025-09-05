@extends('layouts.user.index')

@section('title', request()->getHost() . ': Tìm việc mong ước')

@section('content')
    <main>
        <section>
            <div class="container-fluid px-0">
                <div class=" row">
                    <div class="col-md-9">
                        <form id='search-form' class="px-5" style="position: relative;" method="GET"
                            action="{{ route('jobs') }}">
                            <div class="p-3" style="background-color: darkblue;position: sticky;top:60px;z-index: 1;">
                                <div class="d-flex">
                                    <div class="input-group">
                                        <span class="input-group-text fw-bold bg-white border-end-0 p-3">
                                            {{ __('keyword') }}:
                                        </span>
                                        <input type="text" aria-label="key_word" class="form-control border-start-0 p-3"
                                            name="key_word" value="{{ request('key_word') }}"
                                            placeholder="{{ __('job, company, profession...') }}">
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
                                    <button type="submit" class="btn ms-3 text-white w-25"
                                        style="background-color: dodgerblue;">
                                        <strong>
                                            {{ __('search job') }}
                                        </strong>
                                    </button>
                                </div>
                            </div>
                            <div class="p-3" style="background-color: darkblue;">
                                <div class="d-flex gap-3" style="font-size: small;">
                                    <select class="form-control text-truncate w-100" name="profession"
                                        onchange="this.form.submit()">
                                        <option value="" @selected(request('profession', '') == '')>
                                            {{ __('profession') }}
                                        </option>
                                        @foreach (\App\Models\Profession::all() as $profession)
                                            <option value="{{ $profession->id }}" @selected(request('profession', '') == $profession->id)>
                                                {{ $profession->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select class="form-control text-truncate w-100" name="demand"
                                        onchange="this.form.submit()">
                                        <option value="" @selected(request('demand', '') == '')>
                                            {{ __('demand') }}
                                        </option>
                                        @foreach (['fulltime', 'parttime', 'urgent', 'online', 'remote'] as $demand)
                                            <option value="{{ $demand }}" @selected(request('demand', '') == $demand)>
                                                {{ __($demand) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <select class="form-control text-truncate w-100" name="experience"
                                        onchange="this.form.submit()">
                                        <option value="" @selected(request('experience', '') == '')>

                                            {{ __('experience') }}
                                        </option>
                                        <option value="0" @selected(request('experience', '') == 1)>

                                            {{ __('no experience') }}
                                        </option>
                                        <option value="1" @selected(request('experience', '') == 1)>1 {{ __('years') }}</option>
                                        <option value="2" @selected(request('experience', '') == 2)>2 {{ __('years') }}</option>
                                        <option value="3" @selected(request('experience', '') == 3)>3 {{ __('years') }}</option>
                                        <option value="4" @selected(request('experience', '') == 4)>4 {{ __('years') }}</option>
                                        <option value="5" @selected(request('experience', '') == 5)>5 {{ __('years') }}</option>
                                        <option value="6" @selected(request('experience', '') == 6)>{{ __('over 5 years') }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="px-3" style="background-color: rgba(173, 216, 230, 0.5);">
                                {{ config('app.name') }} / {{ __('jobs') }}
                            </div>
                            <div class="px-3 py-1 border-bottom border-primary d-flex justify-content-between"
                                style="background-color: rgba(235, 235, 235, 0.5);">
                                <div class="fw-bold ">
                                    {{ __('recruitment') }}
                                    {{ $jobs_count }}
                                    {{ __('latest jobs') }}
                                    {{ __('in') }}
                                    {{ __('year') }}
                                    {{ now()->year }}
                                </div>
                                <div>
                                    {{ __('job') }}
                                    {{ 1 * request('page', 1) }}
                                    -
                                    {{ $jobs->count() * request('page', 1) }}
                                    /
                                    {{ $jobs_count }}
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    {{ __('show by') }}:
                                    :</div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort" value="new" checked>
                                    <label class="form-check-label">
                                        {{ __('newest jobs') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort" value="salary">
                                    <label class="form-check-label">
                                        {{ __('highest salary') }}
                                    </label>
                                </div>
                            </div>
                        </form>

                        <div class="p-5">
                            <div class="row row-cols-lg-2 g-2 px-3">
                                <!-- limit 20 -->
                                @foreach ($jobs as $job)
                                    <div class="col">
                                        <a href="{{ route('job', $job->id) }}"
                                            class="bg-white p-3 rounded-2 d-flex gap-3 border">
                                            <div>
                                                <img src="{{ asset($job->employer->image)  }}" alt="{{ $job->employer->name }}"
                                                    style="height: 100px; width: 100px;">
                                            </div>
                                            <div>
                                                <div class="text-danger card-content" style="height: 48px">
                                                    <strong>
                                                        {{ $job->is_hot ? '🔥' : '' }} {{ $job->name }} 
                                                    </strong>
                                                </div>
                                                <div class="text-secondary card-content" style="font-size: 12px; height: 36px;">
                                                    {{ $job->employer->name }}
                                                </div>
                                                <div class="d-flex flex-wrap gap-3" style="font-size: 10px;">
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
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        @if ($job->experience == 0)
                                                            {{ __('no experience') }}
                                                        @elseif ($job->experience == 1)
                                                            1 {{ __('year') }}
                                                        @elseif ($job->experience == 2)
                                                            2 {{ __('year') }}
                                                        @elseif ($job->experience == 3)
                                                            3 {{ __('year') }}
                                                        @elseif ($job->experience == 4)
                                                            4 {{ __('year') }}
                                                        @elseif ($job->experience == 5)
                                                            5 {{ __('year') }}
                                                        @else
                                                            {{ __('over 5 years') }}
                                                        @endif
                                                    </div>
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        {{ $job->created_at->diffForHumans() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div class="px-3">
                                {{ $jobs->appends([
                                        'key_word' => request('key_word'),
                                        'location' => request('location'),
                                        'profession' => request('profession'),
                                        'demand' => request('demand'),
                                        'experience' => request('experience'),
                                        'sort' => request('sort'),
                                    ])->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3">
                            <img class="d-none d-lg-block" style="border-radius:4px"
                                src="https://jobsgo.vn/uploads/banner/202410/banner_bds_390_350.png" width="100%"
                                loading="lazy" alt="jobsgo">
                            <img class="d-block d-lg-none"
                                src="https://jobsgo.vn/uploads/banner/202410/banner_bds_390_150.png" width="100%"
                                loading="lazy" alt="jobsgo">
                        </div>
                    </div>
                </div>
                <!-- <div class="container">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <div></div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div> -->
            </div>
        </section>
    </main>
@endsection
