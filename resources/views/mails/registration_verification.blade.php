<!DOCTYPE html>
<html>

<head>
    <title>{{ __('registration verification') }}</title>
</head>

<body>
    <h1>{{ __('welcome to our website') }}!</h1>
    <p>{{ __('thank you for registering an account') }}. 
        {{ __('please use the verification code below to complete the registration process') }}:</p>
    <h2>{{ $token }}</h2>
    <p>{{ __('if you did not request this account registration, please ignore this email') }}.</p>
    <p>{{ __('sincerely') }},</p>
    <p>{{ __('support team') }}</p>
</body>

</html>
