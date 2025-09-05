<!DOCTYPE html>
<html>

<head>
    <title>{{ __('reset password')}}</title>
</head>

<body>
    <h1>{{ __('reset your password')}}</h1>
    <p>{{ __('click the link below to reset your password')}}:</p>
    <a href="{{ $link }}">{{ __('reset password')}}</a>
    <p>{{ __('if you did not request a password reset, please ignore this email')}}.</p>
</body>

</html>
