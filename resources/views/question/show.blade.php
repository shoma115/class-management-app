<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.app')
    @section('content')
    
    @include('modals.modals_question.delete_question')
            <article>
                <script src = "{{ asset('question.js/main.js') }}"></script>
                <a href="{{ route('question.read') }}">
                    <img class="back-button" src="{{ asset('backbutton.img\プレゼンテーション4-removebg-preview.png') }}" width="30">
                </a>
                
                @if($question->user_id === Auth::id())
                        <div class="button-parent">
                            <button type="button" class="btn btn-outline-secondary rounded-pill m-2" id = "editQuestion">
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
                <div class="pb-4" id = "questionBody">

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
                <script>
                    const editQuestion = document.getElementById('editQuestion');
                    const questionBody = document.getElementById('questionBody');
                    var questionUpdate = document.createElement('form');
                    var buttonParent = document.createElement('div');
                    var questionUpdateButton = document.createElement('button');
                    var backToShow = document.createElement('button');
                    var QuestionUpdateCsrf = document.createElement('input');
                    var MethodPatch = document.createElement('input');
                    var QuestionCsrfToken = '{{ csrf_token() }}';
                    var QuestionTitle = document.createElement('input');
                    var QuestionTextarea = document.createElement("textarea");

                    editQuestion.addEventListener('click', () => {
                        questionUpdate.setAttribute("action","{{ route('question.update', $question) }}");
                        questionUpdate.setAttribute("method","POST");
                        questionUpdate.setAttribute("class","card mb-4");

                        QuestionUpdateCsrf.setAttribute("type", "hidden");
                        QuestionUpdateCsrf.setAttribute("name", "_token");
                        QuestionUpdateCsrf.setAttribute("value", QuestionCsrfToken);

                        MethodPatch.setAttribute("type", "hidden");
                        MethodPatch.setAttribute("name", "_method");
                        MethodPatch.setAttribute("value", "patch");

                        questionUpdateButton.setAttribute("type", "submit");
                        questionUpdateButton.setAttribute("class", "button-all btn text-white rounded-pill m-2");
                        questionUpdateButton.textContent = '更新';

                        backToShow.setAttribute("type", "button");
                        backToShow.setAttribute("onclick", "location.href='{{ route('question.show', $question)}}'");
                        backToShow.setAttribute("class", "btn btn-outline-secondary rounded-pill m-2");
                        backToShow.textContent = '戻る';

                        QuestionTitle.setAttribute("type", "text");
                        QuestionTitle.setAttribute("value", "{{ $question->title }}");
                        QuestionTitle.setAttribute("name", "title");
                        QuestionTitle.setAttribute("class", "form-control m-2");

                        QuestionTextarea.textContent = "{{ $question->content }}";
                        QuestionTextarea.setAttribute("name", "content");
                        QuestionTextarea.setAttribute("rows", "5");
                        QuestionTextarea.setAttribute("cols", "40");
                        QuestionTextarea.setAttribute("class", "form-control m-2");
                        
                        buttonParent.appendChild(questionUpdateButton);
                        buttonParent.appendChild(backToShow);
                        questionUpdate.appendChild(QuestionUpdateCsrf);
                        questionUpdate.appendChild(MethodPatch);
                        questionUpdate.appendChild(QuestionUpdateCsrf);
                        questionUpdate.appendChild(QuestionTitle);
                        questionUpdate.appendChild(QuestionTextarea);
                        questionUpdate.appendChild(buttonParent);

                        questionBody.replaceWith(questionUpdate);  
                        
                    })
                </script>



               
                <script src = "{{ asset('question.js/main.js') }}"></script> 
                <form action = "{{ route('answer.store', $question) }}" method = "post">
                    @csrf
                    <div class = "form-floating">
                        <textarea class = "form-control" placeholder = "回答を入力" id = "floatingTextarea2" style = "height:50px" name="content_answer"></textarea>
                        <label for = "floatingTextarea">返信を入力</label>
                    </div>
                    <div class="text-end pr-2">
                        <button id = "submit" type = "submit" class = "btn btn-default pr-2" disabled><img src = "{{ asset('answer.img/ei-send.png') }}"  width = "30" height = "25" alt = "送信">送信</button>
                    </div>
                    <script>
                        const textareaContent = document.getElementById('floatingTextarea2');
                        var submitButton = document.getElementById('submit');

                        textareaContent.addEventListener('input', () => {
                            if(textareaContent.value.length === 0) {
                                submitButton.disabled = true;
                            } else {
                                submitButton.disabled = false;
                            }
                            })
                        
                    </script>
                        
                </form>
                
                <h5 class="mt-4 fw-bold border-top">返信一覧</h5>
                <?php 
                    $i = 1;
                    $j = 1000;
                    $l = 1000000;
                    $k = 1000000000;
                    $m = 1000000000000;
                    
                 ?>
                 <!-- 回答を全て表示 -->
                @foreach($answers as $answer)
                    <!--　回答の削除のモーダル -->
                    @include('modals.modals_answers.delete_answer')
                    <div class="mb-5 card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <!-- 回答のuser_idとログイン中のユーザのIDが一致したときのみ編集メニューを表示させる -->
                                @if($answer->user_id === Auth::id())
                                    <!-- ドロップダウン -->
                                    <div class="dropdown text-end" id="{{ $l }}">
                                        <a class="dropdown-toggle text-decoration-none" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        &#133;
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a id = "{{ $j }}" class="dropdown-item">編集</a></li>
                                            <li><a class="dropdown-item" href="#" role="button" data-bs-toggle = "modal" data-bs-target = "#deleteAnswer{{ $answer->id }}">削除</a></li>
                                        </ul>
                                    </div>
                                @endif
                                
                                        <p>ユーザー:&ensp;{{$answer->user->name}}</p>
                                        <div id ="{{ $k }}">
                                            <p id = "{{ $i }}">{{ $answer->content_answer }}</p>
                                        </div>
                                    
                                    
                                    
                            
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
                                        <span class="delete" data-answerid="{{ $answer->id }}">
                                            <img class="nice-image" src="{{ asset('nice.img/23636740.png') }}" width = "30" height = "25">
                                            {{$sum_nice[$id]}}
                                        </span>
                                        <?php
                                            $n = 1;
                                        ?>
                                        @endif
                                    @endforeach
                                    <!-- ログイン中のユーザがいいねボタンを押していないとき（いいねが他にある時） -->
                                    @if($n === 0)
                                        <span class="nice-button" data-answerid="{{ $answer->id }}">
                                            <img class="nice-image" src="{{ asset('nice.img/23636735.png') }}" width = "30" height = "25">
                                            {{$sum_nice[$id]}}
                                        </span>         
                                    @endif
                                    <!-- ログイン中のユーザがいいねボタンを押していない時（いいねが他に無い時。他にいいねがないと空配列が送られ、キーが無いためエラーになる。そのためこのように表示を分けている） -->
                                @else         
                                    <span class="nice-button" data-answerid="{{ $answer->id }}">
                                            <img class="nice-image" src="{{ asset('nice.img/23636735.png') }}" width = "30" height = "25">
                                            0
                                    </span>
                                @endif
                            </li>
                        </ul>
                    </div>

                        
                   
                        <!-- ここから編集機能 -->
                    <script>
                        const answerContent{{ $i }}= document.getElementById('{{ $i }}');
                        var editButton{{ $j }} = document.getElementById('{{ $j }}');
                        const Answer{{ $k }} = document.getElementById('{{ $k }}');
                        var dropdown{{ $l }} = document.getElementById('{{ $l }}');
                        var updateForm = document.createElement('form');
                        var updateButton = document.createElement('button');
                        var backButton = document.createElement('button');
                        var ForCsrf = document.createElement('input');
                        var csrfToken = '{{ csrf_token() }}';
                        var textareaTag = document.createElement("textarea");
                    
                    
                        editButton{{ $j }}.addEventListener('click', () => {
                            dropdown{{ $l }}.innerHTML = '';
                            
                            

                            updateForm.setAttribute("action", "{{ route('answer.update', ['answer' => $answer, 'question' => $question]) }}");
                            updateForm.setAttribute("method", "POST");
                            
                            updateButton.setAttribute("type", "submit");
                            updateButton.setAttribute("class", "button-all btn text-white rounded-pill m-2");
                            updateButton.textContent = "更新";

                            backButton.setAttribute("type", "button");
                            backButton.setAttribute("onclick", "location.href='{{ route('question.show', $question)}}'");
                            backButton.setAttribute("class", "btn btn-outline-secondary rounded-pill m-2");
                            backButton.textContent = "戻る";

                            ForCsrf.setAttribute("type", "hidden");
                            ForCsrf.setAttribute("name", "_token");
                            ForCsrf.setAttribute("value", csrfToken);
    
                            textareaTag.setAttribute("name", "content_answer");
                            textareaTag.textContent = "{{  $answer->content_answer }}";
                            textareaTag.setAttribute("rows", "5");
                            textareaTag.setAttribute("cols", "40");
                                        
                            updateForm.appendChild(ForCsrf);
                            updateForm.appendChild(textareaTag);
                            updateForm.appendChild(updateButton); 
                            updateForm.appendChild(backButton);                        
                        
                            answerContent{{ $i }}.replaceWith(updateForm);   
                        })

                        

                        
                    </script>
                    <?php
                        $i++;
                        $j++;
                        $k++;
                        $l++;
                        $m++;
                    ?>
                @endforeach
                
                <!-- いいねの機能のajaxだけはforeachの中に入れない。複数回起動しちゃうから -->
                <script>
                        // いいねを付ける、消すときのajax処理
                        // ajaxのセットアップ。ヘッダーに組み込んだcsrf-tokenを読み込み
                            $.ajaxSetup({
                                headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
                            })
                            $('span').on('click', function(){
                                var answerId = $(this).data('answerid');
                                var button = $(this);
                                var className = button.attr("class");
                                // いいねを付けていない時にいいねボタンを押す（いいねを付ける）
                                if(className === "nice-button") {            
                                    $.ajax({
                                    url: "{{ route('answernice.increase') }}",
                                    method: "POST",
                                    data: { answer_id : answerId },
                                    dataType: "json",
                                    }).done(function(res){
                                        button.html('<img src="{{ asset('nice.img/23636740.png') }}"  width = "30" height = "25">' + res.sum_nice);
                                        button.addClass('delete');
                                        button.removeClass('nice-button');
                                        
                                    }).fail(function(){
                                            alert('通信の失敗をしました');
                                    });
                                    // いいねを付けている時にいいねを押す（いいねを消す）
                                }else if(className === "delete") {            
                                    $.ajax({
                                    url: "{{ route('answernice.decrease') }}",
                                    method: "POST",
                                    data: { delete_id : answerId },
                                    dataType: "json",
                                    }).done(function(res){
                                        var result = button.html('<img src="{{ asset('nice.img/23636735.png') }}"  width = "30" height = "25">' + res.sum_nice);
                                        button.addClass('nice-button');
                                        button.removeClass('delete');

                                    }).fail(function(){
                                            alert('通信の失敗をしました');
                                    });
                                }
                            });
                            

                            
                        </script>
               
            </article>
       @endsection