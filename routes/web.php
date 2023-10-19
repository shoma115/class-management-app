<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassDatumController;
use App\Http\Controllers\CreditedClassController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\NiceController;
use App\Http\Controllers\QuestionNiceController;
use App\Http\Controllers\AnswerNiceController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
// トップページを表示するルーティング
Route::get('/', [ClassDatumController::class, 'read'])->middleware('auth')->name('index');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth')->name('home');


// マイページを表示する
Route::get('/mypage', [UserController::class, 'read'])->middleware('auth')->name('mypage.read');
// ユーザー名の更新
Route::patch('/mypage/{user}', [UserController::class, 'update'])->middleware('auth')->name('user.update');
// いいねしたレビューを表示
Route::get('/mypage/review', [UserController::class, 'nice_review'])->middleware('auth')->name('nice.review');
// いいねした質問を表示
Route::get('/mypage/question', [UserController::class, 'nice_question'])->middleware('auth')->name('nice.question');

// 時間割ページを表示するルーティング
Route::get('/classdata', [ClassDatumController::class, 'read'])->middleware('auth')->name('classdata.read');

// 曜日に応じた授業の選択肢を提示、選択後にそれを保存する。
Route::get('/{resource}', [ClassDatumController::class, 'store'])->middleware('auth')->name('select.store');
// 授業の詳細ページを表示数アクション
Route::get('/classdatum/{classdatum}/show', [ClassDatumController::class, 'show'])->middleware('auth')->name('classdata.show');

// updateアクションを起動するルーティング
Route::patch('/classdata/{classdatum}/{task?}', [ClassDatumController::class, 'update'])->middleware('auth')->name('classdata.update');
// taskの削除(nullにupdate)
Route::patch('/task/{classdatum}', [ClassDatumController::class, 'taskupdate'])->middleware('auth')->name('classdata.taskupdate');
// deleteアクションを起動するルーティング
Route::delete('/classdata/{classdatum}', [ClassDatumController::class, 'destroy'])->middleware('auth')->name('classdata.delete');


// ここから履修済み授業一覧ページのルーティング
// 履修済み授業一覧ページのアクションを起動するルーティング
Route::get('/credited/read', [CreditedClassController::class, 'read'])->middleware('auth')->name('credited.read');
// Resourceに保存されている授業一覧を表示
Route::get('/credited/resource/', [CreditedClassController::class, 'select'])->middleware('auth')->name('credited.select');
// store機能を起動するルーティング
Route::get('/credited/{resource}/add', [CreditedClassController::class, 'store'])->middleware('auth')->name('credited.store');
// 時間割にある全ての授業を履修済みにする
Route::get('/credited/migration-all', [CreditedClassController::class, 'migrationAll'])->middleware('auth')->name('credited.migrationAll');
// editを起動するルーティング
Route::get('/credited/{creditedclass}', [CreditedClassController::class, 'edit'])->middleware('auth')->name('credited.edit');
// updateを起動するアクションを起動するルーティング
Route::patch('/credited/{creditedclass}', [CreditedClassController::class, 'update'])->middleware('auth')->name('credited.update');
// destroyアクションを起動するルーティング
Route::delete('/credited/{creditedclass}', [CreditedClassController::class, 'destroy'])->middleware('auth')->name('credited.delete');
// 単位の内訳
Route::get('/needcredit/detail', [CreditedClassController::class, 'needcredit'])->middleware('auth')->name('credited.needcredit');


// 単位取得済み授業に登録後、時間割から授業を削除する
Route::get('/credited/migration/{classdatum}', [CreditedClassController::class, 'migration'])->middleware('auth')->name('credited.migration');
//suggest
Route::post('/credited/suggest/search', [CreditedClassController::class, 'suggest'])->middleware('auth')->name('credited.suggest');


