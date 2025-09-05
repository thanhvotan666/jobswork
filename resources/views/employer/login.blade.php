<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<link href="{{ asset('storage/css/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
<style>
    .login.active{
        display: none;
    }
</style>

<script>
    async function getEmailCode(email, button) {
        if (!email) {
            alert("Please enter your email.");
            return;
        }
        button.disabled = true;
        button.innerHTML =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        const url = `{{ route('get_google_employer') }}`;

        const data = {
            email: email
        };
        try {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            alert(result.message);
        } catch (error) {
            console.error("Error:", error);
            alert("Error: " + error);
        } finally {

            button.disabled = false;
            button.innerHTML = '{{ __('submit') }}';
        }
    }
</script>
<script>
    async function sendEmailCode(email, button) {
        if (!email) {
            alert("Please enter your email.");
            return;
        }
        button.disabled = true;
        button.innerHTML =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        const url = `{{ route('fp_employer.store') }}`;

        const data = {
            email: email
        };
        try {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            alert(result.message);
        } catch (error) {
            console.error("Error:", error);
            alert("Error: " + error);
        } finally {
            button.disabled = false;
            button.innerHTML = '{{ __('submit') }}';
        }
    }
</script>
</head>
<body>
    @include('layouts.include.alert')
    <div class="d-flex min-vh-100 justify-content-center align-items-center p-4">
        <div class="card shadow w-100" style="max-width: 400px;">
            <div class="card-header text-center">
                <h2 class="h4 mb-1">
                    {{__('login')}}
                </h2>
                <p class="text-muted mb-0">
                    Enter your email below to login to your account
                </p>
                @if (request('message'))
                    <p class="text-success mb-0">
                        {{ request('message') }}
                    </p>
                @endif
                
            </div>
            <div class="card-body">
            
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                        <form method="POST" action="{{ route('employer.check_login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{__('email address')}}</label>
                                <input
                                type="email"
                                class="form-control"
                                name="email"
                                placeholder="m@example.com"
                                value="{{old('email')}}"
                                required
                                />
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label">
                                        Password
                                    </label>
                                    <a class="small link text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#forgotpasswordModal">
                                        {{ __('forgot password') }}?
                                    </a>
                                </div>
                                <input
                                type="password"
                                class="form-control"
                                name="password"
                                required
                                />
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">{{__('login')}}</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                        <form method="POST" action="{{route('check_login_google_employer')}}" >
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{__('email address')}}</label>
                                <input
                                type="email"
                                class="form-control"
                                name="email"
                                value="{{old('email')}}"
                                placeholder="m@example.com"
                                required
                                />

                            </div>
                            <div class="mb-3">
                                <label class="form-label">{{__('veri code')}}</label>
                                <div class="d-flex gap-3">
                                    <input type="text" class="form-control" name="code" id="code"
                                        value="{{ old('code') }}" required>
                                    <button type="button" class="btn btn-primary text-nowrap" id="get_code" name="get_code"
                                        onclick="getEmailCode(this.form.email.value, this)">
                                        {{ __('get code') }}
                                    </button>

                                </div>
                            </div>
                        
                            <div class="mb-3">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-success">{{__('login')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-3 nav-pills" id="pills-tab" role="tablist">
                    <div role="presentation">
                        <button type="button" class="btn btn-outline-secondary form-control login active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                            {{__('Login with Password')}}
                        </button>
                    </div>
                    <div role="presentation">
                        <button type="button" class="btn btn-outline-secondary form-control login" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                            {{__('Login with Google')}}
                        </button>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small>{{__('don\'t have an account?')}} 
                        <a href="{{ route('employer.register') }}" class="text-decoration-underline">
                            {{__('register')}}
                        </a>
                    </small>
                </div>
        </div>
    </div>
    </div>
<section>
    <div class="modal fade" id="forgotpasswordModal" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="forgotpasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" method="POST" action="{{ route('rv_employer.store') }}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ __('forgot password') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">{{__('email address')}}</label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" placeholder="m@example.com" required/>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ __('close') }}
                    </button>
                    
                    <button type="button" class="btn btn-primary" name="send_code"
                        onclick="sendEmailCode(this.form.email.value,this)">
                        {{ __('submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

</body>
</html>