<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassDatumController;
use App\Http\Controllers\CreditedClassController;
use App\Http\Controllers\PostController;

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
// トップページを表示するルーティング
Route::get('/', [ClassDatumController::class, 'index'])->name('index');
// 時間割ページを表示するルーティング
Route::get('/classdata', [ClassDatumController::class, 'read'])->name('classdata.read');
//　時間割に登録する授業の情報を入力するcreateページを表示
Route::get('/classdata/create', [ClassDatumController::class, 'create'])->name('classdata.create');
// createページで入力した情報を元に、テーブルに情報をinsertするstore機能を起動
Route::post('/classdata', [ClassDatumController::class, 'store'])->name('classdata.store');
// editページを表示するアクションを起動するルーティング
Route::get('/classdata/{classdatum}', [ClassDatumController::class, 'edit'])->name('classdata.edit');
// updateアクションを起動するルーティング
Route::patch('/classdata/{classdatum}', [ClassDatumController::class, 'update'])->name('classdata.update');
// deleteアクションを起動するルーティング
Route::delete('/classdata/delete/{classdatum}', [ClassDatumController::class, 'destroy'])->name('classdata.delete');
// 削除前の警告をするアクションを起動するルーティング
Route::get('/classdata/alert/{classdatum}', [ClassDatumController::class, 'alert'])->name('classdata.alert');

// ここから履修済み授業一覧ページのルーティング
// 履修済み授業一覧ページのアクションを起動するルーティング
Route::get('/credited', [CreditedClassController::class, 'read'])->name('credited.read');
// 履修登録済み授業登録createビューを表示するアクションを起動するルーティング
Route::get('/credited/create', [CreditedClassController::class, 'create'])->name('credited.create');
// store機能を起動するルーティング
Route::post('/credited', [CreditedClassController::class, 'store'])->name('credited.store');
// editを起動するルーティング
Route::get('/credited/{creditedclass}', [CreditedClassController::class, 'edit'])->name('credited.edit');
// updateを起動するアクションを起動するルーティング
Route::patch('/credited/{creditedclass}', [CreditedClassController::class, 'update'])->name('credited.update');
// destroyアクションを起動するルーティング
Route::delete('/credited/{creditedclass}', [CreditedClassController::class, 'destroy'])->name('credited.delete');
// 単位取得済み授業に登録後、時間割から授業を削除する
Route::get('/credited/migration/{classdatum}', [CreditedClassController::class, 'migration'])->name('credited.migration');
// 時間割にある全ての授業を履修済みにする
Route::get('/credited/migration', [CreditedClassController::class, 'migrationAll'])->name('credited.migrationAll');

// ここから評価ページのルーティング
Route::get('/review', [PostController::class, 'read'])->name('review.read');
// レビューのcreateページを表示する
Route::get('/review/create', [PostController::class, 'create'])->name('review.create');
// store機能を発動
Route::post('/review/create', [PostController::class, 'store'])->name('review.store');
// レビューの詳細を見るshowページを表示する
Route::get('/review/{post}', [PostController::class, 'show'])->name('review.show');
// レビューの編集画面を開く
Route::get('/review/edit/{post}', [PostController::class, 'edit'])->name('review.edit');
// レビューの更新、updateアクションを起動するルーティング
Route::patch('/review/update/{post}', [PostController::class, 'update'])->name('review.update');
// レビューの削除を実行するためのルーティング
Route::delete('/review/{post}', [PostController::class, 'destroy'])->name('review.delete');
//授業を時間割から履修済みに移動させた際にレビューを求める
Route::get('/review/recommendation/{classdatum}', [PostController::class, 'recommendation'])->name('review.recommendation');





