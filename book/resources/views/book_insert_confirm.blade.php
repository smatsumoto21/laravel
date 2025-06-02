@extends("layouts.base")
@section("title")書籍登録：確認@endsection
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

    <p><label>タイトル</label>：　{{ $title }}</p>
    <p><label>著者</label>：　{{ $author }}</p>
    <p><label>出版社</label>：　{{ $publisher }}</p>
    <p><label>ISBN</label>：　{{ $isbn }}</p>

    <br><br><br><br>

    <form action="/book_insert" method="POST">
        @csrf
        <input type="hidden" name="title" value="{{ $title }}"></p>
        <input type="hidden" name="author" value="{{ $author }}"></p>
        <input type="hidden" name="publisher" value="{{ $publisher }}"></p>
        <input type="hidden" name="isbn" value="{{ $isbn }}"></p>
        @if(isset($book_id))
            <input type="hidden" name="book_id" value="{{ $book_id }}">
        @endif
        <button type="submit" class="btn btn-primary">登録</button>
    </form>

    <br>
    <button type="button" class="btn btn-danger" onclick="history.back()">キャンセル</button>　　　　　

@endsection