<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Book;
use App\Models\Review;

class DbController extends Controller{

//////////////////////////////　共通　////////////////////////////// 

    // ◆ログイン処理：【index】→【menu_s】
    //                        →【menu_n】
    public function login(Request $req){

        // 入力idを変数に保管
        $login_id = $req -> login_id;
        $pass = $req -> pass;
        
        // 入力内容(login_id)(pass)と一致するレコードをemployeesテーブルから取得
        $employee = Employee::where("login_id",$login_id) -> where("pass",$pass) -> first();
        $authority_employee = $employee->department->authority_employee; 
        $authority_book = $employee->department->authority_book;

        // DBと照合成功
        if($employee){
            // 社員ID・パスOKならセッション保持
            session([
                "login_id" => $login_id,
                "authority_employee" => $authority_employee,
                "authority_book" => $authority_book,
                "employee_id" => $employee->id,
                "department_id" => $employee->department_id
            ]);
            // 総務メニュー
            if ($employee->department_id == 2) {
                return view('menu_s');

            // 一般社員メニュー
            } elseif ($employee->department_id == 1) {
                return view('menu_n');

            // 部署情報取得失敗
            }else { 
                // 社員ID・パスはOKだが「department_id」が存在しない
                return redirect('/index')->with(['error' => '未登録の部署です']);
            }
        // 松本：DBと照合失敗
        }else{
        // 社員ID・パス間違い
            return redirect('/index')->with(['error' => '社員IDまたはパスワードが間違っています']);
        }
    }
    
    // ◆ログアウト処理：【*】→【index】
    public function logout(Request $req){
        $req->session()->flush();   // セッション全破棄
        return redirect('/index');
    }
    
    // ◆メニューへ：【*】→【menu_s】【menu_n】
    public function menu(){

        // 総務メニュー
        if(session("department_id") == 2){
            return view('menu_s');

        // 一般社員メニュー
        }elseif(session("department_id") == 1){
            return view('menu_n');

        // 情報取得失敗
        }else{
            session(['error' => '該当する部署メニューがありません']);
            return redirect('/index');
        }
    }

    // ◆書籍検索へ：【*】→【book_list】
    public function book_list(){

        // booksテーブルの全件(列・行)取得 with 追加取得したい列(レビュー数・平均評価)
        $data = [
            "records" => Book::withCount('reviews')     // レビュー数：列名「reviews_count」で入る
            ->withAvg('reviews', 'evaluation')          // 平均評価：列名「reviews_avg_evaluation」で入る
            ->get()
        ];
        return view("book_list",$data);
    }

    // ◆書籍情報へ：【book_list/書籍タイトル】→【book_info】
    public function book_info($book_id){ // 引数で「book_id」入手
        $book = Book::withCount('reviews')
            ->withAvg('reviews', 'evaluation')
            ->with('reviews.employee')                  // レビューを書いたemployeeのテーブルを取得
            ->findOrFail($book_id);

        return view('book_info', ['book' => $book]);
    }

    //////////////////////////////　レビュー　////////////////////////////// 
    // ◆レビュー新規へ：【book_info/この本へのレビュー投稿】→【review_register】
    public function review_register($book_id) // 引数で「book_id」入手
    {
        $book = Book::find($book_id); // books内の該当レコードを取得

        if (!$book) { // 引数で指定された「book_id」レコードが存在しない→書籍検索画面へリダイレクト
            return redirect('/book_list')->with(['error' => '書籍が見つかりませんでした']); // フラッシュセッション
        }
        return view('review_register', ["book" => $book]);
    }
    
    // ◆レビュー登録確認へ(新規)：【review_register】→【review_insert_confirm】
    public function review_insert_confirm(Request $req){

        // バリデーション
        $req->validate([
            'evaluation' => 'required|integer|min:1|max:5', // 整数(1-5)・必須入力
            'comment' => 'required|string|max:1000'         // 1000文字以内の文字列・必須入力
        ]);

        // セッション
        $evaluation = $req->evaluation;
        $comment = $req->comment;
        $book_id = $req->book_id;
        $employee_id = session("employee_id");
        
        $data = [
            "evaluation" => $evaluation,
            "comment" => $comment,
            "book_id" => $book_id,
        ];
        return view('review_insert_confirm', $data);
    }
    
    // ◆レビュー編集へ：【book_info/自分のレビューから】→【review_edit】
    public function review_edit($id){    // 引数で「review_id」入手
        $review = Review::find($id);    // reviews内の該当レコードを取得
        $review_id = $id;               // 編集時はreview_idを持つ

        if (!$review) { // 引数で指定されたreview_idレコードが存在しない→書籍検索画面へリダイレクト
            return redirect('/book_list')->with(['error' => 'レビューが見つかりませんでした']); // フラッシュセッション
        }

        $book = Book::find($review->book_id); // 引数で指定されたreview_idレコードに紐づくbookレコード取得
        $data = [
                "review_id" => $review_id,
                "review" => $review,
                "book" => $book
            ];
        return view('review_edit', $data);
    }

    // ◆レビュー登録確認へ(更新)：【review_edit】→【review_insert_confirm】
    public function review_edit_confirm(Request $req){
        // バリデーション
        $req->validate([
            'evaluation' => 'required|integer|min:1|max:5', // 整数(1-5)・必須入力
            'comment' => 'required|string|max:1000' // 1000文字以内の文字列・必須入力
        ]);

        $evaluation = $req->evaluation;
        $comment = $req->comment;
        $book_id = $req->book_id;
        $review_id = $req->review_id;
        $employee_id = session("login_id");
        
        $data = [
            "evaluation" => $evaluation,
            "comment" => $comment,
            "book_id" => $book_id,
            "review_id" => $review_id,
            "employee_id" => $employee_id
        ];
        return view('review_insert_confirm', $data);  
    }

    // ◆レビュー登録(新規)：【review_insert_confirm】→【review_insert_success】【review_insert_failure】
    public function review_insert(Request $req) {

        // 「book_id」と「employee_id」がDBに存在するかチェック
        $book_id_exists = Book::where('id', $req->book_id)->exists();
        $employee_id_exists = Employee::where('id', session("employee_id"))->exists();

        if ($book_id_exists && $employee_id_exists) { // 両方存在→成功画面へ

            // 新規作成
            $review = new Review();
            $review->employee_id = session("employee_id");
            $review->book_id = $req->book_id;
            $review->evaluation = $req->evaluation;
            $review->comment = $req->comment;
            $review->save();
            return redirect('/review_insert_success')->with(['book_id' => $req->book_id]);
            
        }else{
            return redirect('/review_insert_failure')
            ->with(['error' => "ここ"."　book_id=".$req->book_id."　login=id=".session("login_id")]);
        }
    }

    // ◆レビュー更新：
    public function review_update(Request $req) {
    
        // バリデーション入れると確認画面にエラー文付きで差し戻される
        try{
            $bookExists = Book::where('id', $req->book_id)->exists();
            $employeeExists = Employee::where('id', session("employee_id"))->exists();

            if (!$bookExists || !$employeeExists) {
                return redirect('/review_insert_failure')->with('error', '指定したデータが存在しません。'); // 存在しない
            }

            $review = Review::find($req->review_id);
            $review->evaluation = $req->evaluation;
            $review->comment = $req->comment;
            $review->save();

            return redirect('/review_insert_success');

            } catch (\Exception $e) {
                \Log::error('レビュー登録エラー: ' . $e->getMessage()); // ログにエラー記録
                return redirect('/review_insert_failure')->with('error', 'レビューの登録に失敗しました。'); // 失敗画面へ
        }

    }


//////////////////////////////　書籍　////////////////////////////// 

    // ◆書籍登録(処理なし)
    public function book_register(){}

