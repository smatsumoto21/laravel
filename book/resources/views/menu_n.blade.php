@extends("layouts.base")
@section("title")メニュー画面：総務@endsection
@section("body")
    <h1>メニュー画面：一般</h1><br><br>

        <a href="/review_list" class="btn btn-secondary" style="width: 200px; padding: 10px;">レビュー管理</a><br><br>
        <a href="/book_list" class="btn btn-secondary" style="width: 200px; padding: 10px;">書籍検索</a><br><br>
        
    <!-- <a href="/my_review">
        <button  class="btn btn-primary" style="width: 200px; padding: 10px;">レビュー管理</button>
    </a><br><br>
    <a href="/book_list">
        <button  class="btn btn-primary" style="width: 200px; padding: 10px;">書籍検索</button>
    </a><br><br> -->
@endsection