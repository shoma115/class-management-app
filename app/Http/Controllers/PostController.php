<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ClassDatum;

class PostController extends Controller
{
    // reviewのreadページを表示する
    public function read() {
        $posts = Post::latest()->get();
        return view('post.read', compact('posts'));
    }
    // createページを表示するアクション
    public function create() {
        return view('post.create');
    }
    // store機能を起動するルーティング
    public function store(Request $request) {
        $post = new Post();
        $post->class_name = $request->input('class_name');
        $post->difficulty_level	= $request->input('difficulty_level');
        $post->teacher_name = $request->input('teacher_name');
        $post->class_week_day = $request->input('class_week_day');
        $post->class_time = $request->input('class_time');
       
        $post->amount_credit = $request->input('amount_credit');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('review.read');
    }
    // showアクションを起動するコントローラ
    public function show(Post $post) {
        
        return view('post.show', compact('post'));
    }

    // edit画面を開くアクション
    public function edit(Post $post) {
        return view('post.edit', compact('post'));
    }
    // update機能を実行するアクション
    public function update(Post $post, Request $request) {
        $post->class_name = $request->input('class_name');
        $post->difficulty_level	= $request->input('difficulty_level');
        $post->teacher_name = $request->input('teacher_name');
        $post->class_week_day = $request->input('class_week_day');
        $post->class_time = $request->input('class_time');
        
        $post->amount_credit = $request->input('amount_credit');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('review.show', compact('post'));
    }

    // deleteアクション
    public function destroy(Post $post) {
        $post->delete();

        return redirect()->route('review.read');
    }
    // 授業を履修済みに登録後、レビューを求める画面を表示するアクション
    public function recommendation(ClassDatum $classdatum) {
        return view('post.recommendation', compact('classdatum'));
    }
}
