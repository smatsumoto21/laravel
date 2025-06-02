@extends("layouts.base")
@section("title")書籍情報@endsection
@section("body")

    <!-- 総務メニューテーブル -->
    @if(session('department_id') && session('department_id') === 2)
        <table>
            <tr>
                <!-- タイトル -->
                <td><h1>書籍情報</h1></td>
                <td>　</td>
                <td>
                    <a href="/book_edit/{{ $book->id }}" class="btn btn-primary">書籍の編集</a>
                </td>
                <td>
                    <a href="/book_delete_confirm/{{ $book->id }}" class="btn btn-danger">書籍の削除</a>　　　
                </td>
            </tr>
        </table>
        @else
        <!-- タイトル -->
        <h1>書籍情報</h1>
    @endif

    <!-- 本の情報 -->
    ここに本の画像
    <table class="table">
        <tr><th>タイトル</th><td>{{ $book->title }}</td></tr>
        <tr><th>著者</th><td>{{ $book->author }}</td></tr>
        <tr><th>出版社</th><td>{{ $book->publisher }}</td></tr>
        <tr><th>コメント件数</th><td>{{ $book->reviews_count }}</td></tr>
        <tr><th>平均評価</th><td>{{ number_format($book->reviews_avg_evaluation, 1) }} 点</td></tr>
        <tr><th>登録日</th><td>{{ $book->created_at }}</td></tr>
    </table>

    <a href="/book_list">書籍検索画面へ戻る</a>
    <a href="/menu">メニュー画面へ戻る</a><br><br><hr><br>

    <!-- 本のレビュー -->
    <table>
        <tr>
            <td>
                <h2>レビュー一覧</h2>
            </td>
            <td>　</td>
            <td>
                <a href="{{ route('review_register', ['book_id' => $book->id]) }}">
                    レビューを書く
                </a>
            </td>
        </tr>
    </table>


    @if($book->reviews->isNotEmpty())
        <table class="table">
            <thead>
                <tr>
                    <th>評価</th>
                    <th>コメント</th>
                    <th>投稿日</th>
                    <th>コマンド</th>
                </tr>
            </thead>
            <tbody>
                @foreach($book->reviews as $review)
                    <tr>
                        <td>
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($review->evaluation >= $i)
                                    ★
                                @else
                                    ☆
                                @endif
                            @endfor
                            （{{ $review->evaluation }}点）
                        </td>
                        <td style="white-space: pre-wrap; word-break: break-word; max-width: 400px;">
{{ $review->comment }}
                        </td>
                        <td>{{ $review->created_at }}</td>
                        <td>
                            @if(session('employee_id') && session('employee_id') === $review->employee_id)
                            <a href="/review_edit/{{ $review->id }}">編集</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>レビューはまだありません。</p>
    @endif
        <a href="/book_list">書籍検索画面へ戻る</a>
        <a href="/menu">メニュー画面へ戻る</a>
@endsection
