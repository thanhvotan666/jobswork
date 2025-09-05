<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ __('employer registration approved') }}</title>
</head>
@php
    $link = route('employer.login',['message'=>__('Your recruitment account has been approved! Log in now!')]); 
@endphp
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h1>{{ __('congratulations') }}!</h1>
    <p>{{ __('dear') }} {{ $name }},</p>
    <p>{{ __('we are pleased to inform you that your registration has been approved') }}.</p>
    <p>{{ __('you can now access your account and start using our platform') }}.</p>

    <p>
        <strong>{{ __('click the button below to log in') }}:</strong><br>
        <a href="{{ $link }}" 
           style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">
           {{ __('Log in now') }}
        </a>
    </p>

    <p>{{ __('if you have any questions, feel free to contact us') }}.</p>
    <br>
    <p>{{ __('contact') }}:</p>
    <p>{{ __('name') }}: {{ $customerCare->name }}</p>
    <p>{{ __('email') }}: {{ $customerCare->email }}</p>
    <p>{{ __('phone') }}: {{ $customerCare->phone }}</p>
    <br>
    <p>{{ __('best regards') }},</p>
    <p>{{ __('the team') }}</p>
</body>
</html>

