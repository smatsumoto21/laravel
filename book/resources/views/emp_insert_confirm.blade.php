@extends("layouts.base")
@section("title")社員登録：確認@endsection
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
    <h1>以下の内容で登録しますか？</h1>

    <p><label>社員ID</label>：　{{ $login_id }}</p>
    <p><label>パスワード</label>：　{{ $pass }}</p>
    <p><label>部署</label>：　{{ $dep_name }}</p>

    <br><br><br><br>

    <form action="/emp_insert" method="POST">
        @csrf
        <input type="hidden" name="login_id" value="{{ $login_id }}"></p>
        <input type="hidden" name="pass" value="{{ $pass }}"></p>
        <input type="hidden" name="department_id" value="{{ $department_id }}"></p>
        @if(isset($emp_id))
            <input type="hidden" name="emp_id" value="{{ $emp_id }}">
        @endif
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
    
    <br>
    <button type="button" class="btn btn-danger" onclick="history.back()">キャンセル</button>　　　　　

@endsection