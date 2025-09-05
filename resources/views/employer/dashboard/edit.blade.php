@extends('layouts.employer.index')

@section('title', request()->getHost() . ': ' . __('dashboard') . ' - ' . __('profile'))

@section("breadcrumb-item")
    <li class="breadcrumb-item">
        {{ __('profile') }}
    </li>
@endsection

@section('content')
    <main>
        <section class="d-flex gap-4 p-5 m-3 bg-white rounded-3">
            <div class="text-center w-50">
                <div>
                    <img src="{{ asset($auth->image) }}" alt="{{ $auth->name }}" width="200" height="200"
                        class="rounded-3" data-bs-toggle="modal" data-bs-target="#imageModal">
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="modal-content" method="POST" enctype="multipart/form-data"
                                action="{{ route('employer.dashboard.update', $auth->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">{{ __('change avatar') }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{ __('exit') }}</button>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <div>
                    <div class="d-flex">
                        <strong style="width: 200px;">{{ __('company') }}: </strong>
                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                            data-bs-target="#nameModal">{{ $auth->name }}</u>
                        <div class="modal fade" id="nameModal" tabindex="-1" aria-labelledby="nameModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('employer.dashboard.update', $auth->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            {{ __('edit company name') }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" name="name"
                                                value="{{ $auth->name }}" required>
                                            <label>{{ __('company name') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <strong style="width: 200px;">{{ __('phone') }}: </strong>
                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                            data-bs-target="#phoneModal">{{ $auth->phone }}</u>
                        <div class="modal fade" id="phoneModal" tabindex="-1" aria-labelledby="phoneModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST" action="{{ route('employer.dashboard.update', $auth->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            {{ __('edit') }} {{ __('phone') }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" type="tel" name="phone" id="phone" value="{{ $auth->phone }}" required>
                                            <label>
                                                {{ __('phone') }} 
                                                {{-- (+8491234567) --}}
                                            </label>
                                        </div>
                                        {{-- <div class="mb-3">
                                            <div class="d-flex gap-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" name="code" id="otp" required>
                                                    <label>
                                                        {{ __('veri code') }}
                                                    </label>
                                                </div>
                                                <button type="button" class="btn btn-primary" id="get_code"
                                                    onclick="getcode(this.form.phone.value,this)">
                                                    {{ __('get code') }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3" id="recaptcha-container"></div> --}}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">{{ __('save') }}</button>
                                        {{-- <button type="button" class="btn btn-primary" onclick="verifyOtp(this.form.phone.value)">
                                            {{ __('save') }}
                                        </button> --}}
                                    </div>
                                </form>
                                
                                <script type="module">
                                    // Import the functions you need from the SDKs you need
                                    // import { initializeApp } from "https://www.gstatic.com/firebasejs/11.2.0/firebase-app.js";
                                    // import { getAuth, RecaptchaVerifier, signInWithPhoneNumber } from "https://www.gstatic.com/firebasejs/11.2.0/firebase-auth.js";
                                    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
                                    import { getAuth, RecaptchaVerifier, signInWithPhoneNumber } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-auth.js";
                                    // TODO: Add SDKs for Firebase products that you want to use
                                    // https://firebase.google.com/docs/web/setup#available-libraries
                                  
                                    // Your web app's Firebase configuration
                                    const firebaseConfig = {
                                        apiKey: "{{ config('firebase.api_key') }}",
                                        authDomain: "{{ config('firebase.auth_domain') }}",
                                        projectId: "{{ config('firebase.project_id') }}",
                                        storageBucket: "{{ config('firebase.storage_bucket') }}",
                                        messagingSenderId: "{{ config('firebase.messaging_sender_id') }}",
                                        appId: "{{ config('firebase.app_id') }}"
                                    };
                                  
                                    // Initialize Firebase
                                    const app = initializeApp(firebaseConfig);

                                    // Hàm gửi mã OTP
                                    window.getcode = async (phone, button) => {
                                        if (!phone) {
                                            alert("Please enter your phone.");
                                            return;
                                        }
                                        // const phonePattern = /^[0-9]{10,15}$/;
                                        // if (!phonePattern.test(phone)) {
                                        //     alert("Please enter a valid phone number.");
                                        //     return;
                                        // }

                                        button.disabled = true;
                                        button.innerHTML =
                                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

                                        try {
                                            const auth = getAuth(app);

                                            if (!window.recaptchaVerifier) {
                                                window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {
                                                    size: 'invisible',
                                                    callback: (response) => {
                                                        console.log('reCAPTCHA solved, allow signInWithPhoneNumber');
                                                    },
                                                    'expired-callback': () => {
                                                        console.error('reCAPTCHA expired. Please solve it again.');
                                                    }
                                                }, auth);
                                            }
                                            const appVerifier = window.recaptchaVerifier;
                                            signInWithPhoneNumber(auth, phone, appVerifier)
                                                .then((confirmationResult) => {
                                                    window.confirmationResult = confirmationResult;
                                                    alert('OTP sent successfully. Check your phone!');
                                                })
                                                .catch((error) => {
                                                    console.error('Error sending OTP:', error);
                                                    alert('Failed to send OTP. Please try again.');
                                                });
                                            } catch (error) {
                                                console.error('Error:', error);
                                            } finally {
                                                button.disabled = false;
                                                button.innerHTML = '{{ __('get code') }}';
                                            }
                                    };
                                                                    
                                
                                    window.verifyOtp = (phone) => {
                                        const code = document.getElementById('otp').value;
                                        if (!phone) {
                                            alert('Please enter phone numbers.');
                                            return false;
                                        }
                                        if (!code) {
                                            alert('Please enter the OTP code.');
                                            return false;
                                        }
                                        window.confirmationResult.confirm(code)
                                            .then((result) => {
                                                const url = `{{ route('employer.dashboard.update',0) }}`;
                                                const data = {
                                                    _method: "PUT",
                                                    phone: phone
                                                };
                                                try {
                                                    const response = fetch(url, {
                                                        method: "POST",
                                                        headers: {
                                                            "Content-Type": "application/json",
                                                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                                                'content')
                                                        },
                                                        body: JSON.stringify(data)
                                                    });
                                                    alert('Phone number verified successfully.');
                                                    location.reload();
                                                } catch (error) {
                                                    console.error("Error:", error);
                                                    //alert("Error: " + error);
                                                }
                                            })
                                            .catch((error) => {
                                                console.error('Error verifying OTP:', error);
                                                alert('Invalid OTP. Please try again.');
                                            });
                                    }
                                  </script>
                            </div>
                        </div>
                    </div>
                    <div id=data>

                    </div>
                    <div class="d-flex">
                        <strong style="width: 200px;">{{ __('register name') }}: </strong>
                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                            data-bs-target="#register_nameModal">{{ $auth->register_name }}</u>
                        <div class="modal fade" id="register_nameModal" tabindex="-1"
                            aria-labelledby="register_nameModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('employer.dashboard.update', $auth->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            {{ __('edit') }} {{ __('register name') }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" name="register_name"
                                                value="{{ $auth->register_name }}" required>
                                            <label>{{ __('register name') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <strong style="width: 200px;">{{ __('address') }}: </strong>
                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                            data-bs-target="#addressModal">{{ $auth->address }}</u>
                        <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('employer.dashboard.update', $auth->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            {{ __('edit') }} {{ __('address') }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" name="address"
                                                value="{{ $auth->address }}" required>
                                            <label>{{ __('address') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <strong style="width: 200px;">{{ __('tax code') }}: </strong>
                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                            data-bs-target="#tax_codeModal">{{ $auth->tax_code ?? __('not updated') }}</u>
                        <div class="modal fade" id="tax_codeModal" tabindex="-1" aria-labelledby="tax_codeModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('employer.dashboard.update', $auth->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            {{ __('edit') }} {{ __('tax code') }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" name="tax_code"
                                                value="{{ $auth->tax_code }}" required>
                                            <label>{{ __('tax code') }}</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <strong style="width: 200px;">Website: </strong>
                        <u style="text-decoration: underline dotted red;" data-bs-toggle="modal"
                            data-bs-target="#website_urlModal">
                            {{ $auth->website_url ?? __('not updated') }}
                        </u>
                        <div class="modal fade" id="website_urlModal" tabindex="-1" aria-labelledby="website_urlModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form class="modal-content" method="POST"
                                    action="{{ route('employer.dashboard.update', $auth->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5">
                                            {{ __('edit') }} Website Url
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" name="website_url"
                                                value="{{ $auth->website_url }}" required>
                                            <label>Website url</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{ __('exit') }}</button>
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <strong style="width: 200px;">{{ __('updated at') }}:</strong>
                        <u style="text-decoration: none;">
                            {{ $auth->updated_at }}
                        </u>
                    </div>
                    <div class="d-flex">
                        <strong style="width: 200px;">{{ __('join date') }}:</strong>
                        <u style="text-decoration: none;">
                            {{ $auth->created_at }}
                        </u>
                    </div>
                </div>
            </div>
        </section>

        <section class="p-5 m-3 bg-white rounded-3">
            <form method="POST" action="{{ route('employer.dashboard.update', $auth->id) }}">
                @csrf
                @method('PUT')
                <div>
                    <strong>
                        {{ __('description') }}:
                    </strong>
                </div>
                <div class="w-100 mt-3">
                    <textarea rows="10" class="form-control w-100 " name="employee_count" required>{{ $auth->description }}</textarea>
                    
                </div>
                <div class="mt-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <strong>
                                {{__(key: 'employee count')}}
                            </strong>
                            <div>
                                <select name="employee_count" class="form-select">
                                    <option value="">{{__('select')}}</option>
                                    <option value="<10" {{ $auth->employee_count == "<10" ? 'selected' : '' }}>10-20</option>
                                    <option value="20-50" {{ $auth->employee_count == "20-50" ? 'selected' : '' }}>20-50</option>
                                    <option value="50-100" {{ $auth->employee_count == "50-100" ? 'selected' : '' }}>50-100</option>
                                    <option value="100-200" {{ $auth->employee_count == "100-200" ? 'selected' : '' }}>100-200</option>
                                    <option value="200-500" {{ $auth->employee_count =="200-500" ? 'selected' : '' }}>200-500</option>
                                    <option value="500-1000" {{ $auth->employee_count == "500-1000" ? 'selected' : '' }}>500-1000</option>
                                    <option value="1000-2000" {{ $auth->employee_count == "1000-2000" ? 'selected' : '' }}>1000-2000</option>
                                    <option value=">2000" {{ $auth->employee_count == '>2000' ? 'selected' : '' }}>>2000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <strong>
                                {{__('average age')}}
                            </strong>
                            <div>
                                <select name="employee_count" id="" class="form-select">
                                    <option value="">{{__('select')}}</option>
                                    <option value="20-30" {{ $auth->average_age == "20-30" ? 'selected' : '' }}>20-30</option>
                                    <option value="30-40" {{ $auth->average_age == "30-40" ? 'selected' : '' }}>30-40</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-primary">{{ __('save') }}</button>
                </div>
            </form>
        </section>
        <section class="d-flex gap-4 p-5 m-3 bg-white rounded-3">
            <div class="text-center w-50">
                <div>
                    <strong>
                        {{ __('registration service') }}:
                    </strong>
                </div>
            </div>
            <div class="w-100">
                @foreach ($auth->registrations as $registration)
                    <div>
                        <div> - {{ $registration->service->name }}</div>
                        <a class="{{ $registration->expired < now() ? 'text-danger' : 'link-success' }}
                link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                            style="text-decoration: underline">
                            {{ $registration->expired }} {{ $registration->expired < now() ? __('expired') : '' }}
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
        
    </main>
@endsection

