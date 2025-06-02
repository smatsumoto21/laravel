<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DbController;

// トップ画面
Route::get('/', function () {return view('index');});

// ログイン画面へのリダイレクト
Route::get('/index', function () {return view('index');});

// メニュー画面のリンク先
// Route::get('/review_list', function () {return view('review_list');});       // 自身が投稿したレビュー一覧
Route::get('/book_list', function () {return view('book_list');});              // 書籍一覧
Route::get('/book_register', function () {return view('book_register');});      // 書籍登録(総務)
Route::get('/emp_list', function () {return view('emp_list');});                // 社員一覧(総務)
Route::get('/emp_register', function () {return view('emp_register');});        // 社員登録(総務)

// 共通
Route::post('/login',[DbController::class,'login']);        // メニュー画面へ
Route::post('/logout', [DbController::class, 'logout']);    // ログイン画面へ
Route::get('/menu', [DbController::class, 'menu']);         // メニュー画面へ(戻る)

// 書籍
Route::get('/book_list', [DbController::class, 'book_list']); // 書籍検索へ
Route::get('/book_info/{id}', [DbController::class, 'book_info']); // 書籍情報へ
Route::post('/book_insert_confirm', [DbController::class, 'book_insert_confirm']); // 書籍登録：確認へ
Route::post('/book_edit_confirm', [DbController::class, 'book_edit_confirm']); // 書籍登録：確認へ
Route::post('/book_insert', [DbController::class, 'book_insert']); // 書籍登録：成功or失敗へ
Route::get('/book_delete_confirm/{id}', [DbController::class, 'book_delete_confim']); // 書籍削除：確認へ
Route::get('/book_edit/{id}', [DbController::class, 'book_edit']); // 書籍情報：編集へ
Route::get('/book_insert_success', function () {return view('book_insert_success');}); // 成功画面へ
Route::get('/book_insert_failure', function () {return view('book_insert_failure');}); // 失敗画面へ

// レビュー
Route::get('/review_register/{book_id}', [DbController::class, 'review_register'])->name('review_register');    // レビュー新規：入力へ
Route::get('/review_edit/{id}', [DbController::class, 'review_edit'])->name('review_edit');                     // レビュー編集：入力へ
Route::post('/review_insert_confirm', [DbController::class, 'review_insert_confirm']); // レビュー登録：確認へ
Route::post('/review_edit_confirm', [DbController::class, 'review_edit_confirm']); // レビュー登録：確認へ
Route::post('/review_insert', [DbController::class, 'review_insert']); // レビュー登録：成功or失敗へ
Route::post('/review_update/{review_id}', [DbController::class, 'review_update'])->name('review_update');       // レビュー登録：成功or失敗へ
Route::get('/review_insert_success', function () {return view('review_insert_success');}); // 成功画面へ
Route::get('/review_insert_failure', function () {return view('review_insert_failure');}); // 失敗画面へ

// 社員
Route::post('/emp_insert_confirm', [DbController::class, 'emp_insert_confirm']); // 社員登録：確認へ
Route::post('/emp_insert', [DbController::class, 'emp_insert']); // 社員登録：成功or失敗へ
