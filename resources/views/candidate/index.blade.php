@extends('layouts.user.index')

@section('title', request()->getHost() . ': ' . __('find your dream job'))

@section('content')
    <main>
        <section>
            <div class="container-fluid px-0">
                <div style="background-image: url({{ asset('storage/image/bg/bg1.webp') }});">
                    <div class="container py-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <h1 class="mb-4 text-white">{{ __('find your dream job') }}! </h1>
                                <div class="row justify-content-center gap-3">
                                    <div class="col-md-12">
                                        <form class="input-group" action="{{ route('jobs') }}" method="GET">
                                            <span class="input-group-text fw-bold bg-white border-end-0 p-3">
                                                {{ __('keywords') }}:
                                            </span>
                                            <input type="text" aria-label="key_word"
                                                class="form-control border-start-0 p-3" name="key_word"
                                                value="{{ request('key_word') }}"
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
                                            <button class="btn btn-primary" type="submit">
                                                {{ __('search job') }}
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-sm-12">
                                        <ul class="list-group pb-2 pb-sm-3 list-group-horizontal">
                                            <li class="list-group-item location">
                                                <a href="{{ route('jobs', ['location' => 'Hà Nội']) }}"
                                                    class="list-group-item-action">
                                                    <i class="bx bx-map text-danger"></i>
                                                    {{ __('job in') }} Hà Nội
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="{{ route('jobs', ['profession_name' => 'Kinh Doanh']) }}"
                                                    class="list-group-item-action">
                                                    <img height="15" width="15" loading="lazy"
                                                        src="https://media.jobsgo.vn/teks/img/ic-kinh-doanh.svg?v=2342081531021"
                                                        alt="Việc làm Kinh Doanh">
                                                    Kinh Doanh
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="{{ route('jobs', ['profession_name' => 'Kế Toán']) }}"
                                                    class="list-group-item-action">
                                                    <img height="15" width="15" loading="lazy"
                                                        src="https://media.jobsgo.vn/teks/img/ic-ke-toan.svg?v=2342081531021"
                                                        alt="Việc làm Kế Toán">
                                                    Kế Toán
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="{{ route('jobs', ['profession_name' => 'IT Phần Mềm']) }}"
                                                    class="list-group-item-action">
                                                    <img height="15" width="15" loading="lazy"
                                                        src="https://media.jobsgo.vn/teks/img/ic-cong-nghe-thong-tin.svg?v=2342081531021"
                                                        alt="Việc làm Việc làm IT Phần Mềm">
                                                    IT Phần Mềm
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="{{ route('jobs', ['profession_name' => 'Điện/Điện Tử/Điện Lạnh']) }}"
                                                    class="list-group-item-action">
                                                    <img height="15" width="15" loading="lazy"
                                                        src="https://media.jobsgo.vn/teks/img/ic-ky-thuat.svg?v=2342081531021"
                                                        alt="Việc làm Điện/Điện Tử/Điện Lạnh">
                                                    Điện/Điện Tử
                                                </a>
                                            </li>
                                            <li class="list-group-item">
                                                <a href="{{ route('jobs', ['profession_name' => 'Nhân Sự']) }}"
                                                    class="list-group-item-action">
                                                    <img height="15" width="15" loading="lazy"
                                                        src="https://media.jobsgo.vn/teks/img/ic-nhan-su.svg?v=2342081531021"
                                                        alt="Việc làm Nhân Sự">
                                                    Nhân Sự
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-xl-12 d-none d-lg-block">
                                        <div
                                            class="row row-cols-2 text-left row-cols-md-2 row-cols-auto mt-2 gx-4 d-flex justify-content-center text-white">

                                            <div class="col d-flex align-items-center ">
                                                <div class="border border-primary rounded-2 w-100">
                                                    <div class="row g-0 align-items-center p-3">
                                                        <div class="col-4 p-1 text-center">
                                                            <img height="90" width="90" loading="lazy"
                                                                src="https://media.jobsgo.vn/img/ic1.svg?v=2342081531021"
                                                                alt="{{ __('CV Evaluation - AI') }}">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="card-body">
                                                                <h3 class="fs-6 card-title fw-bold text-white">
                                                                    {{ __('CV Evaluation - AI') }}
                                                                </h3>
                                                                <p class="card-text small text-white">
                                                                    {{ __('Already have a CV? Upload it to get AI analysis and suggestions') }}
                                                                </p>
                                                                <a href="#" class="btn btn-primary btn-sm">
                                                                    {{ __('upload CV') }}
                                                                </a>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col d-flex align-items-center">
                                                <div class="border border-primary rounded-2 w-100">
                                                    <div class="row g-0 align-items-center p-3">

                                                        <div class="col-4 p-1 text-center">
                                                            <img height="90" width="90" loading="lazy"
                                                                src="https://media.jobsgo.vn/img/ic2.svg?v=2342081531021"
                                                                alt="{{ __('Create CV automatically in 2 minutes') }}">
                                                        </div>
                                                        <div class="col-8">
                                                            <div class="card-body">
                                                                <h3 class="fs-6 card-title fw-bold">
                                                                    {{ __('Create CV automatically in 2 minutes') }}
                                                                </h3>
                                                                <p class="card-text small">
                                                                    {{ __('Create a standard, beautiful online CV for free with') . ' ' . config('app.name') }}
                                                                </p>
                                                                <a href="#" class="btn btn-primary btn-sm">
                                                                    {{ __('Create CV in 2 minutes') }}
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <a target="_blank"
                                    data-banner-id="batdongsancomvn-utmsource-jobsgo-utmmedium-banner-home-utmcampaign-banner-home"
                                    data-banner-position="home_top"
                                    class="d-block banner-batdongsancomvn-utmsource-jobsgo-utmmedium-banner-home-utmcampaign-banner-home banner-position-home_top"
                                    rel="sponsored"
                                    href="https://batdongsan.com.vn/?utm_source=jobsgo&amp;utm_medium=banner-home&amp;utm_campaign=banner-home">
                                    <img class="d-none d-lg-block" style="border-radius:4px"
                                        src="https://jobsgo.vn/uploads/banner/202410/banner_bds_390_350.png"
                                        width="100%" loading="lazy" alt="jobsgo">
                                    <img class="d-block d-lg-none"
                                        src="https://jobsgo.vn/uploads/banner/202410/banner_bds_390_150.png"
                                        width="100%" loading="lazy" alt="jobsgo">
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="gd-blue-green py-4">
            <div class="container">
                <div>
                    <div class="d-flex justify-content-between">
                        <h2 class="h3">
                            {{ __('new recruitment') }}
                        </h2>
                        <a class="btn btn-primary" href="{{ route('jobs') }}">
                            {{ __('see more') }}
                            <i class="bi bi-caret-right-fill"></i>
                        </a>
                    </div>
                    <br>
                    <!-- limit 12 -->
                    @php
                        // Lấy danh sách công việc, tối đa 45 công việc (15 x 3 items)
                        $jobs = \App\Models\Job::whereNotNull('admin_id')
                            ->where('is_stop',  false)
                            ->where('expired', '>=', now())
                            ->orderByDesc('updated_at')
                            ->orderByDesc('sort_date')
                            ->limit(36)
                            ->get();

                        // Chia công việc thành nhóm, mỗi nhóm 15 công việc
                        $jobGroups = $jobs->chunk(12);
                    @endphp
                    <div>
                        <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                @foreach ($jobGroups as $index => $group)
                                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                        <div class="row row-cols-2 row-cols-xl-3 g-2 g-lg-3">
                                            @foreach ($group as $job)
                                                <div class="col">
                                                    <a href="{{ route('job', $job->id) }}"
                                                        class="bg-white p-3 rounded-2 d-flex gap-3">
                                                        <div>
                                                            <img src="{{ asset($job->employer->image) }}"
                                                                alt="{{ $job->employer->name }}"
                                                                style="height: 100px; width: 100px;">
                                                        </div>
                                                        <div>
                                                            <div class="text-danger card-content" style="height: 48px">
                                                                <strong>
                                                                    {{ $job->is_hot ? '🔥' : '' }} {{ $job->name }} 
                                                                </strong>
                                                            </div>
                                                            <div class="text-secondary card-content"
                                                                style="font-size: 12px; height: 36px;">
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
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel"
                                data-bs-slide="prev">
                                <span class="text-dark" aria-hidden="true">
                                    <i class="bi bi-arrow-left-circle-fill" style="font-size: 30px;"></i>
                                </span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel"
                                data-bs-slide="next">
                                <span class="text-dark" aria-hidden="true">
                                    <i class="bi bi-arrow-right-circle-fill" style="font-size: 30px;"></i>
                                </span>
                                <span class="visually-hidden">Next</span>
                            </button>

                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                @foreach ($jobGroups as $index => $group)
                                    <button type="button" data-bs-target="#bannerCarousel"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $index === 0 ? 'active' : '' }}"></button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="container">
                <div class="d-flex justify-content-between">
                    <h2 class="h3">{{ __('featured employer') }}</h2>
                    <a class="btn btn-primary" href="">
                        {{ __('see more') }}
                        <i class="bi bi-caret-right-fill"></i>
                    </a>
                </div>
                <br>
                <!-- limit 6 -->
                @php
                    $employers = \App\Models\Employer::limit(30)->get();

                    $employerGroups = $employers->chunk(6);
                @endphp
                <div>
                    <div id="employerCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            @foreach ($employerGroups as $index => $group)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <div class="row row-cols-3 row-cols-xl-6 g-2 g-lg-3">
                                        @foreach ($group as $employer)
                                            <div class="col">
                                                <a href="{{ route('employer', $employer->id) }}"
                                                    class="bg-white p-3 rounded-2 d-flex flex-column align-items-center">
                                                    <div>
                                                        <img src="{{ asset($employer->image) }}"
                                                            alt="{{ asset($employer->name) }}"
                                                            style="height: 100px; width: 100px;">
                                                    </div>

                                                    <div class="card-content" style="font-size: 15px; height: 48px;">
                                                        <strong>
                                                            {{ $employer->name }}
                                                        </strong>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Controls (optional) -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#employerCarousel"
                            data-bs-slide="prev">
                            <span class="text-dark" aria-hidden="true">
                                <i class="bi bi-arrow-left-circle-fill" style="font-size: 30px;"></i>
                            </span>
                            <span class="visually-hidden text-dark">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#employerCarousel"
                            data-bs-slide="next">
                            <span class="text-dark" aria-hidden="true">
                                <i class="bi bi-arrow-right-circle-fill" style="font-size: 30px;"></i>
                            </span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

            </div>
        </section>

        <section class="py-4">
            <div class="container">
                <div>
                    <div class="d-flex justify-content-between">
                        <h2 class="h3">
                            {{ __('featured job') }}
                        </h2>
                        <a class="btn btn-primary" href="{{ route('jobs', ['demand' => 'urgent']) }}">
                            {{ __('see more') }}
                            <i class="bi bi-caret-right-fill"></i>
                        </a>
                    </div>
                    <br>
                    <!-- limit 6 -->
                    <div>
                        @php
                            $jobs = \App\Models\Job::whereNotNull('admin_id')
                            ->where('is_stop',  false)
                            ->where('expired', '>=', now())
                            ->withCount('views')
                            ->orderByDesc('views_count')
                            ->limit(6)
                            ->get();
                        @endphp
                        <div class="row row-cols-2 row-cols-xl-3 g-2">
                            @foreach ($jobs as $job)
                                <div class="col">
                                    <a href="{{ route('job', $job->id) }}"
                                        class="bg-white p-3 rounded-2 d-flex gap-3 border">
                                        <div>
                                            <img src="{{ asset($job->employer->image) }}"
                                                alt="{{ $job->employer->name }}" style="height: 100px; width: 100px;">
                                        </div>
                                        <div>
                                            <div class="text-danger card-content" style="height: 48px">
                                                <strong>
                                                    {{ $job->name }}
                                                </strong>
                                            </div>
                                            <div class="text-secondary card-content" style="font-size: 12px;height: 36px;">
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
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="gd-blue-green py-4">
            <div class="container">
                <div>
                    <div class="d-flex justify-content-between">
                        <h2 class="h3">
                            {{ __('featured profession') }}
                        </h2>
                        <a class="btn btn-primary" href="{{ route('jobs') }}">
                            {{ __('see more') }}
                            <i class="bi bi-caret-right-fill"></i>
                        </a>
                    </div>
                    <br>
                    <!-- limit 12 -->
                    @php
                            //  whereNotNull('admin_id')
                            // ->where('is_stop',  false)
                            // ->where('expired', '>=', now())
                        $professions = \App\Models\Profession::withCount('jobs')
                            ->orderBy('jobs_count', 'desc')
                            ->limit(12)
                            ->get();
                    @endphp
                    <div>
                        <div class="row row-cols-3 row-cols-xl-4 g-2 g-lg-3">
                            @foreach ($professions as $profession)
                                <div class="col">
                                    <a href="{{ route('jobs', ['profession' => $profession->id]) }}"
                                        class="bg-white p-3 rounded-2 d-flex gap-3 overflow-hidden">

                                        {{-- <div>
                                            <img src="{{ asset($profession->image) }}" alt="{{ $profession->name }}"
                                                style="height: 50px; width: 50px;">
                                        </div> --}}
                                        <div>
                                            <div class="text-truncate ">
                                                <strong>
                                                    {{ $profession->name }}
                                                </strong>
                                            </div>
                                            <div class="text-primary" style="font-size: 12px;">
                                                {{ $profession->jobs?->count() ?? 0 }} {{ __('job') }} >>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-4">
            <div class="container-fluid px-0" style="background-image: url('{{ asset('storage/image/bg/bg3.webp') }}');">
                <div class="container">
                    <div class="teks-section py-4 py-sm-5">
                        <div class="row align-items-center row-cols-lg-3">
                            <div class="col-lg-3 teks-section-title ps-3 text-center text-lg-start">
                                <h2 class="text-white fs-5">
                                    {{ __('salary lookup') }}
                                    <small class="badge bg-danger p-1 font-size-sm">{{ __('new') }}</small>
                                </h2>
                                <p class="w-100 mb-3 text-white">
                                    {{ __('lookup utility') }}
                                    &amp;
                                    {{ __('find out salary') }}
                                    <br>
                                    {{ __('by industry and job position') }}
                                    {{ now()->year }}
                                </p>
                                <img class="w-100 w-xs-25 mb-3 m-auto p-lg-4 d-block" loading="lazy"
                                    src="{{ asset('storage/image/temp/tra-cuu-luong.svg') }}"
                                    alt="{{ __('find out salary') }}">
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-6 gx-sm-5 mb-4 mb-sm-0 teks-section-content">
                                        <div class="shadow bg-white p-3 p-sm-4 rounded-2 h-100 d-block">
                                            <p class="small text-dark">
                                                {{ __("For example: If you want to look up the salary of a tax accountant position in the accounting industry, enter the desired job as 'tax accountant', select the location Hanoi and start looking up the salary.") }}
                                            </p>
                                            <div class="mb-3 job-role">
                                                <select class="form-select select2 select2-hidden-accessible"
                                                    id="role" tabindex="-1" aria-hidden="true"
                                                    data-select2-id="select2-data-role">
                                                    <option value="" data-select2-id="select2-data-1012-cj8g">
                                                        {{ __('choose profession') }}
                                                    </option>
                                                    <option value="thuc-tap-sinh-dao-tao">
                                                        {{ __('internship training') }}
                                                    </option>
                                                    <option value="chuyen-vien-dao-tao">
                                                        {{ __('training specialist') }}
                                                    </option>
                                                    <option value="giam-doc-dao-tao">
                                                        {{ __('training director') }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <select class="form-select select2 select2-hidden-accessible"
                                                    id="place" data-select2-id="select2-data-place" tabindex="-1"
                                                    aria-hidden="true">
                                                    <option value="" data-select2-id="select2-data-3-ue1u">
                                                        {{ __('choose location') }}
                                                    </option>
                                                    <option value="ha-noi">Hà Nội</option>
                                                    <option value="ho-chi-minh">Hồ Chí Minh</option>
                                                    <option value="da-nang">Đà Nẵng</option>
                                                    <option value="bac-ninh">Bắc Ninh</option>
                                                    <option value="hai-phong">Hải Phòng</option>
                                                    <option value="binh-duong">Bình Dương</option>
                                                    <option value="dong-nai">Đồng Nai</option>
                                                </select>
                                            </div>

                                            <button class="btn btn-primary teks-btn-g d-block m-auto" type="button"
                                                id="research">
                                                <span class="fw-bold">
                                                    {{ __('check salary now!') }}
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-lg-block teks-section-content">
                                        <div class="shadow bg-white p-3 p-sm-4 rounded-4 h-100 d-block">
                                            <div class="mb-3 fs-6 fw-bold  text-dark">
                                                {{ __('common position salary') }}
                                            </div>
                                            <ul class="list-group list-group-flush">

                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <a title="Mức lương Nhân Viên Tư Vấn"
                                                        href="/muc-luong-nhan-vien-tu-van.html">
                                                        <div class="txt text-body">Nhân Viên Tư Vấn</div>
                                                    </a>
                                                    <span class="text-primary">7 - 13 {{ __('million VND') }}</span>
                                                </li>

                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <a title="Mức lương Trưởng Phòng Kinh Doanh"
                                                        href="/muc-luong-truong-phong-kinh-doanh.html">
                                                        <div class="txt text-body">Trưởng Phòng Kinh Doanh</div>
                                                    </a>
                                                    <span class="text-primary">12 - 28 {{ __('million VND') }}</span>
                                                </li>

                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <a title="Mức lương Nhân Viên Bán Hàng"
                                                        href="/muc-luong-nhan-vien-ban-hang.html">
                                                        <div class="txt text-body">Nhân Viên Bán Hàng</div>
                                                    </a>
                                                    <span class="text-primary">5 - 8 {{ __('million VND') }}</span>
                                                </li>

                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <a title="Mức lương Giám Sát Bán Hàng"
                                                        href="/muc-luong-giam-sat-ban-hang.html">
                                                        <div class="txt text-body">Giám Sát Bán Hàng</div>
                                                    </a>
                                                    <span class="text-primary">9 - 17 {{ __('million VND') }}</span>
                                                </li>

                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <a title="Mức lương Digital Marketing"
                                                        href="/muc-luong-digital-marketing.html">
                                                        <div class="txt text-body">Digital Marketing</div>
                                                    </a>
                                                    <span class="text-primary">8 - 17 {{ __('million VND') }}</span>
                                                </li>

                                            </ul>
                                        </div>
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
