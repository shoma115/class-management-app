@extends('layouts.app')
    @section('content')
        <h1 class="m-2 border-bottom">マイページ</h1>
        <div class="m-4">    

            <h3 id="user_name">ユーザー名:&ensp;{{$user->name}}</h3>
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

        <script>
            const userName = document.getElementById('user_name');
            const userNameChange = document.getElementById('user_name_change');
            const updateForm = document.createElement('form');
            const updateButton = document.createElement('button');
            const backButton = document.createElement('button');
            const ForCsrf = document.createElement('input');
            const csrfToken = '{{ csrf_token() }}';
            const textTag = document.createElement("input");
          
            userNameChange.addEventListener('click', () => {
    
                            updateForm.setAttribute("action", "{{ route('user.update', $user) }}");
                            updateForm.setAttribute("method", "POST");
                            
                            updateButton.setAttribute("type", "submit");
                            updateButton.textContent = "更新";
                            updateButton.setAttribute("class", "button-all btn text-white rounded-pill m-1");

                            backButton.setAttribute("type", "button");
                            backButton.setAttribute("onclick", "location.href='{{ route('mypage.read')}}'");
                            backButton.textContent = "戻る";
                            backButton.setAttribute("class", "btn btn-outline-secondary rounded-pill mx-1");

                            ForCsrf.setAttribute("type", "hidden");
                            ForCsrf.setAttribute("name", "_token");
                            ForCsrf.setAttribute("value", csrfToken);
    
                            textTag.setAttribute("name", "user_name");
                            textTag.setAttribute("value", "{{$user->name}}");
                            textTag.setAttribute("type", "text");
                                        
                            updateForm.appendChild(ForCsrf);
                            updateForm.appendChild(textTag);
                            updateForm.appendChild(updateButton); 
                            updateForm.appendChild(backButton);                        
                        
                            userName.replaceWith(updateForm);   
                        })

        </script>
    
    @endsection