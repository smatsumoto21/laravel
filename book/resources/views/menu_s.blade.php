@extends("layouts.base")
@section("title")メニュー画面：総務@endsection
@section("body")
    <h1>メニュー画面：総務</h1><br><br>
    
        <a href="/review_list" class="btn btn-secondary" style="width: 200px; padding: 10px;">レビュー管理</a><br><br>
        <a href="/book_list" class="btn btn-secondary" style="width: 200px; padding: 10px;">書籍検索</a><br><br>
        <a href="/book_register" class="btn btn-secondary" style="width: 200px; padding: 10px;">書籍登録</a><br><br>
        <a href="/emp_list" class="btn btn-secondary" style="width: 200px; padding: 10px;">社員検索</a><br><br>
        <a href="/emp_register" class="btn btn-secondary" style="width: 200px; padding: 10px;">社員登録</a><br><br>

    <!-- <a href="/review_list">
        <button  class="btn btn-primary" style="width: 200px; padding: 10px;">レビュー管理</button>
    </a><br><br>
    <a href="/book_list">
        <button  class="btn btn-primary" style="width: 200px; padding: 10px;">書籍検索</button>
    </a><br><br>
    <a href="/book_register">
        <button  class="btn btn-primary" style="width: 200px; padding: 10px;">書籍登録</button>
    </a><br><br>
    <a href="/emp_list">
        <button  class="btn btn-primary" style="width: 200px; padding: 10px;">社員検索</button>
    </a><br><br>
    <a href="/emp_register">
        <button  class="btn btn-primary" style="width: 200px; padding: 10px;">社員登録</button>
    </a><br><br> -->
@endsection