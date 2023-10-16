@extends('layouts.app')
    @section('content')
            <article>
                <a href="{{ route('question.read') }}">
                    <a  class="btn btn-secondary rounded-pill ms-3" href="{{ route('question.read') }}">戻る</a>
                </a>
                <h3 class="fw-bold m-3">質問の投稿</h3>
                @if($errors->any())
                <div>
                    <ul>
                    @foreach($errors->all() as $error)
                    
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('question.store') }}" method="POST">
                @csrf
                    <div class="d-flex flex-column card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <label class="fs-5 fw-bold">質問のタイトル<span style="color:red">【必須】</span></label><br>
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                            </li>
                            <li class="list-group-item">
                                <label class="fs-5 fw-bold">内容<span style="color:red">【必須】</span></label><br>
                                <script src = "{{ asset('question.js/main.js') }}"></script>
                                <textarea class="form-control" name="content">{{ old('content') }}</textarea>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{ route('question.read') }}" class="btn btn-outline-secondary rounded-pill mx-3">キャンセル</a>
                        <button type="submit" class="button-all btn text-white rounded-pill w-50 mx-3" name="submit" value="create">投稿</button>
                    </div>
                </form>
            </article>
        @endsection