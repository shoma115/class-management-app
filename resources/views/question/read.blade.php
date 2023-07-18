@extends('layouts.app')
    @section('content')
            <article>
        
            <h1 class="title fw-bold">鹿大生なんでもQ&A</h1>

            <!-- ここから検索フォーム -->
            <div class="m-4">
                <form action="{{ route('question.read') }}" class="search-form" method="GET" autocomplete="off">
                    <input type="text" id="searchQuestion"  name="search" placeholder="タイトルで質問を検索">
                    <button type="submit"><img src="{{ asset('search.img\ei-search.png') }}" width = "20" height = "20"></button>
                </form>
                <a href="{{ route('question.read') }}">検索をクリア</a>
            </div>
                <div class="pagination">
                    {{ $questions->appends(Request::only('search'))->links('vendor.pagination.bootstrap-4') }}
                    {{ $questions->total() }}件中
                    {{ $questions->firstItem() }}〜{{ $questions->lastItem() }} 件を表示
                </div>

                <!-- ajaxを使用したautocomplete -->
                <script>
                     $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
                    })
                    $(document).ready( function() {
                        $('#searchQuestion').autocomplete({
                            source: function(request, response) { 
                                        
                                $.ajax({
                                url: "{{ route('question.suggest') }}",
                                method: "POST",
                                data: { search : request.term },
                                dataType: "json",
                                }).done(function(res){
                                    response(res.suggest);
                                    console.log(res.suggest);
                                    
                                    
                                }).fail(function(){
                                        alert('通信の失敗をしました');
                                });
                            }
                        })
                    })
                </script>

            @if($mine === "done") 
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a id="item1" class="nav-link" aria-current="page" href="{{ route('question.read') }}">みんなの質問</a>
                    </li>
                    <li class="nav-item">
                        <a id="item2" class="nav-link active" aria-current="page" href="{{ route('question.mine')}}">あなたの質問</a>
                    </li>
                </ul>
            @else
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a id="item1" class="nav-link active" aria-current="page" href="{{ route('question.read') }}">みんなの質問</a>
                    </li>
                    <li class="nav-item">
                        <a id="item2" class="nav-link" aria-current="page" href="{{ route('question.mine')}}">あなたの質問</a>
                    </li>
                </ul>
            @endif

            <script>
                const navItem1 = document.getElementById('item1');
                const navItem2 = document.getElementById('item2');
                
                navItem1.addEventListener('click', () => {
                    navItem1.classList.add("active");
                    navItem2.removeClass("active");
                })
                    navItem2.addEventListener('click', () => {
                    navItem2.classList.add("active");
                    navItem1.removeClass("active");
                    })
            </script>
            
            </div>
            <div class = "pb-5">
                    @foreach($questions as $question)
                    <div class="card">
                       <div class="card-body d-flex">
                            <div>
                                <h5 class = "card-title"> {{ $question->title }}</h5>
                                <a href = "{{ route('question.show', $question) }}" >スレッドを開く</a>
                                <span class="inline-block"><img src = "{{ asset('question.img/fukidashi_bw03.png') }}" width = "25" height = "20" alt = "回答数">{{ $question->comments }}</span>
                                
                                <?php
                                    $id = (string)$question->id;
                                    $user_id = Auth::id();
                                    $group_by_array = $group_by->toArray();
                                ?>

                                @if(array_key_exists($id, $group_by_array))
                                    <?php
                                        $nice_arrays = $group_by[$id];
                                        $i = 0;
                                    ?>

                                    @foreach($nice_arrays as $nice_array)
                                    <!-- ログイン中のユーザがいいねボタンを既に押しているとき -->
                                        @if($nice_array->user_id === $user_id)
                                        <span class="delete" data-questionid="{{ $question->id }}">
                                            <img class="nice-image" src="{{ asset('nice.img/23636740.png') }}" width = "30" height = "25">
                                            {{$sum_nice[$id]}}
                                        </span>
                                        <?php
                                            $i = 1;
                                        ?>
                                        @endif
                                    @endforeach
                                <!-- ログイン中のユーザがいいねボタンを押していないとき（いいねが他にある時） -->
                                    @if($i === 0)
                                        <span class="nice-button" data-questionid="{{ $question->id }}">
                                            <img class="nice-image" src="{{ asset('nice.img/23636735.png') }}" width = "30" height = "25">
                                            {{$sum_nice[$id]}}
                                        </span>         
                                    @endif
                                    <!-- ログイン中のユーザがいいねボタンを押していない時（いいねが他に無い時。他にいいねがないと空配列が送られ、キーが無いためエラーになる。そのためこのように表示を分けている） -->
                                @else         
                                    <span class="nice-button" data-questionid="{{ $question->id }}">
                                            <img class="nice-image" src="{{ asset('nice.img/23636735.png') }}" width = "30" height = "25">
                                            0
                                    </span>
                                @endif
                            </div>
                             <!-- 解決済みかどうかを判別 -->
                             <div >
                                @if($question->resolved === 1)
                                    <img class="mx-4" src="{{asset('resolved.img/23926895.png')}}" width=50 height=50>
                                @endif
                            </div>

                            
                        </div>   
                    </div>     
                    @endforeach
             </div>
             <div>
                    <a href="{{ route('question.create') }}"><img src="{{ asset('toukou.img\投稿アイコン-removebg-preview.png')}}" class="pen fixed-bottom"></a>
            </div>
                

            </article>

                    <script>
                        // いいねを付ける、消すときのajax処理
                        // ajaxのセットアップ。ヘッダーに組み込んだcsrf-tokenを読み込み
                            $.ajaxSetup({
                                headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
                            })
                            $('span').on('click', function(){
                                var questionId = $(this).data('questionid');
                                var button = $(this);
                                var className = button.attr("class");
                                // いいねを付けていない時にいいねボタンを押す（いいねを付ける）
                                if(className === "nice-button") {            
                                    $.ajax({
                                    url: "{{ route('questionnice.increase') }}",
                                    method: "POST",
                                    data: { question_id : questionId },
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
                                    url: "{{ route('questionnice.decrease') }}",
                                    method: "POST",
                                    data: { delete_id : questionId },
                                    dataType: "json",
                                    }).done(function(res){
                                        var result = button.html('<img src="{{ asset('nice.img/23636735.png') }}"  width = "30" height = "25">' + res.sum_nice);
                                        button.addClass('nice-button');
                                        button.removeClass('delete');
                                        console.log(res.sum_nice);
                                    }).fail(function(){
                                            alert('通信の失敗をしました');
                                    });
                                }
                            });
                            

                            
                        </script>
                    
       @endsection