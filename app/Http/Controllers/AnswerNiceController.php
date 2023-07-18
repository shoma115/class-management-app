<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AnswerNice;

class AnswerNiceController extends Controller
{
    // いいねの保存
    public function store() {
        $answer_nice = new AnswerNice();
        $answer_nice->user_id = Auth::id();
        $answer_nice->answer_id = request()->get('answer_id');
        $answer_nice->save();

        $collection = DB::table('answer_nices')->get();
        $groupBy = $collection->groupBy('answer_id');
        $sumNice = $groupBy->map(function ($count_nice) {
            return $count_nice->sum('count');
        });
        
        $str_post_id = (string)request()->get('answer_id');

        return response()->json(['sum_nice' => $sumNice[$str_post_id]]);

    }

    // いいねの削除
    public function destroy() {
        $delete_id = request()->get('delete_id');
        AnswerNice::where('answer_id', $delete_id)->where('user_id', Auth::id())->delete();
        
        $collection = DB::table('answer_nices')->get();
        $groupBy = $collection->groupBy('answer_id');
        $sumNice = $groupBy->map(function ($count_nice) {
            return $count_nice->sum('count');
        });

        $str_post_id = (string)request()->get('delete_id');

        $sumNice_array = $sumNice->toArray();
        // 該当の投稿のいいねが他に存在するかを確認（他にいいねが存在しない（いいね0）の場合、空のコレクションが返されて、「キーが存在しない」とエラーになってしまった。）
        if(array_key_exists($str_post_id, $sumNice_array)) {
            return response()->json(['sum_nice' => $sumNice[$str_post_id]]);
        }else{
            return response()->json(['sum_nice' => 0]);
        }
                
        
    }
}
