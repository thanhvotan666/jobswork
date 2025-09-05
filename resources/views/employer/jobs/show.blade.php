@extends('layouts.employer.index')

@section('title', $job->name)

@section('breadcrumb-item')
    <li class="breadcrumb-item">
        <a href="{{ route('employer.jobs.index') }}">{{ __('job list') }}</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">
        {{ $job->name }} #{{ $job->id }}
    </li>
@endsection


@section('content')
<script>
    function showContactModal(id = null) {
        var myModal = new bootstrap.Modal(document.getElementById('showContactModal'), {
            keyboard: false
        });
        document.getElementById('contactModal').value = id;
        myModal.show();
    }
    function showContactViewModal(id = null) {
        var myModal = new bootstrap.Modal(document.getElementById('showContactViewModal'), {
            keyboard: false
        });
        document.getElementById('contactViewModal').value = id;
        myModal.show();
    }
    function showContact(id) {
        const url =
            `{{ route('employer.show_contact') }}`; // Nếu dùng `route()` trên Laravel phía server thì URL sẽ trông như vậy.
        // Dữ liệu bạn muốn gửi lên server
        const data = {
            id: id
        };
        // Gửi request lên server
        fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content') // CSRF token
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok " + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    document.getElementById('showEmail' + id).innerHTML = data.email;
                    document.getElementById('showEmail' + id).href = `mailto:${data.email}`;
                    
                    document.getElementById('showPhone' + id).innerHTML = data.phone;
                    document.getElementById('showPhone' + id).href = `tel:${data.phone}`;
                    try {
                        document.getElementById('showAttachment' + id).innerHTML = "{{ __('download') }}" +
                            "{{ __('attachment') }}";
                        document.getElementById('showAttachment' + id).href = "{{ request()->getHost() }}/" + data
                            .attachment;
                    } catch (error) {

                    }
                }
            })
            .catch(error => {
                console.error("Error:", error); // Xử lý lỗi
            });
    }
    function showContactView(id) {
        const url =
            `{{ route('employer.show_contact_view') }}`; // Nếu dùng `route()` trên Laravel phía server thì URL sẽ trông như vậy.
        // Dữ liệu bạn muốn gửi lên server
        const data = {
            id: id
        };
        // Gửi request lên server
        fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok " + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const eleEmail = document.getElementById('showEmailView' + id);
                    eleEmail.innerHTML = data.email;
                    eleEmail.href = `mailto:${data.email}`;

                    const elePhone = document.getElementById('showPhoneView' + id);
                    elePhone.innerHTML = data.phone;
                    elePhone.href = `tel:${data.phone}`;
                }
            })
            .catch(error => {
                console.error("Error:", error); // Xử lý lỗi
            });
    }

    function showContactPoint(id) {
        const url =
            `{{ route('employer.show_contact_point') }}`;
        const data = {
            id: id
        };
        // Gửi request lên server
        fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content') // CSRF token
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok " + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                console.log(document.getElementById('showEmail' + id));
                if (data.success) {

                    document.getElementById('showEmail' + id).innerHTML = data.email;
                    document.getElementById('showEmail' + id).href = `mailto:${data.email}`;

                    document.getElementById('showPhone' + id).innerHTML = data.phone;
                    document.getElementById('showPhone' + id).href = `tel:${data.phone}`;

                    document.getElementById('work-point').innerHTML = data.point;

                }else{
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error); // Xử lý lỗi
            });
    }
    function showContactViewPoint(id) {
        console.log(id);
        const url =
            `{{ route('employer.show_contact_view_point') }}`;
        const data = {
            id: id
        };
        // Gửi request lên server
        fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content') // CSRF token
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok " + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log(data);
                console.log(document.getElementById('showEmailView' + id));
                if (data.success) {
                    document.getElementById('showEmailView' + id).innerHTML = data.email;
                    document.getElementById('showEmailView' + id).href = `mailto:${data.email}`;
                    
                    document.getElementById('showPhoneView' + id).innerHTML = data.phone;
                    document.getElementById('showPhoneView' + id).href = `tel:${data.phone}`;

                    document.getElementById('work-point').innerHTML = data.point;

                }else{
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error); // Xử lý lỗi
            });
    }
