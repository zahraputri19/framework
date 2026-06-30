<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: #28a745;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 30px;
            text-align: center;
        }

        .otp-code {
            font-size: 36px;
            font-weight: bold;
            letter-spacing: 8px;
            color: #28a745;
            background: #f8f9fa;
            padding: 15px 30px;
            border-radius: 8px;
            display: inline-block;
            margin: 20px 0;
        }

        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            font-size: 12px;
        }

        .warning {
            color: #dc3545;
            font-size: 13px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Verifikasi OTP</h1>
        </div>
        <div class="content">
            <h2>Halo, {{ $name }}!</h2>
            <p>Terima kasih telah mendaftar. Silakan gunakan kode OTP berikut untuk memverifikasi akun Anda:</p>
            <div class="otp-code">{{ $otp }}</div>
            <p>Kode OTP ini berlaku selama <strong>10 menit</strong>.</p>
            <p class="warning">Jika Anda tidak melakukan pendaftaran, abaikan email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Perpustakaan. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
