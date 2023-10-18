@extends('layouts.app')
    @section('content')
        <input id="questionAutocompleteRoute" type="hidden" value="{{ route('question.suggest') }}">
        <input id="questionNiceDecreseRoute" type="hidden" value="{{ route('questionnice.decrease') }}">
        <input id="questionNiceIncreseRoute" type="hidden" value="{{ route('questionnice.increase') }}">          
        <article>
            <h1 class="title fw-bold">鹿大生なんでもQ&A</h1>

            <!-- ここから検索フォーム -->
            <div class="m-4">
                <form action="{{ route('question.read') }}" class="search-form" method="GET" autocomplete="off">
                    <input type="text" id="searchQuestion"  name="search" placeholder="タイトルで質問を検索">
                    <button type="submit" class="search-button">
                            <div class="search icon"></div>
                    </button>
                </form>
                <div>
                    <a class="create-button" href="{{ route('question.create') }}"></a>
                </div>
                <a href="{{ route('question.read') }}">検索をクリア</a>
            </div>
                <div class="pagination">
                    {{ $questions->appends(Request::only('search'))->links('vendor.pagination.bootstrap-4') }}
                    {{ $questions->total() }}件中
                    {{ $questions->firstItem() }}〜{{ $questions->lastItem() }} 件を表示
                </div>
            @if($my_question === true) 
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
            </div>
            <div>
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
                                        <span data-questionid="{{ $question->id }}">
                                            <span class="heart-icon delete"></span>
                                            <span class="m-4 number-of-nice">{{$sum_nice[$id]}}</span>
                                        </span>
                                        <?php
                                            $i = 1;
                                        ?>
                                        @endif
                                    @endforeach
                                <!-- ログイン中のユーザがいいねボタンを押していないとき（いいねが他にある時） -->
                                    @if($i === 0)
                                        <span data-questionid="{{ $question->id }}">
                                            <span class="heart-icon nice-button"></span>
                                            <span class="m-4 number-of-nice">{{$sum_nice[$id]}}</span>
                                        </span>        
                                    @endif
                                    <!-- ログイン中のユーザがいいねボタンを押していない時（いいねが他に無い時。他にいいねがないと空配列が送られ、キーが無いためエラーになる。そのためこのように表示を分けている） -->
                                @else    
                                    <span data-questionid="{{ $question->id }}">
                                        <span class="heart-icon nice-button"></span>
                                        <span class="m-4 number-of-nice">0</span>
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
            </article>
                <script src="{{ asset('js\question_read.js') }}" ></script>       
       @endsection