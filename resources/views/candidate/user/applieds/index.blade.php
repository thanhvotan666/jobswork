@extends('layouts.user.index')

@section('title', request()->getHost() . ': ' . __('manage profile') . ' / ' . __('applied jobs'))

@section('content')
    <main>
        <section>
            <div class="container-fluid p-0">
                <form class="container" method="GET" action="{{ route('candidate.applieds.index') }}">
                    <div>
                        <div class="px-3" style="background-color: rgba(173, 216, 230, 0.5);">
                            {{ config('app.name') }} / {{ __('manage profile') }} / {{ __('applied jobs') }}
                        </div>
                        <div class="px-3 py-2 bg-white fw-bold border-bottom border-primary ">
                            {{ __('applied jobs') }}
                        </div>
                    </div>
                    <br>
                    <div class="d-flex">
                        <div style="min-width: 150px;"><strong>{{ __('filter') }}</strong></div>
                        {{-- new suitable contact interview offer success failed --}}
                        <div class="d-flex flex-wrap gap-2 small" style="font-size: smaller;">
                            <input type="hidden" name="status" value="{{ request('status', '') }}">
                            <button type="button" value=""
                                onclick="this.form.status.value=this.value; this.form.submit();"
                                class="btn btn-outline-primary 
                            {{ request('status', '') != '' ?: 'active' }}">
                                {{ __('see all') }}
                            </button>
                            <button type="button" value="new"
                                onclick="this.form.status.value=this.value; this.form.submit();"
                                class="btn btn-outline-primary 
                            {{ request('status', '') == 'new' ? 'active' : '' }}">
                                {{ __('new') }}
                            </button>
                            <button type="button" value="suitable"
                                onclick="this.form.status.value=this.value; this.form.submit();"
                                class="btn btn-outline-primary 
                            {{ request('status', '') == 'suitable' ? 'active' : '' }}">
                                {{ __('suitable') }}
                            </button>
                            <button type="button" value="contact"
                                onclick="this.form.status.value=this.value; this.form.submit();"
                                class="btn btn-outline-primary 
                            {{ request('status', '') == 'contact' ? 'active' : '' }}">
                                {{ __('contact') }}
                            </button>
                            <button type="button" value="interview"
                                onclick="this.form.status.value=this.value; this.form.submit();"
                                class="btn btn-outline-primary 
                            {{ request('status', '') == 'interview' ? 'active' : '' }}">
                                {{ __('interview') }}
                            </button>
                            <button type="button" value="offer"
                                onclick="this.form.status.value=this.value; this.form.submit();"
                                class="btn btn-outline-primary 
                            {{ request('status', '') == 'offer' ? 'active' : '' }}">
                                {{ __('offer') }}
                            </button>
                            <button type="button" value="success"
                                onclick="this.form.status.value=this.value; this.form.submit();"
                                class="btn btn-outline-primary 
                            {{ request('status', '') == 'success' ? 'active' : '' }}">
                                {{ __('applied success') }}
                            </button>
                            <button type="button" value="failed"
                                onclick="this.form.status.value=this.value; this.form.submit();"
                                class="btn btn-outline-primary 
                            {{ request('status', '') == 'failed' ? 'active' : '' }}">
                                {{ __('applied failed') }}
                            </button>
                        </div>
                    </div>
                    <br>
                    <div class="d-flex">
                        <div style="min-width: 150px;"><strong>
                                {{ __('sort') }}
                            </strong></div>
                        <div class="d-flex gap-5">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="sort" id="oldest" value="oldest"
                                    onchange="this.form.submit()" @checked(request('sort', 'newest') == 'oldest')>
                                <label class="form-check-label" for="oldest">
                                    {{ __('oldest') }}
                                </label>
                            </div>

                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="sort" id="newest" value="newest"
                                    onchange="this.form.submit()" @checked(request('sort', 'newest') == 'newest')>
                                <label class="form-check-label" for="newest">
                                    {{ __('newest') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="container">
                        <div class="row row-cols-xl-2 g-2">
                            @foreach ($applieds as $applied)
                                <div class="col">
                                    <div class="bg-white p-3 rounded-2 border">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <strong>
                                                    {{ __('applied date') }}
                                                    :</strong>
                                                {{ $applied->created_at }}
                                            </div>
                                            <div>
                                                {{-- new suitable contact interview offer success failed --}}
                                                @if ($applied->status == 'new')
                                                    <div class="text-success">
                                                        {{ __('new') }}
                                                    </div>
                                                @elseif ($applied->status == 'suitable')
                                                    <div class="text-warning">
                                                        {{ __('suitable') }}
                                                    </div>
                                                @elseif ($applied->status == 'contact')
                                                    <div class="text-primary">
                                                        {{ __('contact') }}
                                                    </div>
                                                @elseif ($applied->status == 'interview')
                                                    <div class="text-info">
                                                        {{ __('interview') }}
                                                    </div>
                                                @elseif ($applied->status == 'offer')
                                                    <div class="text-success">
                                                        {{ __('offer') }}
                                                    </div>
                                                @elseif ($applied->status == 'success')
                                                    <div class="text-success">
                                                        {{ __('applied success') }}
                                                    </div>
                                                @elseif ($applied->status == 'failed')
                                                    <div class="text-danger">
                                                        {{ __('applied failed') }}
                                                    </div>
                                                @else
                                                    <div class="text-warning">
                                                        {{ __('unknown') }}
                                                    </div>
                                                @endif
                                                {{-- <button type="button" class="btn btn-outline-danger p-1">
                                                    <i class="bi bi-trash"></i>
                                                    Hủy bỏ
                                                </button> --}}
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('job', $applied->job->id) }}">
                                                <img src="{{ asset($applied->job->employer->image) }}"
                                                    alt="{{ $applied->job->employer->name }}"
                                                    style="height: 100px; width: 100px;">
                                            </a>
                                            <div>
                                                <a href="{{ route('job', $applied->job->id) }}"
                                                    class="text-danger card-content">
                                                    <strong>
                                                        {{ $applied->job->name }}
                                                    </strong>
                                                </a>
                                                <div class="text-secondary card-content" style="font-size: 12px;">
                                                    {{ $applied->job->employer->name }}
                                                </div>
                                                <div class="d-flex flex-wrap gap-3" style="font-size: 12px;">
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        @if (is_null($applied->job->min_salary) && is_null($applied->job->max_salary))
                                                            {{ __('negotiate') }}
                                                        @elseif (is_null($applied->job->max_salary))
                                                            {{ __('over') }} {{ $applied->job->min_salary }}
                                                            {{ $applied->job->type_salary }}
                                                        @elseif (is_null($applied->job->min_salary))
                                                            {{ __('up to') }} {{ $applied->job->max_salary }}
                                                            {{ $applied->job->type_salary }}
                                                        @else
                                                            {{ $applied->job->min_salary }} -
                                                            {{ $applied->job->max_salary }}
                                                            {{ $applied->job->type_salary }}
                                                        @endif
                                                    </div>
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        {{ $applied->job->address }}
                                                    </div>
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        {{ $applied->job->expired }}
                                                    </div>
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        {{ $applied->job->demand }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <br>
                    <div class="container">
                        <div class="d-flex justify-content-between">
                            <h5 class="h3">{{ __('RELATED JOBS') }}</h5>
                            <a class="text-primary" href="{{ route('jobs') }}">
                                {{ __('see more') }}
                                <i class="bi bi-caret-right-fill"></i>
                            </a>
                        </div>
                        {{-- <br>
                        @php
                            $relatedJobs = \App\Models\Job::where('expired', '>=', today())
                                ->where('id', '!=', $job->id)
                                ->orWhereHas('employer.professions', function ($q) use ($job) {
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
                        </div> --}}
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection
