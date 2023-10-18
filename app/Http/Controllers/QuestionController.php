<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function read(Request $request, Question $question) {
        $keryword = $request->input('search');
        $result =  Question::where('title', 'LIKE', "%$keryword%");
        $questions = $result->paginate(15);

        $collection = DB::table('question_nices')->get();
        $groupBy = $collection->groupBy('question_id');
        $sumNice = $groupBy->map(function ($count_nice) {
           
            return $count_nice->sum('count');
        });

        return view('question.read', ['questions' => $questions, 'sum_nice' => $sumNice, 'group_by' => $groupBy, 'my_question' => false]);
    }
    // 質問作成ページの表示
    public function create() {
        return view('question.create');
    }
    // 質問のstoreアクション
    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $question = new Question();
        $question->title = $request->input('title');
        $question->content = $request->input('content');
        $question->user_id = Auth::id();
        $question->comments = 0;
        $question->save();

        return redirect()->route('question.read');
    }
    // スレッドを開く
    public function show(Question $question) {
        $answers = $question->answers;

        $collection = DB::table('answer_nices')->get();
        $groupBy = $collection->groupBy('answer_id');
        $sumNice = $groupBy->map(function ($count_nice) {
           
            return $count_nice->sum('count');
        });
        
        return view('question.show', ['question' => $question, 'answers' => $answers, 'sum_nice' => $sumNice, 'group_by' => $groupBy]);
    }
    // 質問のeditアクション
    public function edit(Question $question) {
        return view('question.edit', compact('question'));
    }
    // 質問のupdate action
    public function update(Question $question, Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        $question->title = $request->input('title');
        $question->content = $request->input('content');
        $question->user_id = Auth::id();
        $question->save();

        return redirect()->route('question.show', $question);
    }

    public function destroy(Question $question) {
        $question->delete();

        return redirect()->route('question.read');
    }

    // suggest
    public function suggest() {
        $search_word = request()->get('search');
      
        $data = DB::table('questions')->where('title', 'LIKE', "%$search_word%")->get();
        $suggest = [];
        
        foreach($data as $datum) {
            $suggest_array_count = count($suggest);
            $suggest[$suggest_array_count] = $datum->title; 
        }
                
        return response()->json(['suggest' => $suggest]);
    }

    // resolved
    public function resolved(Question $question, $resolved) {
        if((int)$resolved === 0) {
            $question->resolved = true;
            $question->save();

            return redirect()->route('question.show', $question);
        } elseif((int)$resolved === 1) {
            $question->resolved = false;
            $question->save();

            return redirect()->route('question.show', $question);
        }

    }
    
    // mine
    public function mine(Request $request) {
        $keryword = $request->input('search');
        $id = Auth::id();
        $result =  Question::where('title', 'LIKE', "%$keryword%")->where('user_id', "$id");
        $questions = $result->paginate(15);

        $collection = DB::table('question_nices')->get();
        $groupBy = $collection->groupBy('question_id');
        $sumNice = $groupBy->map(function ($count_nice) {
           
            return $count_nice->sum('count');
        });

        return view('question.read', ['questions' => $questions, 'sum_nice' => $sumNice, 'group_by' => $groupBy, 'my_question' => true]);

    }
    
}
