<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ config('app.name') }} Đăng ký tài khoản
    </title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #004d80;
            color: white;
        }

        .form-container {
            background-color: #333;
            padding: 20px;
            border-radius: 5px;
        }

        .form-container label {
            color: white;
        }

        .form-container .form-control {
            background-color: #444;
            color: white;
            border: none;
        }

        .form-container .form-control:focus {
            background-color: #555;
            color: white;
        }

        .form-container .btn {
            background-color: #ffcc00;
            color: black;
            border: none;
        }

        .form-container .btn:hover {
            background-color: #e6b800;
        }

        .info-section {
            color: white;
        }

        .info-section h2 {
            font-size: 2rem;
        }

        .info-section p {
            font-size: 1rem;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        @include('layouts.include.alert')
        <div class="row">
            <div class="col-md-4">
                <div class="form-container">
                    <div class="text-center mb-4">
                        <img alt="logo" height="100" src="{{ asset('storage/image/' . config('app.logo')) }}"
                            width="100" />
                    </div>
                    <form method="POST" action="{{ route('employer.check_register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('email') }}
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <input class="form-control" name="email" id="email" type="email"
                                value="{{ old('email') }}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('veri code') }}
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <div class="d-flex gap-3">
                                <input type="text" class="form-control" name="code" id="code"
                                value="{{ old('code') }}" required>
                                <button type="button" class="btn btn-primary" id="get_code" style="min-width: fit-content"
                                    onclick="getCode(this.form.email.value, this)">
                                    {{ __('get code') }}
                                </button>
                            </div>
                            <script>
                                async function getCode(email, button) {
                                    if (!email) {
                                        alert("Please enter your email.");
                                        return;
                                    }
                                    button.disabled = true;
                                    button.innerHTML =
                                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                                    const url = `{{ route('rv_employer.store') }}`;
                                    const data = {
                                        email: email
                                    };
                                    try {
                                        const response = await fetch(url, {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                                    'content')
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
                                        button.innerHTML = '{{ __('get code') }}';
                                    }
                                }
                            </script>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('password') }}
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <input class="form-control" name="password"  type="password" required/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('company name') }}
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <input class="form-control" name="name" id="name" type="text"
                                value="{{ old('name') }}" required />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('phone') }}
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <input class="form-control" name="phone" id="phone" value="{{ old('phone') }}"
                                required type="tel" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('register name') }}
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <input class="form-control" name="register_name" id="register_name"
                                value="{{ old('register_name') }}" required type="text" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                {{ __('address') }}
                                <i class="fas fa-info-circle">
                                </i>
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <select class="form-select" name="address" required>
                                @foreach (\App\Models\LocationSelect::all() as $p)
                                    <option value="{{ $p->location }}" @selected(old('location') == $p->location)>
                                        {{ $p->location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 form-check">
                            <input class="form-check-input" name="noTaxCode" id="noTaxCode" type="checkbox"
                                @checked(old('noTaxCode'))
                                onchange="onCheckTaxCode(this);" />
                            <label class="form-check-label" for="noTaxCode">
                                {{ __('i do not have tax code') }}
                            </label>
                        </div>
                        <script>
                            function onCheckTaxCode(checkbox){
                                document.getElementById('tax_code').disabled = checkbox.checked;
                                document.getElementById('form-tax-code').hidden = checkbox.checked;
                            }
                        </script>
                        <div class="mb-3" id="form-tax-code" @if(old('noTaxCode')) hidden @endif>
                            <label class="form-label">
                                {{ __('tax code') }}
                                <i class="fas fa-info-circle">
                                </i>
                                <span class="text-danger">
                                    *
                                </span>
                            </label>
                            <input class="form-control" name="tax_code" id="tax_code" required type="text"
                                @disabled(old('noTaxCode')) value="{{ old('tax_code') }}" />
                        </div>
                        <button class="btn btn-block" type="submit">
                            {{ __('register') }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="info-section">
                    <img alt="Promotional banner" class="img-fluid mb-4 w-100"
                        src="https://storage.googleapis.com/a1aa/image/ZeKQUXk4SeuBy0qE8pOdPWnLYJM9tDg8ZKWIRarefRc6lg2PB.jpg" />
                    <h2>
                        NHÂN SỰ THEO CÁCH HOÀN TOÀN MỚI!
                    </h2>
                    <p>
                        Xây dựng thương hiệu hiệu quả
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
