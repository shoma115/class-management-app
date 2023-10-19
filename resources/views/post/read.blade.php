<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.app')
    @section('content')
            <input id="autocompleteRoute" type="hidden" value="{{ route('review.suggest') }}">
            <input id="niceIncrese" type="hidden" value="{{ route('nice.store') }}">
            <input id="niceDecrese" type="hidden" value="{{ route('nice.delete') }}">
            <article>  
                <div class="title">
                    <h1 class="fw-bold">授業のレビュー</h1>
                </div>
                <div class="m-4">
                    <form action="{{ route('review.read') }}" method="GET" autocomplete="off">
                        <input type="text" id="searchReview" name="search" placeholder="授業名でレビューを検索">
                        <button type="submit" class="search-button">
                            <div class="search icon"></div>
                        </button>
                    </form>
                    <div>
                        <a class="create-button" href="{{ route('review.create') }}"></a>
                    </div>
                    <a href="{{ route('review.read') }}">検索をクリア</a>
                </div>

                <div class="pagination">
                    {{ $posts->appends(Request::only('search'))->links('vendor.pagination.bootstrap-4') }}
                    {{ $posts->total() }}件中
                    {{ $posts->firstItem() }}〜{{ $posts->lastItem() }} 件を表示
                </div>
                <div> 
                @foreach($posts as $post)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $post->class_name }}</h5>
                            <h5 class="card-text m-0"><span>楽単:</span>&emsp;<span class="fs-1" style="color: #ffcc00;">{{ str_repeat('★', $post->difficulty_level) }}</span><span class="fs-1" style="color: #ccc;">{{ str_repeat('★', 5 - $post->difficulty_level) }}</span></h5>
                            <h5 class="card-text mb-3"><span>学び:</span>&emsp;<span class="fs-1" style="color: #ffcc00;">{{ str_repeat('★', $post->interesting) }}</span><span class="fs-1" style="color: #ccc;">{{ str_repeat('★', 5 - $post->interesting) }}</span></h5>
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
                                        <span data-postid="{{ $post->id }}">
                                            <span class="heart-icon delete"></span>
                                            <span class="m-4 number-of-nice">{{$sum_nice[$id]}}</span> 
                                        </span>
                                        <?php
                                            $i = 1;
                                        ?>
                                        @endif
                                    @endforeach

                                    <!-- ログイン中のユーザがいいねボタンを押していないとき＆いいねが他にある時 -->
                                    @if($i === 0)
                                        <span data-postid="{{ $post->id }}">
                                            <span class="heart-icon nice-button"></span>
                                            <span class="m-4 number-of-nice">{{$sum_nice[$id]}}</span>
                                        </span> 
                                    @endif
                                @else     
                                <!-- ログイン中のユーザがいいねボタンを押していない時＆いいねが他に無い（0いいね状態）時。他にいいねがないと空配列が送られ、キーが無いためエラーになる。そのためこのように表示を分けている） -->    
                                    <span data-postid="{{ $post->id }}">
                                        <span class="heart-icon nice-button"></span>
                                        <span class="m-4 number-of-nice">0</span>
                                    </span>
                                @endif
                        </div>
                    </div>
                @endforeach
                </div>
            </article>
            <script src="{{ asset('js\post.js') }}"></script>
@endsection