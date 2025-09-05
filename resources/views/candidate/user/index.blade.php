@extends('layouts.user.index')

@section('title', request()->getHost() . ': Tìm việc mong ước')

@php
    $auth = auth()->guard('user')->user();
@endphp

@section('content')
    <main>
        <section>
            <div class="container-fluid p-0">
                <div class="container">
                    <div>
                        <div class="px-3" style="background-color: rgba(173, 216, 230, 0.5);">
                            {{ config('app.name') }} / {{ __('manage profile') }}
                        </div>
                        <div class="px-3 py-2 bg-white fw-bold border-bottom border-primary ">
                            <i class="bi bi-person-circle"></i>
                            {{ __('manage profile') }}
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-8 p-4 d-flex flex-column gap-4">
                            <div class="border border-primary rounded-3 bg-white p-4 ">
                                <div class="d-flex gap-4 px-3">
                                    <div class="text-center w-50">
                                        <div><img src="{{ asset($auth->image) }}" alt="{{ $auth->name }}" height="100"
                                                class="rounded-3"></div>
                                        {{-- <br>
                                        <div>Mức độ hoàn thiện hồ sơ:</div>
                                        <div>
                                            <strong>
                                                85%
                                            </strong>
                                        </div>
                                        <br>
                                        <div style="background-color: lightgray;">
                                            <div style="height:24px;width:85%;background-color: yellowgreen;"></div>
                                        </div> --}}
                                    </div>
                                    <div class="w-100">
                                        <div class="d-flex justify-content-between w-100">
                                            <h3>{{ $auth->name }}</h3>
                                            <div>
                                                <a class="btn btn-primary"
                                                    href="{{ route('candidate.user.edit', ['user' => $auth->id]) }}">
                                                    <i class="bi bi-pencil-square fw-bold"></i>
                                                    {{ __('update profile') }}
                                                </a>
                                            </div>
                                        </div>
                                        <br>
                                        <div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">
                                                    {{ __('date of birth') }}:
                                                </strong>
                                                <div>{{ $auth->date_of_birth ?? __('not updated yet') }}</div>
                                            </div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">
                                                    {{ __('sex') }}:
                                                </strong>
                                                <div>{{ $auth->sex ?? __('not updated yet') }}</div>
                                            </div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">
                                                    {{ __('desired location') }}:
                                                </strong>
                                                <div>{{ $auth->desired_location ?? __('not updated yet') }}</div>
                                            </div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">
                                                    {{ __('position') }}:
                                                </strong>
                                                <div>{{ $auth->position ?? __('not updated yet') }}</div>
                                            </div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">
                                                    {{ __('status looking for a job') }}:
                                                </strong>

                                                @if ($auth->job_search_status)
                                                    <div class="text-success">
                                                        {{ __('looking for a job') }}
                                                    </div>
                                                @else
                                                    <div class="text-danger">
                                                        {{ __('looking for a job is off') }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex">
                                                <strong style="width: 200px;">
                                                    {{ __('updated date') }}:
                                                </strong>
                                                <div>{{ $auth->updated_at }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border border-primary rounded-3 bg-white p-4 ">
                                <div><strong class="text-uppercase">
                                        {{ __('dashboard') }}
                                    </strong></div>
                                <br>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex gap-3">
                                        <div class="text-center rounded-circle"
                                            style="align-content: center; min-width: 50px; height: 50px; background-color: rgba(127, 255, 212, 0.6);">
                                            <i class="bi bi-eye text-primary"></i>
                                        </div>
                                        <div>
                                            <div>{{ __('view') }}</div>
                                            <h4>0</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <div class="text-center rounded-circle"
                                            style="align-content: center; min-width: 50px; height: 50px; background-color: rgba(127, 255, 212, 0.6);">
                                            <i class="bi bi-chat text-primary"></i>
                                        </div>
                                        <div>
                                            <div>{{ __('message') }}</div>
                                            <h4>0</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <div class="text-center rounded-circle"
                                            style="align-content: center; min-width: 50px; height: 50px; background-color: rgba(127, 255, 212, 0.6);">
                                            <i class="bi bi-bookmark text-primary"></i>
                                        </div>
                                        <div>
                                            <div>{{ __('applied jobs') }}</div>
                                            <h4>{{ \App\Models\Applied::where('user_id', $auth->id)->count() }}</h4>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <div class="text-center rounded-circle"
                                            style="align-content: center; min-width: 50px; height: 50px; background-color: rgba(127, 255, 212, 0.6);">
                                            <i class="bi bi-heart text-primary"></i>
                                        </div>
                                        <div>
                                            <div>{{ __('saved jobs') }}</div>
                                            <h4>{{ \App\Models\Saved::where('user_id', $auth->id)->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <br>
                            <div class="border border-primary rounded-3 bg-white p-4 ">
                                <div><strong>DANH SÁCH CV ĐÃ TẠO</strong></div>
                                <br>
                                <div class="row row-cols-2">
                                    <div class="col">
                                        <div class="p-1">
                                            <div class="p-4 border border-primary rounded-3 bg-white d-flex gap-2">
                                                <div><img src="../storage/app/public/image/temp/cv-default.png"
                                                        alt="" height="100">
                                                </div>
                                                <div class="d-flex flex-column justify-content-between">
                                                    <div class="text-truncate"><strong>CV mặc định</strong></div>
                                                    <div class="text-truncate">Mẫu CV Tiêu Chuẩn 1 - vi-VN</div>
                                                    <div class="d-flex gap-3">
                                                        <div class="btn btn-light border border-primary">
                                                            <i class="bi bi-pencil-square"></i>
                                                            Chỉnh sửa
                                                        </div>
                                                        <div class="btn btn-light border border-primary">
                                                            <i class="bi bi-download"></i>
                                                        </div>
                                                        <div class="btn btn-light border border-primary">
                                                            <i class="bi bi-trash"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br> --}}
                            <div class="border border-primary rounded-3 bg-white p-4 ">
                                <div><strong>DANH SÁCH CV ĐÃ TẢI LÊN</strong></div>
                                <br>
                                <h5 class="text-warning">
                                    <i class="bi bi-file-earmark-arrow-up"></i>
                                    TÀI LIỆU CHỨNG CHỈ ĐÃ TẢI LÊN
                                </h5>
                                <br>
                                <div class="row row-cols-3">
                                    @foreach ($auth->attachments as $p)
                                        <div class="col">
                                            <div class="p-1">
                                                <div class="p-4 border border-primary rounded-3 bg-white">
                                                    <div class="overflow-auto" style="height: 100px;">
                                                        <img src="{{ asset('storage/image/temp/cv-default.png') }}"
                                                            alt="{{ $p->attachment }}" class="w-100">
                                                    </div>
                                                    <br>
                                                    <div class="text-success text-truncate">{{ $p->attachment }}</div>
                                                    <br>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ asset($p->link) }}"
                                                            class="btn btn-light border border-primary">
                                                            <i class="bi bi-download"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('candidate.user.destroy', ['user' => $auth->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="attachment"
                                                                value="{{ $p->id }}">
                                                            <button type="submit"
                                                                class="btn btn-light border border-primary">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 p-4">
                            <div class="border border-primary rounded-3 bg-white p-4">
                                <div class="px-1">
                                    <div>VIỆC LÀM PHÙ HỢP VỚI BẠN</div>
                                    <br>
                                    @php
                                        $user = App\Models\User::find($auth->id);
                                        $suitableJobs = App\Models\Job::whereHas('professions.profession', function (
                                            $query,
                                        ) use ($user) {
                                            foreach (
                                                $user->professionalSkills->pluck('professional_skill')
                                                as $professional_skill
                                            ) {
                                                $query->orWhere('name', 'like', '%' . $professional_skill . '%');
                                            }
                                        })
                                            ->orWhere('name', 'like', '%' . $user->desired_location . '%')
                                            ->limit(5)
                                            ->get();
                                    @endphp
                                    <div class="d-flex flex-column gap-1">
                                        @foreach ($suitableJobs as $job)
                                            <a href="{{ route('job', $job->id) }}"
                                                class="bg-white p-3 rounded-2 d-flex gap-3 border">
                                                <div>
                                                    <img src="{{ asset($job->employer->image) }}"
                                                        alt="{{ $job->name }}" style="height: 100px; width: 100px;">
                                                </div>
                                                <div>
                                                    <div class="text-danger card-content">
                                                        <strong>
                                                            {{ $job->name }}
                                                        </strong>
                                                    </div>
                                                    <div class="text-secondary card-content" style="font-size: 12px;">
                                                        {{ $job->employer->name }}
                                                    </div>
                                                    <div class="d-flex flex-wrap gap-3" style="font-size: 12px;">
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
            </div>
        </section>
    </main>
@endsection
