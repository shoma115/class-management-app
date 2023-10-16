
@extends('layouts.app')
    @section('content')
   
        <a href="{{ route('mypage.read') }}">
            <a  class="btn btn-secondary rounded-pill ms-3" href="{{ route('mypage.read') }}">戻る</a>
        </a>
        <div>
            <h3 class="fw-bold m-4 ">いいねした質問<h3>
        </div>
        <div>
            <table class="table">
            <tr>
                <th>質問のタイトル</th>
                <th></th>
            </tr>
            @foreach($nices as $nice)
            
                @foreach($questions as $question)
                    @if($question->id === $nice->question_id)
                        <tr>
                            <td class="fs-5">{{ $question->title}}</td>
                            <td><a class="button-all btn text-white rounded-pill m-1 btn-sm" href="{{ route('question.show', $question) }}">質問を開く</a></td>
                        </tr>
                
                    @endif
                @endforeach
            @endforeach
            </table>
        </div>
       @endsection