@extends('layouts.employer.index')

@section('title', request()->getHost() . ': ' . __('edit job'))

@section('breadcrumb-item')
    <li class="breadcrumb-item">
        <a href="{{ route('employer.jobs.index') }}">{{ __('jobs') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('edit Job') }}
    </li>
@endsection

@section('content')
    <main>
        <section>
            <div class="container-fluid">
                <form action="{{ route('employer.jobs.update',$job->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <ul class="nav nav-tabs w-100 d-flex" id="myTab" role="tablist">
                        <li class="nav-item col-4 text-center" role="presentation">
                            <button class="nav-link active w-100" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                {{ __('basic information') }}
                            </button>
                        </li>
                        <li class="nav-item col-4 text-center" role="presentation">
                            <button class="nav-link w-100" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                {{ __('job information') }}
                            </button>
                        </li>
                        <li class="nav-item col-4 text-center" role="presentation">
                            <button class="nav-link w-100" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                                {{ __('publish') }}
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <div class="container mt-3">
                                <div class="mb-3">
                                    <label for="name" class="form-label text-success">{{ __('job title') }} <red>*</red></label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ $job->name }}"
                                    >
                                </div>
    
                                <div class="mb-3">
                                    <label for="description" class="form-label text-success">{{ __('description') }} <red>*</red></label>
                                    <textarea class="form-control"id="description" name="description" rows="4" required>{{ $job->description }}</textarea>
                                </div>
    
                                <div class="mb-3">
                                    <label for="requirement" class="form-label text-success">{{ __('requirement') }} <red>*</red></label>
                                    <textarea class="form-control" id="requirement" name="requirement" rows="4" required>{{ $job->requirement }}</textarea>
                                </div>
    
                                <div class="mb-3">
                                    <label for="benefits" class="form-label text-success">{{ __('benefits') }} <red>*</red></label>
                                    <textarea class="form-control" id="benefits" name="benefits" rows="4" required>{{ $job->benefits }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="sendEmail" class="form-label  text-success">
                                        {{__('email notification')}}
                                    </label>
                                    
                                    <input type="text" id="sendEmail" name="sendEmail" placeholder="m@gmail.com" class="form-control" 
                                    value="@foreach ($job->sendEmails as $sendEmail ){{$sendEmail->email}} @endforeach">
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between m-4">
                                    <div></div>
                                    <button class="btn btn-primary btn-next" type="button" onclick="document.getElementById('profile-tab').click()">
                                        {{__('next')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <div class="container mt-3">
                                <div class="row row-cols-2 g-2 g-lg-3">
                                    <div class="col">
                                        <label for="address" class="form-label text-success">{{ __('address') }} <red>*</red></label>
                                        <input type="text" class="form-control" id="address" name="address" required
                                            value="{{ $job->address }}"
                                        >
                                    </div>
        
                                    <div class="col">
                                        <label for="location" class="form-label text-success">{{ __('location') }} <red>*</red></label>
                                        <select name="location" id="location" class="form-control" required>
                                            @foreach (\App\Models\LocationSelect::all() as $p)
                                                <option value="{{ $p->location }}" @selected($job->location == $p->location)>{{ $p->location }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row row-cols-1 row-cols-md-2 g-2 g-md-3">
                                    <div class="col">
                                        <label for="position" class="form-label text-success">
                                            {{ __('position') }} <red>*</red>
                                        </label>
                                        
                                        <input type="text" id="position" name="position"  class="form-control" value="{{ $job->position }}" required>
    
                                    </div>
        
                                    <div class="col">
                                        <label for="degree" class="form-label text-success"> {{ __('degree') }} ({{ __('minimum') }}) <red>*</red></label>
                                        <select class="form-control" id="degree" name="degree" required>
                                            <option value="no need" {{ $job->degree == 'no need' ? 'selected' : '' }}>{{__('no need')}}</option>
                                            <option value="high school" {{ $job->degree == 'high school' ? 'selected' : '' }}>{{__('high school')}}</option>
                                            <option value="college" {{ $job->degree == 'college' ? 'selected' : '' }}>{{__('college')}}</option>
                                            <option value="university" {{ $job->degree == 'university' ? 'selected' : '' }}>{{__('university')}}</option>
                                            <option value="graduate" {{ $job->degree == 'graduate' ? 'selected' : '' }}>{{__('graduate')}}</option>
                                        </select>
                                    </div>
        
                                    <div class="col">
                                        <label for="experience" class="form-label text-success">{{ __('experience requirement') }} <red>*</red></label>
                                        <select name="experience" id="experience" class="form-control" required>
                                            <option value="0">{{ __('no experience required') }}</option>
                                            @for ($p = 1; $p <= 5; $p++)
                                                <option value="{{ $p }}" @selected( $job->experience == $p)>
                                                    {{ $p }} {{ __('years') }}
                                                </option>
                                            @endfor
                                            <option value="6" @selected( $job->experience == 6)>
                                                {{ __('over 5 years') }}
                                            </option>
                                        </select>
                                    </div>
                                      
                                    <div class="col">
                                        <label for="demand" class="form-label text-success">{{ __('demand') }} <red>*</red></label>
                                        <select name="demand" id='demand' class="form-control">
                                            @php
                                                $demand = ['fulltime', 'parttime', 'intern', 'by project'];
                                            @endphp
                                            @foreach ($demand as $d)
                                                <option value="{{ $d }}" @selected( $job->demand == $d)>{{ __($d) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="expired" class="form-label text-success">{{ __('expired date') }} <red>*</red></label>
                                        <input type="date" class="form-control" name="expired" id="expired" required
                                            value="{{ $job->expired }}"
                                        >
                                    </div>
                                    <div class="col">
                                        <label for="expired" class="form-label text-success">{{ __('quantity recruitment') }} <red>*</red></label>
                                        <input type="number" class="form-control" name="quantity" id="quantity" required
                                            value="{{ $job->quantity }}"
                                        >
                                    </div>
                                </div>
                                <hr>
                                <div class="row row-cols-1 row-cols-md-2 g-2 g-md-3">
                                    <div class="col">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" id="agreement" name="agreement"
                                            @checked(old('agreement',$job->min_salary == null && $job->max_salary == null))
                                            onchange="
                                                document.getElementById('min_salary').disabled = this.checked;
                                                document.getElementById('max_salary').disabled = this.checked;
                                                ">
                                            <label class="form-check-label" for="agreement">{{__('agreement')}}</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label for="type_salary" class="form-label text-success">{{ __('type salary') }} <red>*</red></label>
                                        <select name="type_salary" id='type_salary' class="form-control">
                                            <option value="million VND" @selected($job->type_salary == "million VND" )>{{ __('million VND') }}</option>
                                            <option value="USD" @selected($job->type_salary == "USD" )>{{ __('USD') }}</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="min_salary" class="form-label text-success">{{ __('min salary') }}</label>
                                        <input type="text" class="form-control" id="min_salary" name="min_salary"
                                            value="{{ $job->min_salary }}" @disabled(old('agreement',$job->min_salary == null && $job->max_salary == null))
                                        >
                                    </div>
                                    <div class="col">
                                        <label for="max_salary" class="form-label text-success">{{ __('max salary') }}</label>
                                        <input type="text" class="form-control" id="max_salary" name="max_salary"
                                            value="{{ $job->max_salary }}" @disabled(old('agreement',$job->min_salary == null && $job->max_salary == null))
                                        >
                                    </div>
                                </div>
                                <br>
                                <div class="mb-3">
                                    <label for="job_skill" class="form-label  text-success">
                                        {{ __('skill') }} <red>*</red>
                                    </label>
                                    
                                    <input type="text" id="job_skill" name="job_skill" placeholder="{{__('skill')}}" required class="form-control" 
                                    value="{{ $job->skills?->pluck('name')->implode(',') }}">

                                </div> 
                                <div class="mb-3">
                                    <label for="job_profession" class="form-label  text-success">
                                        {{ __('specialized') }} <red>*</red>
                                    </label>
                                    
                                    
                                    <select id="job_profession" name="job_profession[]" multiple required>
                                        @php
                                            $selected_ids = $job->professions?->pluck('profession_id');
                                        @endphp
                                        @foreach (\App\Models\Profession::all() as $p)
                                            <option value="{{ $p->id }}" @selected($selected_ids->contains($p->id))>
                                                {{ $p->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between m-4">
                                    <button type="button" class="btn btn-secondary btn-back" onclick="document.getElementById('home-tab').click()">
                                        {{__('back')}}
                                    </button>
                                    
                                    <button type="button" class="btn btn-primary btn-next" onclick="document.getElementById('contact-tab').click()">
                                        {{__('next')}}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
                            <div class="my-3">
                                <label for="required" class="form-label text-uppercase fw-bold text-warning">
                                    <i class="fa fa-briefcase text-success">
                                    </i> {{__('mandatory')}} <span class="text-danger">*</span>
                                </label>
                                
                                <select id="required" name="required[]" multiple required>
                                    @php
                                        $requireds =  old('requireds') ? collect(old('requireds')): $job->requireds()->pluck('name');
                                    @endphp
                                    <option @selected($requireds->contains('date_of_birth')) value="date_of_birth">{{__('date of birth')}}</option>
                                    <option @selected($requireds->contains('introduce')) value="introduce">{{__('introduce')}}</option>
                                    <option @selected($requireds->contains('phone')) value="phone">{{__('phone')}}</option>
                                    <option @selected($requireds->contains('location')) value="location">{{__('location')}}</option>
                                    <option @selected($requireds->contains('degree')) value="degree">{{__('degree')}}</option>
                                    <option @selected($requireds->contains('workExperiences')) value="workExperiences">{{__('work experiences')}}</option>
                                    <option @selected($requireds->contains('workExperiences')) value="learningProcesses">{{__('learning processes')}}</option>
                                    <option @selected($requireds->contains('professionalSkills')) value="professionalSkills">{{__('professional skills')}}</option>
                                </select>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between  m-4">
                                <button type="button" class="btn btn-secondary btn-back" onclick="document.getElementById('profile-tab').click()">
                                    {{__('back')}}
                                </button> 
                                <button type="submit" class="btn btn-success">
                                    {{ __('publish') }}    
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var sendEmail = document.querySelector('#sendEmail');
            new Tagify(sendEmail, {
                delimiters: " ",
                whitelist: [],
                dropdown: {
                enabled: 1 // 0 = luôn hiện danh sách gợi ý
                }
            });

            var job_skill = document.querySelector('#job_skill');
            new Tagify(job_skill, {
                delimiters: ",",
                whitelist: [],
                dropdown: {
                enabled: 1
                }
            });

            const job_profession = document.querySelector('#job_profession');
            new Choices(job_profession, {
            removeItemButton: true,  // hiện nút xóa từng tag
            placeholder: true,
            placeholderValue: '',
            searchEnabled: true,     // có thể gõ tìm
            });

            var position = document.querySelector('#position');

            new Tagify(position, {
            // enforceWhitelist: true,
            delimiters: ",",
            whitelist: ["{{__('internship')}}", "{{__('employee')}}", "{{__('manager')}}"],
            maxTags: 1,           // chỉ cho 1 giá trị
            dropdown: {
                enabled: 0,         // luôn bật dropdown gợi ý
                closeOnSelect: true
            },
            editTags: false,      // không cho chỉnh sửa tag
            });

            const required = document.querySelector('#required');
            new Choices(required, {
            removeItemButton: true,  // hiện nút xóa từng tag
            placeholder: true,
            placeholderValue: '',
            searchEnabled: true,     // có thể gõ tìm
            });
        });
                function formatNumber(input) {
            let value = input.value.replace(/\./g, '').replace(/,/g, '.'); // chuẩn hóa
            if (!isNaN(value) && value !== "") {
                let parts = value.split('.');
                parts[0] = parseInt(parts[0], 10).toLocaleString('de-DE'); // format 1.000.000
                input.value = parts.join(',');
            }
        }
        document.querySelectorAll('#min_salary, #max_salary').forEach(el => {
            el.addEventListener('input', () => formatNumber(el));
        });

        document.querySelector('form').addEventListener('submit', function () {
            document.querySelectorAll('#min_salary, #max_salary').forEach(el => {
                if (el.value) {
                    // "1.000.000,3" → "1000000.3"
                    el.value = el.value.replace(/\./g, '').replace(/,/g, '.');
                }
            });
        });
    </script>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
@endsection
