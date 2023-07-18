<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.app')
    @section('content')
            <article>
                
                <div class="title">
                    <h1 class="fw-bold">授業のレビュー</h1>
                </div>
                <div class="m-4">
                    <form action="{{ route('review.read') }}" method="GET" autocomplete="off">
                        <input type="text" id="searchReview" name="search" placeholder="授業名でレビューを検索">
                        <button class="py-0" type="submit"><img src="{{ asset('search.img\ei-search.png') }}" width = "20" height = "20"></button>
                    </form>
                    <a href="{{ route('review.read') }}">検索をクリア</a>
                </div>

                <div class="pagination">
                    {{ $posts->appends(Request::only('search'))->links('vendor.pagination.bootstrap-4') }}
                    {{ $posts->total() }}件中
                    {{ $posts->firstItem() }}〜{{ $posts->lastItem() }} 件を表示
                </div>

                <script>
                     $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
                    })
                    $(document).ready( function() {
                        $('#searchReview').autocomplete({
                            source: function(request, response) { 
                                        
                                $.ajax({
                                url: "{{ route('review.suggest') }}",
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
                
                <?php
                    $j = 1;
                ?>
                <div class="pb-5"> 
                @foreach($posts as $post)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $post->class_name }}</h5>
                            <h5 class="card-text m-0"><span>単位取得の難しさ:</span>&emsp;<span class="fs-1" style="color: #ffcc00;">{{ str_repeat('★', $post->difficulty_level) }}</span><span class="fs-1" style="color: #ccc;">{{ str_repeat('★', 5 - $post->difficulty_level) }}</span></h5>
                            <h5 class="card-text m-0"><span>内容の面白さ:</span>&emsp;<span class="fs-1" style="color: #ffcc00;">{{ str_repeat('★', $post->interesting) }}</span><span class="fs-1" style="color: #ccc;">{{ str_repeat('★', 5 - $post->interesting) }}</span></h5>
                            <p id="{{ $j }}" class="card-text m-1">レビュー:<br>{{ $post->content }}</p>
                            <a class="card-link inline-block" href="{{ route('review.show', $post) }}">詳細を見る</a>
                        
                        
                            

                            <?php
                                // post_idを文字列型に変換してコレクションのキーとして使用できるようにする。
                                $id = (string)$post->id;
                                $user_id = Auth::id();
                                // post_idでグループ分けされたデータが入っているコレクションを配列に変換。キーの有無を確認するため
                                $group_by_array = $group_by->toArray();
                                // 判別用のi
                                $i = 0;
                            ?>

                            <!-- 該当の投稿にいいねが付いているか（元が0いいねではないかの確認）。空のコレクションだと77行目で「存在しないキー」とエラーが返ってくるため -->
                            @if(array_key_exists($id, $group_by_array))
                                <?php
                                        // group_byは二次元配列の形になっている。なのでキーで配列を取り出して代入する
                                    $nice_arrays = $group_by[$id];
                                        
                                ?>
                                    <!-- いいねを取り出していく -->
                                @foreach($nice_arrays as $nice_array)
                                    <!-- ログイン中のユーザがいいねボタンを既に押しているとき -->
                                    @if($nice_array->user_id === $user_id)
                                        <span class="delete" data-postid="{{ $post->id }}">
                                            <img class="nice-image" src="{{ asset('nice.img/23636740.png') }}" width = "30" height = "25">
                                            {{$sum_nice[$id]}}
                                        </span>
                                        <?php
                                            $i = 1;
                                        ?>
                                        @endif
                                    @endforeach

                                    <!-- ログイン中のユーザがいいねボタンを押していないとき＆いいねが他にある時 -->
                                    @if($i === 0)
                                        <span class="nice-button" data-postid="{{ $post->id }}">
                                            <img class="nice-image" src="{{ asset('nice.img/23636735.png') }}" width = "30" height = "25">
                                            {{$sum_nice[$id]}}
                                        </span>         
                                    @endif
                                @else     
                                <!-- ログイン中のユーザがいいねボタンを押していない時＆いいねが他に無い（0いいね状態）時。他にいいねがないと空配列が送られ、キーが無いためエラーになる。そのためこのように表示を分けている） -->    
                                    <span class="nice-button" data-postid="{{ $post->id }}">
                                            <img class="nice-image" src="{{ asset('nice.img/23636735.png') }}" width = "30" height = "25">
                                            0
                                    </span>
                                @endif
                        </div>
                    </div>

                        <script>
                            // レビューの本文（{{$post->content}}）を一部だけ表示。一定字数以降は……を表示させる
                            var limit = document.getElementById('{{ $j }}');
                            var content = limit.textContent;
                            
                            if(content.length > 30) {
                                limit.textContent = content.substring(0, 30) + "…";
                            }
                            
                        </script>
                        <?php
                            // レビューのコンテンツ用の変数
                            $j++;
                        ?> 
                
                @endforeach
                </div>
                <div>
                    <a href="{{ route('review.create') }}"><img src="{{ asset('toukou.img\投稿アイコン-removebg-preview.png')}}" class="pen fixed-bottom"></a>
                </div>
            </article>

            <script>
                // いいねを付ける、消すときのajax処理
                     $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
                    })
                    $('span').on('click', function(){
                        var postId = $(this).data('postid');
                        var button = $(this);
                        var className = button.attr("class");
                        // いいねを付けていない時にいいねボタンを押す（いいねを付ける）
                        if(className === "nice-button") {            
                            $.ajax({
                            url: "{{ route('nice.store') }}",
                            method: "POST",
                            data: { post_id : postId },
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
                            url: "{{ route('nice.delete') }}",
                            method: "POST",
                            data: { delete_id : postId },
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
@endsection