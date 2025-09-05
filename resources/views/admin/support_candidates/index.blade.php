@extends('layouts.admin.index')

@section('title', request()->getHost() . ': ' . __('recruitment support'))

@section('breadcrumb-item')
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('recruitment support') }}
    </li>
@endsection

@section('content')
<main>
    <section>   
        <h1>
            {{ __('recruitment support') }}
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
            <a href="{{route('admin.support_candidates.create')}}" class="btn btn-primary">
                {{ __("create new") }} +
            </a>
        </div>
        <hr>
    </section>
    <section>
        <div class="py-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">{{ __('avatar') }}</th>
                        <th scope="col">{{ __('name') }}</th>
                        <th scope="col">{{ __('job applied name') }}</th>
                        <th scope="col">{{ __('email') }} & {{ __('phone') }}</th>
                        <th scope="col">{{__('description')}}</th>
                        <th scope="col">{{ __('status') }}</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider" id="result">
                    @foreach ($supportCandidates as $supportCandidate)
                        <tr>
                            <th scope="row">
                                <button class="btn btn-lighter" data-bs-toggle="modal"
                                data-bs-target="#candidate{{ $supportCandidate->id }}Modal">
                                    <img src="{{ asset($supportCandidate->user->image) }}" alt="{{ $supportCandidate->user->name }}"
                                        class="rounded-circle" width="50" height="50">
                                </button>
                                <div class="modal fade" id="candidate{{ $supportCandidate->id }}Modal" tabindex="-1"
                                    aria-labelledby="candidate{{ $supportCandidate->id }}ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">
                                                    Info : {{ $supportCandidate->user->name }}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    {{ $supportCandidate->user->introduce }}
                                                </div>
                                                <hr>
                                                <div>
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <td class="pe-4">
                                                                <strong>{{ __('date of birth') }}: </strong>
                                                                {{ $supportCandidate->user->date_of_birth }}
                                                            </td>
                                                            <td class="ps-4">
                                                                <strong>{{ __('sex') }}: </strong>
                                                                {{ __($supportCandidate->user->sex) }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-4">
                                                                <strong>{{ __('location') }}: </strong>
                                                                {{ $supportCandidate->user->location }}
                                                            </td>
                                                            <td class="ps-4">
                                                                <strong>{{ __('address') }}: </strong>
                                                                {{ $supportCandidate->user->address }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-4">
                                                                <strong>{{ __('email') }}: </strong>
                                                                    <a href="mailto:{{ $supportCandidate->user->email }}"
                                                                        class="text-success">
                                                                        {{ $supportCandidate->user->email }}
                                                                    </a>
                                                            </td>
                                                            <td class="ps-4">
                                                                <strong>{{ __('phone') }}: </strong>
                                                                    <a href="tel:{{ $supportCandidate->user->phone }}"
                                                                        class="text-success">
                                                                        {{ $supportCandidate->user->phone }}
                                                                    </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                @if ($supportCandidate->user->professionalSkills->count() > 0)
                                                    <hr>
                                                    <div>
                                                        <strong>{{ __('skills') }}: </strong>
                                                        <div class="d-flex gap-4">
                                                            @foreach ($supportCandidate->user->professionalSkills as $skill)
                                                                <div
                                                                    class="d-flex flex-column justify-content-center gap-1">
                                                                    <span class="badge bg-primary">
                                                                        {{ $skill->professional_skill }}
                                                                    </span>
                                                                    <span class="badge bg-success">
                                                                        {{ $skill->year . ' ' . __('years') }}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($supportCandidate->user->workExperiences->count() > 0)
                                                    <hr>
                                                    <div>
                                                        <strong>{{ __('work experience') }}: </strong>
                                                        @foreach ($supportCandidate->user->workExperiences as $workExperience)
                                                            <div class="timeline-item">
                                                                <div class="timeline-line"></div>
                                                                <div class="timeline-dot"></div>
                                                                <div class="timeline-content ms-4">
                                                                    <div class="d-flex text-info gap-3">
                                                                        <div>{{ $workExperience->start_date }}</div>
                                                                        <div><i class="bi bi-arrow-right"></i></div>
                                                                        <div>{{ $workExperience->end_date }}</div>
                                                                    </div>
                                                                    <div class="d-flex flex-column gap-2">
                                                                        <div class="fs-5">
                                                                            {{ $workExperience->company }}
                                                                        </div>
                                                                        <pre class="text-secondary">{{ $workExperience->work_experience }}</pre>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                @if ($supportCandidate->user->learningProcesses->count() > 0)
                                                    <hr>
                                                    <div>
                                                        <strong>{{ __('learning_processes') }}: </strong>
                                                        @foreach ($supportCandidate->user->learningProcesses as $education)
                                                            <div class="timeline-item">
                                                                <div class="timeline-line"></div>
                                                                <div class="timeline-dot"></div>
                                                                <div class="timeline-content ms-4">
                                                                    <div class="text-secondary">
                                                                        {{ __('graduation year') }}:
                                                                        {{ $education->year }}
                                                                    </div>
                                                                    <div class="d-flex flex-column gap-2">
                                                                        <div class="fs-5">
                                                                            {{ $education->school }}
                                                                        </div>
                                                                        <div class="text-secondary">
                                                                            {{ __('degree') }}:
                                                                            {{ __($education->degree) }}
                                                                        </div>
                                                                        <div class="text-secondary">
                                                                            {{ __('specialized') }}:
                                                                            {{ $education->specialized }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                @if ($supportCandidate->user->softSkills->count() > 0)
                                                    <hr>
                                                    <div>
                                                        <strong>{{ __('soft skills') }}: </strong>
                                                        <div class="d-flex gap-4">
                                                            @foreach ($supportCandidate->user->softSkills as $softSkill)
                                                                <div
                                                                    class="d-flex flex-column justify-content-center gap-1">
                                                                    <span class="badge bg-primary">
                                                                        {{ $softSkill->soft_skill }}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($supportCandidate->user->languages->count() > 0)
                                                    <hr>
                                                    <div>
                                                        <strong>{{ __('language proficiency') }}: </strong>
                                                        <div class="d-flex gap-4">
                                                            @foreach ($supportCandidate->user->languages as $language)
                                                                <div
                                                                    class="d-flex flex-column justify-content-center gap-1">
                                                                    <span class="badge bg-primary">
                                                                        {{ __($language->language) }}
                                                                    </span>
                                                                    <span class="badge bg-success">
                                                                        {{ __($language->proficient) }}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($supportCandidate->user->certificates->count() > 0)
                                                    <hr>
                                                    <div>
                                                        <strong>{{ __('certificate') }}: </strong>
                                                        <div class="d-flex gap-4">
                                                            @foreach ($supportCandidate->user->certificates as $certificate)
                                                                <div
                                                                    class="d-flex flex-column justify-content-center gap-1">
                                                                    <a href="{{ asset($certificate->link) }}"
                                                                        class="badge bg-primary" target="_blank">
                                                                        {{ $certificate->certificate }}
                                                                    </a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($supportCandidate->user->hobbies->count() > 0)
                                                    <hr>
                                                    <div>
                                                        <strong>{{ __('hobby') }}: </strong>
                                                        <div class="d-flex gap-4">
                                                            @foreach ($supportCandidate->user->hobbies as $hobby)
                                                                <div
                                                                    class="d-flex flex-column justify-content-center gap-1">
                                                                    <span class="badge bg-primary">
                                                                        {{ $hobby->hobby }}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($supportCandidate->user->desiredLocations->count() > 0)
                                                    <hr>
                                                    <div>
                                                        <strong>{{ __('desired location') }}: </strong>
                                                        <div class="d-flex gap-4">
                                                            @foreach ($supportCandidate->user->desiredLocations as $desiredLocation)
                                                                <div
                                                                    class="d-flex flex-column justify-content-center gap-1">
                                                                    <span class="badge bg-primary">
                                                                        {{ $desiredLocation->desired_location }}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">{{ __('close') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </th>
                            <td>
                                <button class="btn btn-lighter" data-bs-toggle="modal"
                                data-bs-target="#candidate{{ $supportCandidate->id }}Modal">
                                    <strong>{{ $supportCandidate->user->name }}</strong>
                                </button>
                            </td>
                            <td>
                                <strong>{{ $supportCandidate->job->name . ' #' . $supportCandidate->id }}</strong>
                                <div>
                                    <small>
                                        {{ __('applied date') }}
                                        {{ $supportCandidate->created_at->format('d/m/Y') }}
                                    </small>
                                </div>
                            </td>
                            <td><div>{{$supportCandidate->user->email}}</div><div>{{$supportCandidate->user->phone}}</div>
                            </td>
                            <td>
                                {{$supportCandidate->description}}
                            </td>

                            <td>
                                <div class="dropdown mb-3">
                                    <span
                                        class="dropdown-toggle badge 
                                        bg-{{ $supportCandidate->status == 'approved' ? 'success' : ($supportCandidate->status == 'rejected' ? 'danger' : 'warning') }}"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ __($supportCandidate->status) }}
                                    </span>
                                    <ul class="dropdown-menu">
                                        @foreach ($listStatus as $status)
                                            @if ($status != 'all')
                                                <li>
                                                    <form 
                                                        action="{{ route('admin.support_candidates.update', $supportCandidate->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')  
                                                        <input type="hidden" name="status" value="{{ $status }}">
                                                        <button class="dropdown-item" type="submit">
                                                            {{ __($status) }}
                                                        </button>
                                                    </form>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                                <div>
                                    <form action="{{ route('admin.support_candidates.destroy', $supportCandidate->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            {{ __('delete') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                {{ $supportCandidates->appends([
                        'status' => request('status'),
                    ])->links() }}
            </div>
        </div>
    </section>
</main>
@endsection