<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.app')
    @section('content')
    @include('modals.modals_question.edit_question')
    @include('modals.modals_question.delete_question')
            <input id="answerNiceIncreaseRoute" type="hidden" value="{{ route('answernice.increase') }}">
            <input id="answerNiceDecreaseRoute" type="hidden" value="{{ route('answernice.decrease') }}">
            <article>
                <a href="{{ route('question.read') }}">
                    <a  class="btn btn-secondary rounded-pill ms-3 mb-2" href="{{ route('question.read') }}">戻る</a>
                </a>
                
                @if($question->user_id === Auth::id())
                        <div class="button-parent">
                            <button type="button" class="btn btn-outline-secondary rounded-pill m-2" id="editQuestion" data-bs-toggle = "modal" data-bs-target = "#editQuestion">>
                                    <img src="{{ asset('edit.img\ブログの投稿、編集アイコン素材.png') }}" width="30">編集
                            </button>
                            
                            @if($question->resolved === 0)
                                <a class="btn btn-outline-secondary rounded-pill m-2" href="{{ route('question.resolved', ['question' => $question, 'resolved' => 0]) }}" role = "button">解決済みにする</a>
                            @elseif($question->resolved === 1)
                                <a class="btn btn-outline-secondary rounded-pill m-2" href="{{ route('question.resolved', ['question' => $question, 'resolved' => 1]) }}" role = "button">未解決に戻す</a>
                            @endif
                            <button type="button"  class="btn btn-outline-secondary rounded-pill m-2" data-bs-toggle = "modal" data-bs-target = "#deleteQuestion">
                                <img src="{{ asset('delete.img\trash-can_115312.png') }}" width="20">&thinsp;<span style="color: red">削除</span>
                            </button>
                        </div>
                    
                @endif
                <div id = "questionBody">

                    <div class="card">
                        
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                @if($question->resolved === 1)
                                    <div>
                                        <img class="m-2" src="{{asset('resolved.img/23926895.png')}}" width="50" height="50">
                                    </div>
                                @endif
                                <h5>質問者:&ensp;{{ $question->user->name}}</h5>                   
                                <h1 class="fw-bold">{{ $question->title }}</h1>
                                <h3>内容:</h3>
                                <p>{{ $question->content }}</p>
                            </li>
                        </ul>
                    </div>
                </div> 
                <form action = "{{ route('answer.store', $question) }}" method = "post">
                    @csrf
                    <div class = "form-floating">
                        <textarea class = "form-control" placeholder = "回答を入力" id = "floatingTextarea2" style = "height:50px" name="content_answer"></textarea>
                        <label for = "floatingTextarea">返信を入力</label>
                    </div>
                    <div class="text-end pr-2">
                        <button id = "submit" type = "submit" class = "btn btn-default pr-2" disabled><img src = "{{ asset('answer.img/ei-send.png') }}"  width = "30" height = "25" alt = "送信">送信</button>
                    </div>
                </form>
                
                <h5 class="m-1 fw-bold">返信一覧</h5>
                 <!-- 回答を全て表示 -->
                @foreach($answers as $answer)
                    <!--　回答の削除のモーダル -->
                    @include('modals.modals_answers.delete_answer')
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <!-- 回答のuser_idとログイン中のユーザのIDが一致したときのみ編集メニューを表示させる -->
                                <div class="default">
                                    @if($answer->user_id === Auth::id())
                                        <!-- ドロップダウン -->
                                        <div class="dropdown text-end">
                                            <a class="dropdown-toggle text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            &#133;
                                            </a>

                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li><a class="dropdown-item editAnswer" data-answerid="{{ $answer->id }}">編集</a></li>
                                                <li><a class="dropdown-item" href="#" role="button" data-bs-toggle = "modal" data-bs-target = "#deleteAnswer{{ $answer->id }}">削除</a></li>
                                            </ul>
                                        </div>
                                    @endif
                                    <p>ユーザー:&ensp;{{$answer->user->name}}</p>
                                    <div>
                                        <p>{{ $answer->content_answer }}</p>
                                    </div>
                                </div>
                                <form class="editFrom" action="{{ route('answer.update', ['answer' => $answer, 'question' => $question]) }}" method="POST">
                                    @csrf
                                    @method('patch')
                                    <div class="d-flex flex-column">
                                        <label class="fw-bold">内容</label>
                                        <textarea class="form-control" name="content_answer" rows="5">{{ old('content_answer', $answer->content_answer) }}</textarea>
                                    </div>
                                    <button type="submit" class="button-all btn text-white rounded-pill m-2" name="submit" value="create">更新</button>
                                    <a class="btn btn-outline-secondary rounded-pill m-2" href="{{ route('question.show', $question) }}">戻る</a> 
                                </form>
                                                    
                                <!-- ここからいいね機能 -->
                                <?php
                                    $id = (string)$answer->id;
                                    $user_id = Auth::id();
                                    $group_by_array = $group_by->toArray();
                                ?>

                                <!-- 配列が存在するか。そのコメントのいいねが０の場合、空の配列が返され、キーがないためエラーになる -->
                                @if(array_key_exists($id, $group_by_array))
                                    <?php
                                        $nice_arrays = $group_by[$id];
                                        $n = 0;
                                    ?>

                                    @foreach($nice_arrays as $nice_array)
                                    <!-- ログイン中のユーザがいいねボタンを既に押しているとき -->
                                        @if($nice_array->user_id === $user_id)
                                        <span data-answerid="{{ $answer->id }}">
                                            <span class="heart-icon delete"></span>
                                            <span class="m-4 number-of-nice">{{$sum_nice[$id]}}</span>
                                        </span>
                                        <?php
                                            $n = 1;
                                        ?>
                                        @endif
                                    @endforeach
                                    <!-- ログイン中のユーザがいいねボタンを押していないとき（いいねが他にある時） -->
                                    @if($n === 0)
                                        <span data-answerid="{{ $answer->id }}">
                                            <span class="heart-icon nice-button"></span>
                                            <span class="m-4 number-of-nice">{{$sum_nice[$id]}}</span>
                                        </span>        
                                    @endif
                                    <!-- ログイン中のユーザがいいねボタンを押していない時（いいねが他に無い時。他にいいねがないと空配列が送られ、キーが無いためエラーになる。そのためこのように表示を分けている） -->
                                @else         
                                    <span data-answerid="{{ $answer->id }}">
                                        <span class="heart-icon nice-button"></span>
                                        <span class="m-4 number-of-nice">0</span>
                                    </span>
                                @endif
                            </li>
                        </ul>
                    </div>
                @endforeach
            </article>
            <script src="{{ asset('js\question_show.js') }}"></script>
       @endsection