
@extends('layouts.app')
    @section('content')
        <a href="{{ route('mypage.read') }}">
            <img class="back-button" src="{{ asset('backbutton.img\プレゼンテーション4-removebg-preview.png') }}" width="30">
        </a>
        <div>
            <h3 class="fw-bold m-4 ">いいねしたレビュー<h3>
        </div>
        <div>
            <table class="table">
            <tr>
                <th>授業名</th>
                <th><th>
            </tr>
            @foreach($nices as $nice)
                @foreach($posts as $post)
                    @if($post->id === $nice->post_id)
                        <tr>
                            <td class="fs-5">{{ $post->class_name}}</td>
                            <td><a class="button-all btn text-white rounded-pill m-1 btn-sm" href="{{ route('review.show', $post) }}">レビューを開く</a></td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </table>
        </div>
       @endsection