<!DOCTYPE html>
<html>

<head>
    <title>{{ __("new application received") }}: {{ $job->name }}</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2c3e50;
            text-align: center;
        }

        .candidate-info {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-top: 20px;
        }

        .candidate-info img {
            max-width: 120px;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
        }

        .candidate-details p {
            margin: 4px 0;
            color: #333;
        }

        .content-section p {
            line-height: 1.6;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h1>{{ __('new application received') }}</h1>
        <div class="content-section">
            <p>{{ __('dear employer') }},</p>
            <p>{{ __('we are pleased to inform you that a new candidate has applied for the position you posted') }}.</p>
            <p>{{ __('thank you for using our recruitment services') }}.</p>
            <p>{{ __('best regards') }},</p>
            <p>{{ __('your recruitment team') }}</p>
        </div>

        <hr>

        <!-- Ứng viên: hình ảnh + thông tin -->
        <div class="candidate-info">
            <img src="{{ url($candidate->image) }}" alt="Candidate Image">
            <div class="candidate-details">
                <p><strong>{{ __('candidate name') }}:</strong> {{ $candidate->name }}</p>
                <p><strong>{{ __('candidate email') }}:</strong> {{ $candidate->email }}</p>
                <p><strong>{{ __('candidate phone') }}:</strong> {{ $candidate->phone }}</p>
                <p><strong>{{ __('job title') }}:</strong> {{ $job->name }}</p>
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('employer.jobs.show', $job->id) }}" 
            style="background-color: #3498db; 
                    color: white; 
                    padding: 12px 24px; 
                    text-decoration: none; 
                    border-radius: 6px; 
                    font-weight: bold; 
                    display: inline-block;">
                {{ __('View Candidate Details') }}
            </a>
        </div>
    </div>
</body>

</html>
