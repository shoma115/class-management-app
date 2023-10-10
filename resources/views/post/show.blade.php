<?php
use Illuminate\Support\Facades\Auth;
?>
@extends('layouts.app')
    @section('content')
    @include('modals.modals_post.edit_post')
    @include('modals.modals_post.delete_post')
            <article>
                <div class="review-show">
                    <a href="{{ route('review.read') }}">
                        <img class="back-button" src="{{ asset('backbutton.img\プレゼンテーション4-removebg-preview.png') }}" width="30">
                    </a>

               
                    @if($post->user_id == Auth::id())
                        <div class="button-parent">
                            <button type="button" class="btn btn-outline-secondary rounded-pill m-2" data-bs-toggle = "modal" data-bs-target = "#editPost">
                                    <img src="{{ asset('edit.img\ブログの投稿、編集アイコン素材.png') }}" width="30">編集
                            </button>
                            <button type="button"  class="btn btn-outline-secondary rounded-pill m-2" data-bs-toggle = "modal" data-bs-target = "#deletePost">
                                <img src="{{ asset('delete.img\trash-can_115312.png') }}" width="20">&thinsp;<span style="color: red">削除</span>
                            </button>
                        </div>
                    @endif
                </div>
                
                <h1 class="fw-bold m-4 ">{{ $post->class_name }}</h1>
                <div class="card pb-2">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h4><span class="fw-bold">担当教員:</span>&emsp;{{ $post->teacher_name }}</h4>
                                
                        </li>
                        <li class="list-group-item">
                            <h4><span class="fw-bold">単位取得の難しさ:</span>&emsp;<span class="fs-1" style="color: #ffcc00;">{{ str_repeat('★', $post->difficulty_level) }}</span><span class="fs-1" style="color: #ccc;">{{ str_repeat('★', 5 - $post->difficulty_level) }}</span></h4>
                                
                        </li>
                        <li class="list-group-item">
                            <h4><span class="fw-bold">内容の面白さ:</span>&emsp;<span class="fs-1" style="color: #ffcc00;">{{ str_repeat('★', $post->interesting) }}</span><span class="fs-1" style="color: #ccc;">{{ str_repeat('★', 5 - $post->interesting) }}</span></h4>
                        </li>
                        <li class="list-group-item">
                            <h4><span class="fw-bold">評価方法:</span>&emsp;{{ $post->evaluation }}</h4>
                        </li>
                        <li class="list-group-item">
                            <h4><span class="fw-bold">出席:</span>&emsp;{{ $post->attendance }}</h4>
                        </li>
                        <li class="list-group-item">
                            <h4><span class="fw-bold">曜日・時限:</span>&emsp;{{ $post->class_week_day }}{{ $post->class_time }}限</h3>
                        </li>
                        <li class="list-group-item">
                            <h4><span class="fw-bold">取得可能単位数:</span>&emsp;{{ $post->amount_credit }}</h3>
                            
                        </li>
                        <li class="list-group-item">
                            <h4><span class="fw-bold">レビュー:</span></h3>
                            <p>{{ $post->content }}</p>
                        </li>
                    </ul>
                </div>

               
            </article>
        @endsection