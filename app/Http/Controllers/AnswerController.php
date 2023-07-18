<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question) {
        $answer = new Answer();
        $answer->content_answer = $request->input('content_answer');
        $answer->question_id = $question->id;
        $answer->user_id = Auth::id();
        $answer->user_name = Auth::user()->name;
        $question->comments++;

        $answer->save();
        $question->save();

        return redirect()->route('question.show', $question);

    }
// update
    public function update(Answer $answer, Question $question, Request $request) {
        $request->validate([
            'content_answer' => 'required',
        ]);
        $answer->content_answer = $request->input('content_answer');
        $answer->save();

        return redirect()->route('question.show', $question);
    }

    // delete
    public function destroy(Answer $answer, Question $question) {
        $answer->delete();
        $question->comments--;
        $question->save();

        return redirect()->route('question.show', $question);
    }
}
