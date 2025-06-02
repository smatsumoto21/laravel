@extends("layouts.base")
@section("title")社員登録：入力@endsection
@section("head")
    <style>
        label {
            display: inline-block;
            width: 100px;
            font-weight: bold;
        }

        input {
            width: 200px;
        }
    </style>
@endsection
@section("body")
    <h1>社員情報の入力</h1>

    <form action="/emp_insert_confirm" method="POST">
        @csrf
        <p><label for="login_id">社員ID</label>：　<input type="text" id="login_id" name="login_id" required></p>
        <p><label for="pass">パスワード</label>：　<input type="text" id="pass" name="pass" required></p>
        <!-- <p><label for="department_id">部署</label>：　<input type="text" id="department_id" name="department_id" required></p> -->
        <p><label for="department_id">部署</label>：　
            <select id="department_id" name="department_id" class="form-select" required>
                <option value="">選択してください</option>
                <option value="1">一般</option>
                <option value="2">総務</option>
            </select>
        </p>
        
        <br><br>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>

    <br><br><br>
    <p><a href="/menu">メニュー画面へ戻る</a></p>
@endsection