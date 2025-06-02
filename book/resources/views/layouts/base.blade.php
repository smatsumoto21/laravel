<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title> @yield("title") </title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
    crossorigin="anonymous">
    <style>
        body{ width:800px; margin:10px auto; }
    </style>

    @yield("head")
    
</head>
<body><!-- 「style="display:inline;"」でログイン名とボタンを改行なしで横並び -->
    @if (!session("login_id"))
        <?php header("Location: /index"); exit; ?>
    @endif

    @if (session("login_id"))
    
        <div style="position: absolute; top: 10px; right: 20px;">
        ログイン中：{{ session('login_id') }} さん<br>
        社員番号：{{ session('employee_id') }} さん<br>
        社員編集権限：{{ session('authority_employee') }} さん<br>
        書籍編集権限：{{ session('authority_book') }} さん
        <form action="/logout" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-primary">ログアウト</button>
        </form>
        </div>
    @endif

    @yield("body")

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>
</body>
</html>