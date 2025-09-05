<!DOCTYPE html>
<html>

<head>
    <title>{{ __('Login Verification') }}</title>
</head>

<body>
    <h1>{{ __('Welcome to Our Recruitment Platform') }}!</h1>
    <p>{{ __('Thank you for signing in using your Google account') }}.</p>
    <p>{{ __('Please use the verification code below to complete your login') }}:</p>
    <h2>{{ $token }}</h2>
    <p>{{ __('If you did not initiate this login attempt, please disregard this email') }}.</p>
    <p>{{ __('Best regards') }},</p>
    <p>{{ __('Recruitment Support Team') }}</p>
</body>

</html>
