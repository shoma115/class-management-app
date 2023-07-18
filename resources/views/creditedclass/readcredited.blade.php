@extends('layouts.app')
    @section('content')
    
    
            <article>
                
                <div class="p-3">
                    <h1 class="fw-bold">単位取得済み授業一覧</h1>
                    
                    @foreach($sum_credits as $sum_credit)
                    <h2>履修済み単位数/卒業要件単位:<br>{{ $sum_credit->sum }}/128</h2>
                    <a href="{{ route('credited.needcredit') }}">卒業要件単位と現在の取得単位を見る</a>
                    @endforeach
                </div>
                <a class="button-all btn text-white rounded-pill mx-2" href="{{ route('credited.select')}}">単位取得済み授業を登録</a>
                <div class="pb-5">
                    <table class="table">
                            <tr>
                                <th>授業名</th>
                                <th>教員名</th>
                                <th>科目枠組</th>
                                <th>単位数</th>
                                <th>メニュー</th>
                               
                            </tr>
                            @include('modals.modals_credited.delete')
                            @foreach($classes as $creditedclass)
                            @include('modals.modals_credited.edit_credited')
                            
                            <tr>
                                <td>{{ $creditedclass->class_name }}</td>
                                <td>{{ $creditedclass->teacher_name }}</td>
                                <td>{{ $creditedclass->division_1 }}<br>{{ $creditedclass->division_2 }}</td>
                                <td>{{ $creditedclass->amount_credit }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="fs-2 text-decoration-none" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            &#133;
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle = "modal" data-bs-target = "#editCredited{{ $creditedclass->id }}" >編集</a></li>
                                            <li><a class="dropdown-item" id="deleteButton" href="#" data-bs-toggle = "modal" data-credited-id="{{ $creditedclass->id}}" data-credited-name="{{ $creditedclass->class_name }}" data-bs-target = "#deleteCredited" style="color:red">削除</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        
                        
                    </table>
                </div>
            </article>
        @endsection