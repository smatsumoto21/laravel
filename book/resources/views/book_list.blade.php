@extends("layouts.base")
@section("title")書籍検索@endsection
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
    <h1>書籍検索</h1>

@if(session("error"))
    <p style="color: red;">{{ session("error") }}</p>
@endif

    <form action="/emp_keyword_search" method="POST">
        <p><label for="keyword">検索ワード</label>：　<input type="text" id="keyword" name="keyword" required></p>
        <button type="submit" class="btn btn-primary">検索</button>
    </form>

    <table class="table">
        <tr>
            <th>タイトル</th>
            <th>著者</th>
            <th>出版社</th>
            <th>コメント件数</th>
            <th>平均評価</th>
            <th>登録日</th>
        </tr>
@foreach($records as $record)<!-- $records = Book::全列＋レビュー数＋平均評価 -->
        <tr>
            <td><a href="/book_info/{{ $record->id }}">{{ $record -> title }}</a></td>
            <td>{{ $record -> author }}</td>
            <td>{{ $record -> publisher }}</td>
            <td>{{ $record -> reviews_count }}</td>
            <td>{{ number_format($record->reviews_avg_evaluation, 1) }} 点</td>
            <td>{{ $record -> created_at }}</td>
        </tr>
@endforeach
    </table>

    <br><br><br>
    <p><a href="/menu">メニュー画面へ戻る</a></p>
@endsection