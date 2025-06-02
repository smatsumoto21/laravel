@extends("layouts.base")
@section("title")書籍登録：入力@endsection
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
    <h1>書籍情報の入力</h1>

    <form action="/book_insert_confirm" method="POST">
        @csrf
        <p><label for="title">タイトル</label>：　<input type="text" id="title" name="title" required></p>
        <p><label for="author">著者</label>：　<input type="text" id="author" name="author" required></p>
        <p><label for="publisher">出版社</label>：　<input type="text" id="publisher" name="publisher" required></p>
        <p><label for="isbn">ISBN</label>：　<input type="text" id="isbn" name="isbn" required></p>

        <br><br>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>

    <br><br><br>
    <p><a href="/menu">メニュー画面へ戻る</a></p>
@endsection