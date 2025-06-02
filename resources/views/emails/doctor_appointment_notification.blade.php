<!DOCTYPE html>
<html>

<head>
    <title>New Appointment Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f7;
            color: #333;
        }

        .email-wrapper {
            width: 100%;
            padding: 20px;
            background-color: #f4f4f7;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .email-body {
            padding: 20px;
        }

        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            padding: 10px;
            border-top: 1px solid #eee;
        }

        .appointment-details {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="email-header">
                <img src="https://portal.bouesti.edu.ng/files/images/ccoeikere.png" alt="Logo" style="max-height: 50px;">
                <h1>New Appointment Request</h1>
            </div>
            <div class="email-body">
                <p>Hey 👋 Doctor,</p>
                <p>You have a new appointment request from <strong>{{ $appointment->user->name }}</strong>.</p>

                <div class="appointment-details">
                    <p><strong>Urgency:</strong> {{ $appointment->appointment_urgency }}</p>
                    <p><strong>Reason:</strong> {{ $appointment->reason }}</p>
                    <p><strong>Notes:</strong> {{ $appointment->notes ?: 'No additional notes' }}</p>
                </div>

                <p>Please log in to the system to review and respond to this request.</p>
                <p>Best regards,<br>{{ config('app.name') }} Health Services Team</p>
            </div>
            <div class="email-footer">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>