    // ◆書籍登録確認へ(新規)：【book_registert】→【book_insert_confirm】
    public function book_insert_confirm(Request $req){

        // バリデーション
        $req->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'publisher' => 'required|string|max:100',
            'isbn' => 'required||digits:13|unique:books,isbn,'
        ]);

        // セッション
        $title = $req->title;
        $author = $req->author;
        $publisher = $req->publisher;
        $isbn = $req->isbn;

        $data = [
            "title" => $title,
            "author" => $author,
            "publisher" => $publisher,
            "isbn" => $isbn
        ];
        return view("book_insert_confirm", $data);
    }

    // ◆書籍情報編集へ：【book_info】→【book_edit】
    public function book_edit($id){

        $book = Book::find($id); // books内の該当レコードを取得

        if (!$book) { // 引数で指定されたbook_idレコードが存在しない→書籍検索画面へリダイレクト
            return redirect('/book_list')->with(['error' => '書籍が見つかりませんでした']); // フラッシュセッション
        }
        return view('book_edit', ["book" => $book]);
    }


    // ◆書籍登録確認へ(更新)：【book_edit】→【book_insert_confirm】
    public function book_edit_confirm(Request $req){

        // バリデーション
        $req->validate([ // 編集対象の本自身の「isbn」は存在してても弾かない
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'publisher' => 'required|string|max:100',
            'isbn' => 'required||digits:13|unique:books,isbn,'. $req->book_id,
        ]);

        // セッション
        $title = $req->title;
        $author = $req->author;
        $publisher = $req->publisher;
        $isbn = $req->isbn;

        $data = [
            "title" => $title,
            "author" => $author,
            "publisher" => $publisher,
            "isbn" => $isbn
        ];
        return view("book_insert_confirm", $data);
    }

    // ◆書籍登録(新規・更新)：【book_insert_confirm】→【book_insert_success】【book_insert_failure】
    public function book_insert(Request $req){ 
        
        // バリデーション入れると確認画面にエラー文付きで差し戻される
        try{
            if ($req->filled('book_id')) { // $reqの中に「book_id」が含まれる→更新
                $book = Book::find($req->book_id);

                if (!$book) {
                    return redirect('/book_insert_failure'); // 不正なbook_id(存在しない)
                }
                
                // isbnが他の本と重複していないかチェック
                $exists = Book::where('isbn', $req->isbn)
                          ->where('id', '!=', $req->book_id)
                          ->exists();

                if ($exists) {
                    return redirect('/book_insert_failure')->with('error', 'ISBNが他の書籍と重複しています');
                }

            } else { // $reqの中に「book_id」が含まれない→新規
                $exists = Book::where('isbn', $req->isbn)->exists();

                if ($exists) {
                    return redirect('/book_insert_failure')->with('error', 'ISBNが他の書籍と重複しています');
                }

                $book = new Book();
            }

            // 共通の代入処理(新規・更新)
            $book->title = $req->title;
            $book->author = $req->author;
            $book->publisher = $req->publisher;
            $book->isbn = $req->isbn;
            $book->save();

        } catch (\Exception $e) {
            \Log::error('書籍登録エラー: ' . $e->getMessage()); // ログにエラー記録
            return redirect('/book_insert_failure')->with('error', '書籍の登録に失敗しました。');; // 失敗画面へ
        }
        return redirect('/book_insert_success'); // 成功画面へ
    }

//////////////////////////////　社員　//////////////////////////////
    // ◆社員登録確認へ(新規)：【emp_registert】→【emp_insert_confirm】
    public function emp_insert_confirm(Request $req)
    {
        // バリデーション
        $req->validate([
            'login_id' => 'required|string|max:255',
            'pass' => 'required|string|max:100',
            'department_id' => 'required|min:1',
        ]);

        // セッション
        $login_id = $req->login_id;
        $pass = $req->pass;
        $department_id = $req->department_id;
        $dep_name = Department::find($req->department_id)?->name ?? '不明';

        $data = [
            "login_id" => $login_id,
            "pass" => $pass,
            "department_id" => $department_id,
            "dep_name" => $dep_name
        ];
        return view("emp_insert_confirm", $data);
    }

}
