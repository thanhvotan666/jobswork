@extends('layouts.user.index')

@section('title', request()->getHost() . ': Tìm việc mong ước')

@section('content')
    <main>
        <section>
            <div class="container-fluid p-0">
                <div class="container">
                    <div>
                        <div class="px-3" style="background-color: rgba(173, 216, 230, 0.5);">
                            {{ config('app.name') }} /{{ __('manage profile') }} / {{ __('saved jobs') }}
                        </div>
                        <div class="px-3 py-2 bg-white fw-bold border-bottom border-primary ">
                            {{ __('saved jobs') }}
                        </div>
                    </div>
                    <br>
                    <div class="d-flex">
                        <div style="min-width: 150px;">
                            <strong>
                                {{ __('sort') }}:
                            </strong>
                        </div>
                        <form class="d-flex gap-3">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="sort" id="oldest" value="oldest"
                                    onchange="this.form.submit()" {{ request('sort') == 'oldest' ? 'checked' : '' }}>
                                <label class="form-check-label" for="oldest">
                                    {{ __('oldest') }}
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="sort" id="newest" value="newest"
                                    onchange="this.form.submit()"
                                    {{ request('sort', 'newest') == 'newest' ? 'checked' : '' }}>
                                <label class="form-check-label" for="newest">
                                    {{ __('newest') }}
                                </label>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div>
                        <div class="row row-cols-2 g-2">
                            @foreach ($saveds as $saved)
                                <div class="col">
                                    <div class="bg-white p-3 rounded-2 border">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <strong>{{ __('save date') }}:</strong>
                                                {{ $saved->created_at->format('d/m/Y') }}
                                            </div>
                                            <div>
                                                <form action="{{ route('candidate.saveds.destroy', $saved->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger p-1">
                                                        <i class="bi bi-trash"></i>
                                                        {{ __('cancel') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3">
                                            <a href="{{ route('job', $saved->job_id) }}">
                                                <img src="{{ asset($saved->job->employer->image) }}"
                                                    alt="{{ $saved->job->employer->name }}"
                                                    style="height: 100px; width: 100px;">
                                            </a>
                                            <div>
                                                <a href="{{ route('job', $saved->job_id) }}"
                                                    class="text-danger card-content">
                                                    <strong>
                                                        {{ $saved->job->name }}
                                                    </strong>
                                                </a>
                                                <div class="text-secondary card-content" style="font-size: 12px;">
                                                    {{ $saved->job->employer->name }}
                                                </div>
                                                <div class="d-flex flex-wrap gap-3" style="font-size: 12px;">
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        @if (is_null($saved->job->min_salary) && is_null($saved->job->max_salary))
                                                            {{ __('negotiate') }}
                                                        @elseif (is_null($saved->job->max_salary))
                                                            {{ __('over') }} {{ $saved->job->min_salary }}
                                                            {{ __($saved->job->type_salary) }}
                                                        @elseif (is_null($saved->job->min_salary))
                                                            {{ __('up to') }} {{ $saved->job->max_salary }}
                                                            {{ __($saved->job->type_salary) }}
                                                        @else
                                                            {{ $saved->job->min_salary }} -
                                                            {{ $saved->job->max_salary }}
                                                            {{ __($saved->job->type_salary) }}
                                                        @endif
                                                    </div>
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        {{ $saved->job->location }}
                                                    </div>
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        {{ $saved->job->created_at->diffForHumans() }}
                                                    </div>
                                                    <div class="border border-primary p-1 rounded-2"
                                                        style="background-color: rgba(127, 255, 212, 0.3);">
                                                        {{ __($saved->job->demand) }}
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
                    <div class="text-center">
                        {{ $saveds->appends(['sort' => request('sort')])->links() }}
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
