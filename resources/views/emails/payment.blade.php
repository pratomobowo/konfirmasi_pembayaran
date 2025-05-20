<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notifikasi Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Notifikasi Pembayaran</h1>
    </div>

    <div class="content">
        {!! $content !!}
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
        <p>&copy; {{ date('Y') }} Universitas Sangga Buana. All rights reserved.</p>
    </div>
</body>
</html> 