@extends("layouts.base")
@section("title")レビュー新規：入力@endsection
@section("head")
    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: start;
        }
        .rating input[type="radio"] {
            display: none;
        }
        .rating label {
            cursor: pointer;
            font-size: 2rem;
            color: #ddd;
        }
        .rating input[type="radio"]:checked ~ label {
            color: gold;
        }
        .rating label:hover,
        .rating label:hover ~ label {
            color: gold;
        }
    </style>
@endsection
@section("body")
    <h1>レビューの投稿</h1>

    <!-- <p><span style="color: blue;">タイトル：{ $book->title }</span></p> -->

    <form action="/review_insert_confirm" method="POST">
        @csrf

        <!-- ⭐ 星の評価 -->
        <label>評価（1～5）:</label><br>
        <div class="rating">
            @for ($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}" name="evaluation" value="{{ $i }}">
                <label for="star{{ $i }}">★</label>
            @endfor
        </div><br>

        <!-- 💬 コメント入力 -->
        <label for="comment">コメント：</label><br>
        <textarea id="comment" name="comment" rows="5" cols="40" placeholder="ここにコメントを入力してください..."></textarea>
        <input type="hidden" name="book_id" value="{{ $book->id }}">

        <br><br>
        <button type="submit" class="btn btn-primary">投稿</button>
    </form>

    <br><br><br>
    <p><a href="/book_info/{{ $book->id }}">書籍情報へ戻る</a></p>
    <p><a href="/menu">メニュー画面へ戻る</a></p>
@endsection