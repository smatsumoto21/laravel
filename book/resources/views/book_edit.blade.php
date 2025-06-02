@extends("layouts.base")
@section("title")書籍登録：編集@endsection
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
    <h1>書籍情報の編集</h1>

    <form action="/book_edit_confirm" method="POST">
        @csrf
        <p><label for="title">タイトル</label>：　<input type="text" id="title" name="title" value="{{ $book->title }}" required></p>
        <p><label for="author">著者</label>：　<input type="text" id="author" name="author" value="{{ $book->author }}" required></p>
        <p><label for="publisher">出版社</label>：　<input type="text" id="publisher" name="publisher" value="{{ $book->publisher }}" required></p>
        <p><label for="isbn">ISBN</label>：　<input type="text" id="isbn" name="isbn" value="{{ $book->isbn }}" required></p>
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <br><br>
        <button type="submit" class="btn btn-primary">登録</button>
    </form>

    <br><br><br>
    <p><a href="/menu">メニュー画面へ戻る</a></p>
@endsection