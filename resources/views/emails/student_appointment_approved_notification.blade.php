<!DOCTYPE html>
<html>
<head>
    <title>Appointment Approved</title>
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
                <h1>Appointment Approved</h1>
            </div>
            <div class="email-body">
                <p>Dear {{ $appointment->user->name }},</p>
                <div class="appointment-details">
                    <p>Your appointment with Dr. {{ $appointment->doctor->name }} has been approved.</p>
                    <p><strong>Date:</strong> {{ $appointment->appointment_date ? date('F j, Y', strtotime($appointment->appointment_date)) : 'To be determined' }}</p>
                    <p><strong>Time:</strong> {{ $appointment->appointment_time ? date('g:i A', strtotime($appointment->appointment_time)) : 'To be determined' }}</p>
                    <p><strong>Reason:</strong> {{ $appointment->reason }}</p>
                </div>
                <p>Thank you for using this platform.</p>
                <p>Best regards,<br>{{ config('app.name') }} Health Services Team</p>
            </div>
            <div class="email-footer">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