// ここから評価ページのルーティング
Route::get('/review/read', [PostController::class, 'read'])->middleware('auth')->name('review.read');
// レビューのcreateページを表示する
Route::get('/review/create', [PostController::class, 'create'])->middleware('auth')->name('review.create');
// store機能を発動
Route::post('/review/{classdatum}/recostore', [PostController::class, 'recostore'])->middleware('auth')->name('review.recostore');
// store機能を発動
Route::post('/review/create', [PostController::class, 'store'])->middleware('auth')->name('review.store');
// レビューの詳細を見るshowページを表示する
Route::get('/review/{post}', [PostController::class, 'show'])->middleware('auth')->name('review.show');
// レビューの編集画面を開く
Route::get('/review/edit/{post}', [PostController::class, 'edit'])->middleware('auth')->name('review.edit');
// レビューの更新、updateアクションを起動するルーティング
Route::patch('/review/update/{post}', [PostController::class, 'update'])->middleware('auth')->name('review.update');
// レビューの削除を実行するためのルーティング
Route::delete('/review/{post}', [PostController::class, 'destroy'])->middleware('auth')->name('review.delete');
//授業を時間割から履修済みに移動させた際にレビューを求める
Route::get('/review/{classdatum}/recommendation', [PostController::class, 'recommendation'])->middleware('auth')->name('review.recommendation');
// suggest
Route::post('/post/suggest/search', [PostController::class, 'suggest'])->middleware('auth')->name('review.suggest');

// Resource
// 時間割の場所に合わせて授業を抽出するためのルーティング　兼 search
Route::get('/classdata/{week}/{time}/{search?}', [ResourceController::class, 'select'])->where('time', '[0-9]+')->middleware('auth')->name('resource.select');
// リストに無い授業を追加する
Route::get('/create/{week}/{time}', [ResourceController::class, 'create'])->where('time', '[0-9]+')->middleware('auth')->name('resource.create');
// store
Route::post('/resource/{week?}/{time?}', [ResourceController::class, 'store'])->where('time', '[0-9]+')->middleware('auth')->name('resource.store');
// suggest
Route::post('/search/suggest', [ResourceController::class, 'suggest'])->middleware('auth')->name('select.suggest');




// ここからQ&Aへのルーティング
Route::get('/question/read', [QuestionController::class, 'read'])->middleware('auth')->name('question.read');
// 質問作成
Route::get('/question/create', [QuestionController::class, 'create'])->middleware('auth')->name('question.create');
// 作成した質問をDBにstore
Route::post('/question', [QuestionController::class, 'store'])->middleware('auth')->name('question.store');
// スレッドを開く
Route::get('/question/{question}/show', [QuestionController::class, 'show'])->middleware('auth')->name('question.show');
// 質問のedit
Route::get('/question/{question}/edit', [QuestionController::class, 'edit'])->middleware('auth')->name('question.edit');
// 質問の更新
Route::patch('/question/{question}', [QuestionController::class, 'update'])->middleware('auth')->name('question.update');
// 質問の削除
Route::delete('/question/{question}/delete', [QuestionController::class, 'destroy'])->middleware('auth')->name('question.delete');
// suggest
Route::post('/question/search/title', [QuestionController::class, 'suggest'])->middleware('auth')->name('question.suggest');
// 解決済み
Route::get('/question/{question}/{resolved}',[QuestionController::class, 'resolved'])->middleware('auth')->name('question.resolved');
// 自分の質問ページ
Route::get('/question/mine', [QuestionController::class, 'mine'])->middleware('auth')->name('question.mine');


// ここからanswerのルーティング
Route::post('/answer/{question}/store', [AnswerController::class, 'store'])->middleware('auth')->name('answer.store');
// update
Route::patch('/answer/{answer}/{question}/update', [AnswerController::class, 'update'])->middleware('auth')->name('answer.update');
// delete
Route::delete('/answer/{answer}/{question}/delete', [AnswerController::class, 'destroy'])->middleware('auth')->name('answer.delete');

// nice
// いいねをDBへ
Route::post('/nice/post/increace', [NiceController::class,'store'])->name('nice.store');
// いいねを削除
Route::post('/nice/post/decrease', [NiceController::class, 'destroy'])->name('nice.delete');

// QuestionNice
// いいねをDBへ
Route::post('/nice/question/increace', [QuestionNiceController::class,'store'])->name('questionnice.increase');
// いいねを削除
Route::post('/nice/question/decrease', [QuestionNiceController::class, 'destroy'])->name('questionnice.decrease');

// answerNice
// いいねをDBへ
Route::post('/nice/answer/increace', [AnswerNiceController::class,'store'])->name('answernice.increase');
// いいねを削除
Route::post('/nice/answer/decrease', [AnswerNiceController::class, 'destroy'])->name('answernice.decrease');



