<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f3f3f3;
            color: #333;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        .content {
            padding: 40px 30px;
        }

        .content p {
            margin: 0 0 20px;
            font-size: 18px;
            line-height: 1.6;
        }

        .footer {
            padding: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="content">
        <p>{{ $content }}</p>
    </div>
    <div class="footer">
        <p>このメールは自動送信されています。ご不明点があればお問い合わせください。</p>
    </div>
</body>

</html>
