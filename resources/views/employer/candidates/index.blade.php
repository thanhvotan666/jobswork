@extends('layouts.employer.index')

@section('title', request()->getHost() . ': ' . __('candidates'))

@section('breadcrumb-item')
    <li class="breadcrumb-item active" aria-current="page">
        {{ __('candidates') }}
    </li>
@endsection

@section('content')
    <main>
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
        <section>
            <h1>
                {{ __('candidates') }}
            </h1>
            <div>
                <form method="GET">
                    <div class="d-flex flex-wrap gap-3 px-4 fw-bold ">
                        <input type="hidden" name="expired" value="{{ request('expired', '') }}">
                        <button onclick="this.form.expired.value = '';this.form.submit();" value=""
                            class="btn btn-outline-success {{ request('expired', '') != '' ?: 'active' }}">
                            {{ __('all job') }}
                            ({{ $auth->jobs->count() }})
                        </button>
                        <button onclick="this.form.expired.value = 'online';this.form.submit();"
                            class="btn btn-outline-success {{ request('expired', '') != 'online' ?: 'active' }}">
                            {{ __('online job') }}
                            ({{ $auth->jobs->where('expired', '>=', now()->toDateString())->count() }})
                        </button>
                        <button onclick="this.form.expired.value = 'expired';this.form.submit();"
                            class="btn btn-outline-success {{ request('expired', '') != 'expired' ?: 'active' }}">
                            {{ __('expired job') }}
                            ({{ $auth->jobs->where('expired', '<', now()->toDateString())->count() }})
                        </button>
                    </div>
                    <br>
                    <div>
                        <div class="btn-group px-4" role="group" aria-label="Basic radio toggle button group">
                            {{-- new suitable contact interview offer success failed --}}
                            @foreach (['all', 'new', 'suitable', 'contact', 'interview', 'offer', 'success', 'failed'] as $status)
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
            </div>
            <hr>
        </section>
        <section>
            <div class="d-flex justify-content-between p-4">
                <h5>
                    {{ __('all candidate list') }}
                </h5>
                <div>
                    {{ __('showing') }}
                    {{ 1 * request('page', '1') }}
                    -
                    {{ 20 * (request('page', '1') - 1) + $applieds->count() }}
                    {{ __('of') }} {{ $appliedsCount }} {{ __('results') }}
                </div>
            </div>
            <hr>
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
                                <th scope="row">
                                    <button class="btn btn-lighter" data-bs-toggle="modal"
                                        data-bs-target="#candidate{{ $applied->id }}Modal">
                                        <img src="{{ asset($applied->user->image) }}" alt="{{ $applied->user->name }}"
                                            class="rounded-circle" width="50" height="50">
                                    </button>
                                    @include('employer.include.modal-applied-candidate')
                                </th>
                                <td>
                                    <button class="btn btn-lighter" data-bs-toggle="modal"
                                        data-bs-target="#candidate{{ $applied->id }}Modal">
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
                                <td id="tableEmail{{ $applied->id }}">
                                    {{ $applied->show_contact ? $applied->user->email : __('contact not activated') }}
                                </td>
                                <td id="tablePhone{{ $applied->id }}">
                                    {{ $applied->show_contact ? $applied->user->phone : __('contact not activated') }}
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
                <div class="px-3 d-flex align-items-center gap-4 justify-content-center mt-3">
                    {{ $applieds->appends([
                            'name' => request('name'),
                            'status' => request('status'),
                            'expired' => request('expired'),
                        ])->links() }}
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
    </main>

@endsection
