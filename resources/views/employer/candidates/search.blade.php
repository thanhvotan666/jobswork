@extends('layouts.employer.index')

@section('title', request()->getHost() . ': ' . __('search'))

@section('breadcrumb-item',)
<li class="breadcrumb-item active" aria-current="page">
    {{ __('search') }}
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

    function showContactSearch(id) {
        const url =
            `{{ route('employer.show_contact_search') }}`; // Nếu dùng `route()` trên Laravel phía server thì URL sẽ trông như vậy.
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

    function showContactSearchPoint(id) {
        const url =
            `{{ route('employer.show_contact_search_point') }}`;
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

                    try {
                        document.getElementById('showAttachment' + id).innerHTML = "{{ __('download') }}" +
                            "{{ __('attachment') }}";
                        document.getElementById('showAttachment' + id).href = "{{ request()->getHost() }}/" + data
                            .attachment;
                    } catch (error) {

                    }
                }else{
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error("Error:", error); // Xử lý lỗi
            });
    }
</script>
    <main>
        <section>
            <div class="container-fluid">
                <div class="container">
                    <h6>{{__('basic filter')}}</h6>
                    <div class="row row-cols-1 row-cols-sm-2 g-2 g-sm-3">
                        <div>
                            <input type="text" name="search" id="search" 
                            class="form-control" placeholder="{{__('search')}}">
                        </div>
                        <div>
                            <select name="location" id="location" class="form-select">
                                @php
                                    $location_selects = \App\Models\LocationSelect::all();
                                @endphp
                                <option>{{__('location')}}</option>
                                @foreach ($location_selects as $location)
                                    <option value="{{ $location->id }}">{{ $location->location }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if (request('profession'))
            <section>
                <div class="container-fluid">
                    <div class="container">
                        <div class="py-5">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">{{ __('avatar') }}</th>
                                        <th scope="col">{{ __('name') }}</th>
                                        <th scope="col">{{ __('school/center') }}</th>
                                        <th scope="col">{{ __('company') }}</th>
                                        <th scope="col">{{ __('professional skill') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                    @foreach ($applieds as $applied)
                                        <tr>
                                            <th scope="col">
                                                <button class="btn btn-lighter" data-bs-toggle="modal"
                                                    data-bs-target="#candidate{{ $applied->id }}Modal">
                                                    <img src="{{ asset($applied->user->image) }}" alt="{{ $applied->user->name }}"
                                                        class="rounded-circle" width="50" height="50">
                                                </button>
                                                @include('employer.include.modal-search-candidate')
                                            </th>
                                            <th scope="col">
                                                <button class="btn btn-lighter" data-bs-toggle="modal"
                                                    data-bs-target="#candidate{{ $applied->id }}Modal">
                                                    <h5>{{ $applied->user->name }}</h5>
                                                </button>
                                            </th>
                                            <th scope="col">
                                                <div class="d-flex flex-column justify-content-center gap-1">
                                                    @foreach ($applied->user->learningProcesses as $learningProcesse)
                                                        <div>
                                                            <i class="bi bi-journal-bookmark-fill"></i>
                                                            {{$learningProcesse->school}}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </th>
                                            <th scope="col">
                                                <div class="d-flex flex-column justify-content-center gap-1">
                                                    @foreach ($applied->user->workExperiences as $work)
                                                        <div>
                                                            <i class="bi bi-buildings-fill"></i>
                                                            {{$work->company}}
                                                        </div>
                                                    @endforeach
                                                </div>  
                                            </th>
                                            <th scope="col">
                                                <div class="d-flex flex-column justify-content-center gap-1">
                                                    @foreach ($applied->user->professionalSkills as $skill)
                                                        <div>
                                                            <i class="bi bi-asterisk"></i>
                                                            {{$skill->professional_skill}}
                                                        </div>
                                                    @endforeach
                                                </div>  
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                             </table>
                             <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                                {{ $applieds->appends([
                                        'search' => request('search'),
                                        'location' => request('location'),
                                    ])->links() }}
                            </div>
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
                                        {{ __('do you want to use 1 workpoints to display contacts?') }}
                                    </div>
                                    <button class="btn btn-success" onclick="showContactSearchPoint(document.getElementById('contactModal').value)" data-bs-dismiss="modal">
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
        @else
            <section>
                <div class="container-fluid">
                    <div class="container">
                        <div>
                            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-2 g-md-3 bg-white rounded p-3">
                                @foreach ($professions as $profession)
                                    <div class="col">
                                        <a href="{{route('employer.search')}}?profession={{$profession->id}}" class="text-primary">
                                            @php
                                                $appliedCount = \App\Models\Applied::whereIn('job_id', $profession->jobs()->pluck('id'))->count();
                                            @endphp
                                            {{ $profession->name }} (<text class="text-warning">{{ $appliedCount }}</text>)
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        @endif
    </main>
@endsection