</script>
<style>
    .info li{
        list-style: none;
        margin-bottom: 1.5rem; 
        text-indent: 1rem;
    }
    pre {
        white-space: pre-wrap; 
        word-wrap: break-word; 
        font-family: inherit;  
        font-size: inherit;  
        margin: 0;            
        padding: 0;         
    }
</style>
@php
$hasService =
    $auth
        ->registrations()
        ->where('expired', '>=', now()->toDateString())
        ->whereHas('service', function ($query) {
            $query->where('show_contact_candidate', '1');
        })
        ->count() > 0;
@endphp
    <main>
        <section>
            <div class="container-fluid">
                <div class="d-flex gap-3 flex-wrap justify-content-between p-4">
                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded d-flex gap-3 justify-content-between" style="font-size: larger">
                        <i class="bi bi-people-fill" style="font-size: larger;color: greenyellow"></i>
                        <div>
                            {{ $job->applieds->count() }}
                            {{ __('candidates') }}
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded d-flex gap-3 justify-content-between" style="font-size: larger">
                        <i class="bi bi-eye" style="font-size: larger;color: orange"></i>
                        <div>
                            {{ $job->views->count() }}
                            {{ __('views') }}
                        </div>
                    </div>
                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded d-flex gap-3 justify-content-between" style="font-size: larger">
                        
                        <div>
                            @php
                                $expiryDate = \Carbon\Carbon::parse($job->expired);
                            @endphp
                    
                            @if ($expiryDate->isFuture() || $expiryDate->isToday())
                                {{ __('still') }} {{ $expiryDate->diffForHumans(['syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]) }}
                            @else
                                {{ __('expired') }} {{ $expiryDate->diffForHumans() }}
                            @endif
                        </div>
                        <i class="bi bi-calendar3" style="font-size: larger;color: purple"></i>
                    </div>
                    <div class="shadow p-3 mb-5 bg-body-tertiary rounded d-flex gap-3 justify-content-between" style="font-size: larger">
                        
                        <div>
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
                        <i class="bi bi-cash-stack" style="font-size: larger;color: red"></i>
                    </div>
                </div>

            </div>
        </section>
        <section>
            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                            <i class="bi bi-border-style"></i>
                            {{__('overview')}}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link " id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                            <i class="bi bi-info-square"></i>
                            {{__('job information')}}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        @php
                            $applieds = $job->applieds;
                        @endphp
                        <button class="nav-link" id="applied-tab" data-bs-toggle="tab" data-bs-target="#applied-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                            {{__('applied candidates')}} ({{$applieds->count()}})
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        @php
                            $views = $job->views()->whereNotNull('user_id')->get()->unique('user_id');
                        @endphp
                        <button class="nav-link" id="view-tab" data-bs-toggle="tab" data-bs-target="#view-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">
                            {{__('view candidates')}} ({{$views->count()}})
                        </button>
                    </li>
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="bg-white tab-pane fade show active " id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0" style="width: 78vw;">
                        <div class="container">
                            @php
                                $statuses = ['new', 'suitable', 'contact', 'interview', 'offer', 'success', 'failed'];
                            @endphp
                            <div class="w-100">
                                <div class="overflow-x-scroll d-flex gap-3" style="height: 300px;">

                                        @foreach ($statuses as $status)

                                        <div class="overflow-y-scroll h-100 p-2" style="min-width: 250px;max-width: 250px ;background-color: rgba(128, 128, 128, 0.5)">
                                            @php
                                                $applieds = $job->applieds()->where('status',$status)->get();
                                            @endphp
                                            <div>{{__($status)}}</div>
                                            <div>({{$applieds->count()}} {{__('categories')}})</div>

                                            @foreach ($applieds as $applied)
                                            <div class="bg-white w-100 p-2 mb-1">
                                                <div class="d-flex gap-3">
                                                    <div>
                                                        <img src="{{asset($applied->user->image) }}" alt="{{$applied->user->name}}" width="20px">
                                                    </div>
                                                    <div class="text-info">
                                                        {{$applied->user->name}}
                                                    </div>
                                                </div>
                                                <div class="fw-bold">
                                                    {{$applied->user->position}}
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <i class="bi bi-geo-alt"></i>
                                                    {{$applied->user->location}}
                                                </div>
                                                <div>
                                                    <i class="bi bi-clock-history"></i>
                                                    {{$applied->created_at}}
                                                </div>
                                            </div>  
                                            @endforeach

                                        </div>
                                            
                                        @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="bg-white my-4 rounded shadow">
                                <div class="d-flex justify-content-center" style="margin: auto;height: 500px;width: max-content;">
                                    <canvas id="chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="container">
                            <ul class="info" style=" columns: auto 25rem; font-size: larger">
                                <li>
                                    <div class="text-uppercase text-secondary" style="text-decoration: underline">{{__('job title')}}</div>
                                    <ul>
                                        <li>{{ $job->name }}</li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="text-uppercase text-secondary" style="text-decoration: underline">{{__('job description')}}</div>
                                    <ul>
                                        <li>
                                            <pre>{{ $job->description }}</pre>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class=" text-secondary" style="text-decoration: underline">{{__('job requirement')}}</div>
                                    <ul>
                                        <li>
                                            <pre>{{ $job->requirement }}</pre>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class=" text-secondary" style="text-decoration: underline">{{__('job benefits')}}</div>
                                    <ul>
                                        <li>
                                            <pre>{{ $job->benefits }}</pre>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class=" text-secondary" style="text-decoration: underline">{{__('job benefits')}}</div>
                                    <ul>
                                        <li>
                                            <pre>{{ $job->benefits }}</pre>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class=" text-secondary" style="text-decoration: underline">{{__('address')}}</div>
                                    <ul>
                                        <li>
                                            {{ $job->address }}
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class=" text-secondary" style="text-decoration: underline">{{__('professional career')}}</div>
                                    <div>
                                        @foreach ($job->professions as $profession)
                                        <span class="badge rounded-pill text-bg-light border">{{$profession->profession->name}}</span>
                                        @endforeach
                                    </div>
                                </li>
                                <li>
                                    <div class=" text-secondary" style="text-decoration: underline">{{__('degree required')}} ({{ __('minimum') }})</div>
                                    <ul>
                                        <li>
                                            {{ $job->degree }}
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class=" text-secondary" style="text-decoration: underline">{{__('experience required')}}</div>
                                    <ul>
                                        <li>
                                                {{ $job->experience == 0
                                                    ? __('no experience')
                                                    : ($job->experience == 6
                                                        ? __('over 5 years')
                                                        : $job->experience . ' ' . __('years')) }}
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class=" text-secondary" style="text-decoration: underline">{{__('Job nature')}}</div>
                                    <ul>
                                        <li>
                                            {{ $job->demand }}
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg-white tab-pane fade" id="applied-tab-pane" role="tabpanel" aria-labelledby="applied-tab" tabindex="0">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <td class="text-info fw-bold">{{__('avatar')}}</td>
                                    <td class="text-info fw-bold">{{__('name')}}</td>
                                    <td class="text-info fw-bold">{{__('status')}}</td>
                                    <td class="text-info fw-bold">{{__('applied date')}}</td>
                                    <td class="text-info fw-bold">{{__('work experiences')}}</td>
                                    <td class="text-info fw-bold">{{__('degree')}}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($applieds as $applied)
                                
                                <tr>
                                    <th scope="row" class="text-center">
                                        <button class="btn btn-lighter" data-bs-toggle="modal"
                                            data-bs-target="#candidate{{ $applied->id }}Modal">
                                            <img src="{{ asset($applied->user->image) }}" alt="{{ $applied->user->name }}"
                                                class="rounded-circle" width="50" height="50">
                                        </button>
                                        
                                    </th>
                                    <td class=" text-truncate">
                                        <button class="btn btn-lighter" data-bs-toggle="modal"
                                            data-bs-target="#candidate{{ $applied->id }}Modal">
                                            <strong>{{ $applied->user->name }}</strong>
                                        </button>
                                        <div class="small">
                                            {{__('year of birth')}}: {{Carbon\Carbon::parse($applied->user->date_of_birth)->year}}
                                        </div>
                                        <div class="small">
                                            {{__('location')}}: {{$applied->user->location}}
                                        </div>
                                        <div class="small">
                                            {{__('updated at')}}: {{$applied->user->updated_at}}
                                        </div>
                                        @include('employer.include.modal-applied-candidate')
                                    </td>
                                    <td>
                                        <span
                                            class=" badge w-100
                                            bg-{{ $applied->status == 'new'
                                            ? 'primary'
                                            : ($applied->status == 'suitable'
                                            ? 'success'
                                            : ($applied->status == 'contact'
                                            ? 'info'
                                            : ($applied->status == 'interview'
                                            ? 'warning'
                                            : ($applied->status == 'offer'
                                            ? 'secondary'
                                            : ($applied->status == 'success'
                                            ? 'success'
                                            : 'danger'))))) }}"
                                            type="button">
                                            {{ __($applied->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($applied->created_at)->format("H:i d/m/Y")}}
                                    </td>
                                    <td>
                                        @foreach ($applied->user->workExperiences as $workExperience)
                                        <div>
                                            <i class="bi bi-building"></i>
                                            {{__('company')}}: 
                                            {{$workExperience->company}}
                                        </div>                               
                                        @endforeach
                                    </td>
                                    <td>
                                        <div>
                                            <i class="bi bi-mortarboard"></i>
                                            {{__($applied->user->degree)}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-white tab-pane fade" id="view-tab-pane" role="tabpanel" aria-labelledby="view-tab" tabindex="0">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <td class="text-info fw-bold">{{__('avatar')}}</td>
                                    <td class="text-info fw-bold">{{__('name')}}</td>
                                    <td class="text-info fw-bold">{{__('work experiences')}}</td>
                                    <td class="text-info fw-bold">{{__('professional skill')}}</td>
                                    <td class="text-info fw-bold">{{__('degree')}}</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($views as $view)
                                    <tr>
                                        <th scope="row" class="text-center">
                                            <button class="btn btn-lighter" data-bs-toggle="modal"
                                                data-bs-target="#view{{ $view->id }}Modal">
                                                <img src="{{ asset($view->user->image) }}" alt="{{ $view->user->name }}"
                                                    class="rounded-circle" width="50" height="50">
                                            </button>
                                            
                                        </th>
                                        <td class=" text-truncate">
                                            <button class="btn btn-lighter" data-bs-toggle="modal"
                                                data-bs-target="#view{{ $view->id }}Modal">
                                                <strong>{{ $view->user->name }}</strong>
                                            </button>
                                            <div class="small">
                                                {{__('year of birth')}}: {{Carbon\Carbon::parse($view->user->date_of_birth)->year}}
                                            </div>
                                            <div class="small">
                                                {{__('location')}}: {{$view->user->location}}
                                            </div>
                                            <div class="small">
                                                {{__('updated at')}}: {{$view->user->updated_at}}
                                            </div>
                                            @include('employer.include.modal-views-candidate')
                                        </td>
                                        <td>
                                            @foreach ($view->user->workExperiences as $workExperience)
                                            <div>
                                                <i class="bi bi-building"></i>
                                                {{__('company')}}: 
                                                {{$workExperience->company}}
                                            </div>                               
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($view->user->professionalSkills as $professionalSkill)
                                            <div>
                                                <i class="bi bi-check-square"></i>
                                                {{$professionalSkill->professional_skill}}
                                                ({{ $professionalSkill->year . ' ' . __('years') }})
                                            </div>                               
                                            @endforeach
                                        </td>
                                        <td>
                                            <div>
                                                <i class="bi bi-mortarboard"></i>
                                                {{__($view->user->degree)}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                  </div>
            </div>
        </section>
        <section>
            <div class="modal face" id="showContactModal" tabindex="-1" aria-labelledby="showContactModalLabel"
                aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="showContactModalLabel">
                                {{ __('show contact information') }}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if (auth()->guard('employer')->user()->point >= 5)
                            <input type="hidden" name="contactModal" id="contactModal" value="">
                            <div class="m-3 p-3 border rounded-3">
                                <div>
                                    {{ __('do you want to use 5 workpoints to display contacts?') }}
                                </div>
                                <button class="btn btn-success" onclick="showContactPoint(document.getElementById('contactModal').value)" data-bs-dismiss="modal">
                                    {{ __('yes') }}
                                </button>
                            </div>
                            @endif
                            <div class="m-3 p-3 border rounded-3">
                                @php
                                    $customerCare = \App\Models\CustomerCare::first();
                                @endphp
                                <div>
                                    <div>{{ __('register to complete the action') }}</div>
                                    <hr>
                                    <div>{{ __('contact us for consultation') }}</div>
                                    @if ($customerCare)
                                        <div>
                                            <strong>{{ __('customer service specialist') }}:</strong>
                                            {{ $customerCare->name }}
                                        </div>
                                        <div>
                                            <strong>{{ __('phone') }}: </strong>
                                            <a class="text-primary"
                                                href="tel:{{ $customerCare->phone }}">{{ $customerCare->phone }}</a>
                                        </div>
                                        <div>
                                            <strong>{{ __('email') }}: </strong>
                                            <a class="text-primary"
                                                href="mailto:{{ $customerCare->email }}">{{ $customerCare->email }}</a>
                                        </div>
                                    @else
                                        <div>
                                            <strong>{{ __('customer service specialist') }}:</strong>
                                            {{ __('not updated yet') }}
                                        </div>
                                        <div>
                                            <strong>{{ __('phone') }}: </strong>
                                            <a class="text-primary" href="tel:">{{ __('not updated yet') }}</a>
                                        </div>
                                        <div>
                                            <strong>{{ __('email') }}: </strong>
                                            <a class="text-primary" href="mailto:">{{ __('not updated yet') }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('close') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="modal face" id="showContactViewModal" tabindex="-1" aria-labelledby="showContactViewModalLabel"
                aria-hidden="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="showContactViewModalLabel">
                                {{ __('show contact information') }}
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if (auth()->guard('employer')->user()->point >= 5)
                            <input type="hidden" name="contactViewModal" id="contactViewModal" value="">
                            <div class="m-3 p-3 border rounded-3">
                                <div>
                                    {{ __('do you want to use 5 workpoints to display contacts?') }}
                                </div>
                                <button class="btn btn-success" onclick="showContactViewPoint(document.getElementById('contactViewModal').value)" data-bs-dismiss="modal">
                                    {{ __('yes') }}
                                </button>
                            </div>
                            @endif
                            <div class="m-3 p-3 border rounded-3">
                                @php
                                    $customerCare = \App\Models\CustomerCare::first();
                                @endphp
                                <div>
                                    <div>{{ __('register to complete the action') }}</div>
                                    <hr>
                                    <div>{{ __('contact us for consultation') }}</div>
                                    @if ($customerCare)
                                        <div>
                                            <strong>{{ __('customer service specialist') }}:</strong>
                                            {{ $customerCare->name }}
                                        </div>
                                        <div>
                                            <strong>{{ __('phone') }}: </strong>
                                            <a class="text-primary"
                                                href="tel:{{ $customerCare->phone }}">{{ $customerCare->phone }}</a>
                                        </div>
                                        <div>
                                            <strong>{{ __('email') }}: </strong>
                                            <a class="text-primary"
                                                href="mailto:{{ $customerCare->email }}">{{ $customerCare->email }}</a>
                                        </div>
                                    @else
                                        <div>
                                            <strong>{{ __('customer service specialist') }}:</strong>
                                            {{ __('not updated yet') }}
                                        </div>
                                        <div>
                                            <strong>{{ __('phone') }}: </strong>
                                            <a class="text-primary" href="tel:">{{ __('not updated yet') }}</a>
                                        </div>
                                        <div>
                                            <strong>{{ __('email') }}: </strong>
                                            <a class="text-primary" href="mailto:">{{ __('not updated yet') }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('close') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        const chartData = @json($chartData)

        const ctx = document.getElementById('chart').getContext('2d');
        const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: '{{ __("applied") }}',
                    data: chartData.allApplieds,
                    backgroundColor: 'rgba(0, 0, 255, 0.2)', // Xanh dương nhạt
                    borderColor: 'rgba(0, 0, 255, 1)',       // Xanh dương đậm
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: '{{ __("views") }}',
                    data: chartData.allViews,
                    backgroundColor: 'rgba(0, 255, 0, 0.2)', // Xanh lá nhạt
                    borderColor: 'rgba(0, 255, 0, 1)',       // Xanh lá đậm
                    borderWidth: 2,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return ` ${context.dataset.label}: ${context.raw}`;
                        }
                    }
                },
                title: {
                    display: true,
                    text: '{{__('job views and applications statistics for the last 30 days')}}',
                    
                    font: {
                        size: 16
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                            return null;
                        }
                    }
                }
            }
        }
    });
    </script>
@endsection
