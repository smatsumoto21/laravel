@extends("layouts.base")
@section("title")レビュー登録：失敗@endsection
@section("body")
    <h1>レビューの登録に失敗しました</h1><br><br>

    @if (session("error"))
        <br><br><br>
        <p style="color: red;">{{ session("error") }}</p>
    @endif

    <br><br><br><br>

    <br><br><br>
    <p><a href="/book_info/{{ session('book_id') }}">書籍情報へ戻る</a></p>
    <p><a href="/book_list">書籍検索へ</a></p>
    <p><a href="/menu">メニュー画面へ戻る</a></p>
@endsection