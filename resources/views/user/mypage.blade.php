@extends('layouts.app')
    @section('content')
        <h1 class="m-2 border-bottom">マイページ</h1>
        <div class="m-4">    

            <h3 id="userName">ユーザー名:&ensp;{{$user->name}}</h3>
            <form id="editUserForm" action="{{ route('user.update', $user) }}" method="POST">
                @csrf
                @method('patch')
                <input type="text" name="user_name" value="{{ $user->name }}">
                <button type="submit" class="button-all btn text-white rounded-pill m-1">更新</button>
                <a href="{{ route('mypage.read')}}" class="btn btn-outline-secondary rounded-pill mx-1">戻る</a>
            </form>
            <p>※ユーザー名はQ&Aに質問や回答を投稿した際に他のユーザーへ表示されます</p>
            <a id="user_name_change" href="#" class="btn btn-outline-secondary rounded-pill mx-2">ユーザー名を変更する</a>
            <!-- ログアウト -->
            <a class="btn btn-danger rounded-pill mx-2 " href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
            </a>
                                    

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <a href="{{ route('nice.review') }}">いいねを付けたレビューを見る<a>
                </li>
                <li class="list-group-item">
                    <a href="{{ route('nice.question') }}">いいねを付けた質問を見る<a>
                </li>
            </ul>
        </div>
<script src="{{ asset('js\mypage.js') }}"></script>
    @endsection