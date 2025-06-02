@extends("layouts.base")
@section("title")レビュー登録：成功@endsection
@section("body")
    <h1>レビューを登録しました</h1><br><br>

    <br><br><br><br>

    <br><br><br>
    <p><a href="/book_info/{{ session('book_id') }}">書籍情報へ戻る</a></p>
    <p><a href="/book_list">書籍検索へ</a></p>
    <p><a href="/menu">メニュー画面へ戻る</a></p>
@endsection