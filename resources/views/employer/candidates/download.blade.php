@extends('layouts.employer.index')

@section('title', request()->getHost() . ': ' . __('download list of candidates'))

@section('breadcrumb-item')
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('download list of candidates') }}
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
                    document.getElementById('tableEmail' + id).innerHTML = data.email;
                    
                    document.getElementById('showPhone' + id).innerHTML = data.phone;
                    document.getElementById('showPhone' + id).href = `tel:${data.phone}`;
                    document.getElementById('tablePhone' + id).innerHTML = data.phone;
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
                    document.getElementById('tableEmail' + id).innerHTML = data.email;
                    
                    document.getElementById('showPhone' + id).innerHTML = data.phone;
                    document.getElementById('showPhone' + id).href = `tel:${data.phone}`;
                    document.getElementById('tablePhone' + id).innerHTML = data.phone;

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
            <h1>
                {{ __('candidates') }}
            </h1>
            <div>
                <form method="GET">
                    <div>
                        <div class="btn-group px-4" role="group" aria-label="Basic radio toggle button group">
                            {{-- new suitable contact interview offer success failed --}}
                            <input type="radio" class="btn-check" name="status" id="all"
                                value="" autocomplete="off" onclick="this.form.submit()"
                                @checked(request('status', ''))>
                            <label
                                class="btn btn-outline-success text-capitalize {{ request('status') == '' ? 'active' : '' }}"
                                for="all">
                                {{ __('all') }}
                            </label>
                            @foreach ([ 'new', 'suitable', 'contact', 'interview', 'offer', 'success', 'failed'] as $status)
                                <input type="radio" class="btn-check" name="status" id="{{ $status }}"
                                    value="{{ $status }}" autocomplete="off" onclick="this.form.submit()"
                                    @checked(request('status', '') == $status)>
                                <label
                                    class="btn btn-outline-success text-capitalize {{ request('status') == $status ? 'active' : '' }}"
                                    for="{{ $status }}">
                                    {{ __($status) }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
            <hr>
        </section>
        <section>
            <div class="d-flex justify-content-between p-4">
                <h5>
                    {{ __('all candidate list') }}
                </h5>
                <a class="btn btn-primary" id="downloadExcel" href="#">
                    {{ __('Download Excel') }}
                </a>
                {{-- <button class="btn btn-primary" id="downloadExcel">
                    {{ __('Download Excel') }}
                </button> --}}
                <script>
                    document.getElementById('downloadExcel').addEventListener('click', function(event) {
                        event.preventDefault();
                        const status = `{{ request('status') }}`;
                        const url = `{{ route('employer.downloadExcel') }}?status=${status}`;
                        window.location.href = url;
                    });
                </script>
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
                            <th scope="col">{{ __('email') }}</th>
                            <th scope="col">{{ __('phone') }}</th>
                            <th scope="col">{{ __('status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider" id="result">
                        @foreach ($applieds as $applied)
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
                            <tr>
                                <th scope="row">
                                    <button class="btn btn-lighter" >
                                        <img src="{{ asset($applied->user->image) }}" alt="{{ $applied->user->name }}"
                                            class="rounded-circle" width="50" height="50">
                                    </button>
                                </th>
                                <td>
                                    <button class="btn btn-lighter">
                                        <strong>{{ $applied->user->name }}</strong>
                                    </button>
                                </td>
                                <td>
                                    <strong>{{ $applied->job->name . ' #' . $applied->id }}</strong>
                                    <div>
                                        <small>
                                            {{ __('applied date') }}
                                            {{ $applied->created_at->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </td>
                                <td>{{ $applied->show_contact ? $applied->user->email : __('contact not activated') }}
                                </td>
                                <td>{{ $applied->show_contact ? $applied->user->phone : __('contact not activated') }}
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <span
                                            class="dropdown-toggle badge 
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
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __($applied->status) }}
                                        </span>
                                        <ul class="dropdown-menu">
                                            @foreach (['new', 'suitable', 'contact', 'interview', 'offer', 'success', 'failed'] as $status)
                                                <li>
                                                    <form
                                                        action="{{ route('employer.candidates.update', ['candidate' => $applied->id, 'status' => $status]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('put')
                                                        <button class="dropdown-item" type="submit">
                                                            {{ __($status) }}
                                                        </button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
    
@endsection
