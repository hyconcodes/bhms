<!DOCTYPE html>
<html>

<head>
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

        .email-header img {
            max-height: 50px;
        }

        .email-body {
            padding: 20px;
        }

        .email-footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            padding: 10px;
        }

        .btn {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px 0;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .text-muted {
            color: #777;
        }
    </style>
</head>

<body>
    <div class="email-wrapper">
        <div class="email-content">
            <div class="email-header">
                <img src="https://portal.bouesti.edu.ng/files/images/ccoeikere.png" alt="Logo">
                <h1>Welcome to {{ config('app.name') }}</h1>
            </div>
            <div class="email-body">
                <p>Hi <strong>{{ $name }}</strong>,</p>
                <p>You have been assigned the role of <strong>{{ $role }}</strong>.</p>
                <p>To get started, please reset your password by clicking the button below:</p>
                <p>
                    <a href="{{ $resetPasswordUrl }}" class="btn">Reset Password</a>
                </p>
                <p class="text-muted">If you did not expect this email, you can safely ignore it.</p>
                <p>Best regards,</p>
                <p>The {{ config('app.name') }} Team</p>
            </div>
            <div class="email-footer">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>