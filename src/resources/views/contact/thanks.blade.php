<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact-form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
</head>

<body>
    <div class="main">
        <div class="background">
            <p>Thank you</p>
        </div>
        <div class="center">
            <div class="text">
                <p>お問い合わせありがとうございました</p>
            </div>
            <a href="{{ route('contact.index') }}" class="home-button">HOME</a>
        </div>
    </div>
</body>
</html>