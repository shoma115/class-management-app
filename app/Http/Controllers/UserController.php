<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Question;


class UserController extends Controller
{
    public function read() {
        $user = Auth::user();

        return view('user.mypage', compact('user'));
    }

    public function update(Request $request, User $user) {
        $user->name = $request->input('user_name');
        $user->save();

        return redirect()->route('mypage.read');
    }

    public function nice_review() {
        $id = Auth::id();
        $user_name = Auth::user()->name;
        $nices = User::find($id)->nices;
        $posts = Post::latest()->get();
        
        return view('user.nice-review', ['nices' => $nices, 'posts' => $posts, 'user_name' => $user_name]);
    }

    public function nice_question() {
        $id = Auth::id();
        $user_name = Auth::user()->name;
        $nices = User::find($id)->question_nices;
        $questions = Question::latest()->get();
       
        return view('user.nice-question', ['nices' => $nices, 'questions' => $questions, 'user_name' => $user_name]);
    }
}
