<html>

<head>
    <title>{{ __('register page') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .login-container h2 {
            margin-bottom: 20px;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    @include('layouts.include.alert')
    <div class="login-container">
        <h2 class="text-center">
            {{ __('register') }}
        </h2>
        <form method="POST" action="{{ route('candidate.check_register') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">
                    {{ __('email') }}
                </label>
                <input type="email" class="form-control" name='email' id="email"
                    placeholder="{{ __('enter your email') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">
                    {{ __('password') }}
                </label>
                <input type="password" class="form-control" name='password' id="password"
                    placeholder="{{ __('enter your password') }}" required>
            </div>
            <div class="mb-3 text-primary">
                <a href="{{ route('candidate.login') }}">
                    {{ __('already have an account?') }}
                </a>
            </div>
            <button type="submit" class="btn btn-primary">
                {{ __('register') }}
            </button>
        </form>
    </div>
</body>

</html>
