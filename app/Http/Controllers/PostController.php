<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\ClassDatum;
use Illuminate\Support\Facades\Auth;
use App\Models\Nice;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    // reviewのreadページを表示する
    public function read(Request $request) {     
        $keryword = $request->input('search');
        $result =  Post::where('class_name', 'LIKE', "%$keryword%");
        $posts = $result->latest()->paginate(15);

        $collection = DB::table('nices')->get();
        $groupBy = $collection->groupBy('post_id');
        $sumNice = $groupBy->map(function ($count_nice) {
           
            return $count_nice->sum('count');
        });

        return view('post.read', ['posts' => $posts, 'sum_nice' => $sumNice, 'group_by' => $groupBy]);
    }
    
    // createページを表示するアクション
    public function create() {
        return view('post.create');
    }
    // store機能を起動するルーティング
    public function store(Request $request) {
        $request->validate([
            'class_name' => 'required',
            'difficulty_level' => 'required|integer',
            'interesting' =>  'required|integer',
            'evaluation' =>  'required',
            'attendance' =>  'required',
            'teacher_name' => 'required',
            'class_week_day' => 'required',
            'class_time' => 'required|integer',
            'amount_credit' => 'required|integer',
        ]);
        $post = new Post();
        $post->class_name = $request->input('class_name');
        $post->difficulty_level	= $request->input('difficulty_level');
        $post->teacher_name = $request->input('teacher_name');
        $post->class_week_day = $request->input('class_week_day');
        $post->class_time = $request->input('class_time');
        $post->interesting = $request->input('interesting');
        $post->evaluation = $request->input('evaluation');
        $post->attendance = $request->input('attendance');
       
        $post->amount_credit = $request->input('amount_credit');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
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
        $request->validate([
            'class_name' => 'required',
            'difficulty_level' => 'required|integer',
            'teacher_name' => 'required',
            'interesting' =>  'required|integer',
            'evaluation' =>  'required',
            'attendance' =>  'required',
            'class_week_day' => 'required',
            'class_time' => 'required|integer',
            'amount_credit' => 'required|integer',
        ]);
        $post->class_name = $request->input('class_name');
        $post->difficulty_level	= $request->input('difficulty_level');
        $post->teacher_name = $request->input('teacher_name');
        $post->interesting = $request->input('interesting');
        $post->evaluation = $request->input('evaluation');
        $post->attendance = $request->input('attendance');
        $post->class_week_day = $request->input('class_week_day');
        $post->class_time = $request->input('class_time');
        $post->amount_credit = $request->input('amount_credit');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('review.show', compact('post'));
    }

    // deleteアクション
    public function destroy(Post $post) {
        $post->delete();

        return redirect()->route('review.read');
    }
   

     // 単位取得済みに登録後のレビューrecommendに従って、レビューを記述した際のstore機能を起動するルーティング
     public function recostore(ClassDatum $classdatum, Request $request) {
        $request->validate([
            'class_name' => 'required',
            'difficulty_level' => 'required|integer',
            'teacher_name' => 'required',
            'class_week_day' => 'required',
            'class_time' => 'required|integer',
            'amount_credit' => 'required|integer',
            'interesting' =>  'required|integer',
            'evaluation' =>  'required',
            'attendance' =>  'required',
        ]);
        $classdatum->delete();
        $post = new Post();
        $post->class_name = $request->input('class_name');
        $post->difficulty_level	= $request->input('difficulty_level');
        $post->teacher_name = $request->input('teacher_name');
        $post->interesting = $request->input('interesting');
        $post->evaluation = $request->input('evaluation');
        $post->attendance = $request->input('attendance');
        $post->class_week_day = $request->input('class_week_day');
        $post->class_time = $request->input('class_time');
       
        $post->amount_credit = $request->input('amount_credit');
        $post->content = $request->input('content');
        $post->user_id = Auth::id();
        $post->save();
        
        return redirect()->route('classdata.read');
     }

    //  suggest
    public function suggest() {
        $search_word = request()->get('search');
      
        $data = DB::table('posts')->where('class_name', 'LIKE', "%$search_word%")->get();
        $suggest = [];
        
        foreach($data as $datum) {
            $suggest_array_count = count($suggest);
            $suggest[$suggest_array_count] = $datum->class_name;
        }
                
        return response()->json(['suggest' => $suggest]);
    }
}
