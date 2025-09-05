<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ __('employer registration rejected') }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h1>{{ __('employer registration rejected') }}</h1>
    <p>{{ __('dear') }} {{ $name }},</p>
    <p>{{ __('we regret to inform you that your registration as an employer has been rejected for the following reason') }}:</p>
    <p><strong>{{ $description ?? __('no')." ".__('description') }}</strong></p>
    <br>
    <p>{{ __('please review the provided details and ensure all requirements are met before reapplying') }}.</p>
    <p>{{ __('if you have any questions or need further assistance, feel free to contact our support team') }}.</p>
    <p>{{ __('thank you for your understanding') }}.</p>
    <br>
    <p>{{ __('best regards') }},</p>
    <p>{{ __('the recruitment team') }}</p>
</body>
</html>