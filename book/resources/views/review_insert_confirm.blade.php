@extends("layouts.base")
@section("title")レビュー登録：確認@endsection
@section("body")
    <h1>以下の内容で登録しますか？</h1>

    <!-- <p><span style="color: blue;">タイトル：{ $book->title }</span></p> -->

    <p><strong>評価（星）:</strong>{{ str_repeat('★', $evaluation) }}{{ str_repeat('☆', 5 - $evaluation) }}（{{ $evaluation }} / 5）</p>
    <p><strong>コメント:</strong>{{ $comment }}</p>
    <p>確認用：book_id={{ $book_id}}</p>

    @if(isset($review_id))
        <p>確認用：review_id={{ $review_id }}</p>
    @endif

    <br><br><br><br>

    <!-- 新規登録・編集でボタン切り替え -->
    @if(isset($review_id))
        <!-- 更新ボタン -->
        <form action="/review_update/{{ $review_id }}" method="POST">
            @csrf
            <input type="hidden" name="evaluation" value="{{ $evaluation }}">
            <input type="hidden" name="comment" value="{{ $comment }}">
            <input type="hidden" name="book_id" value="{{ $book_id }}">
            @if(isset($review_id))
                <input type="hidden" name="review_id" value="{{ $review_id }}">
            @endif
            <button type="submit" class="btn btn-primary">更新</button>
        </form>

    @else
        <!-- 登録ボタン -->
        <form action="/review_insert" method="POST">
            @csrf
            <input type="hidden" name="evaluation" value="{{ $evaluation }}">
            <input type="hidden" name="comment" value="{{ $comment }}">
            <input type="hidden" name="book_id" value="{{ $book_id }}">
            @if(isset($review_id))
                <input type="hidden" name="review_id" value="{{ $review_id }}">
            @endif
            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    @endif

    <!-- キャンセルボタン ※JavaScript-->
    <br>
    <button type="button" class="btn btn-danger" onclick="history.back()">キャンセル</button>　　　　　

@endsection