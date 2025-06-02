<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
        crossorigin="anonymous">
    <style>
        body {
            width: 800px;
            margin: 10px auto;
        }
        label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }

        input {
            width: 200px;
        }
    </style>
</head>

<body>
    <h1>ログイン画面</h1>
    <form action="/login" method="POST">
        @csrf
        <p><label for="login_id">社員ID</label>：<input type="text" id="login_id" name="login_id" required></p>
        <p><label for="pass">パスワード</label>：<input type="password" id="pass" name="pass" required></p>
        <button type="submit" class="btn btn-primary">ログイン</button>
    </form>

    @if (session("error"))
    <br><br><br>
    <p style="color: red;">{{ session("error") }}</p>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>

</body>

</html>