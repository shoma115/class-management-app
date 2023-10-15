@extends('layouts.app')
    @section('content')
            <article>
                <a href="{{ route('classdata.read') }}">
                    <a  class="btn btn-secondary rounded-pill ms-3" href="{{ route('classdata.read') }}">戻る</a>
                </a>
                <!-- 授業情報の編集モーダル -->
                @include('modals.modals_classdata.edit_classdata')
                @include('modals.modals_classdata.delete_classdata')
                @include('modals.modals_classdata.add_credited_from')
                <div class="button">
                    <button type="button" class="btn btn-outline-secondary rounded-pill mx-2 mt-5" data-bs-toggle = "modal" data-bs-target = "#editClassDatum{{ $classdatum->id }}">
                        <img src="{{ asset('edit.img\ブログの投稿、編集アイコン素材.png') }}" width="30">編集
                    </button>
                    
                    <button type="button"  class="btn btn-outline-secondary rounded-pill mx-2 mt-5" data-bs-toggle = "modal" data-bs-target = "#addCreditedFromClassDatum{{ $classdatum->id }}">
                        履修済に登録
                    </button>
                    <button type="button"  class="btn btn-outline-secondary rounded-pill mx-2 mt-5" data-bs-toggle = "modal" data-bs-target = "#deleteClassdatum{{ $classdatum->id }}">
                        <img src="{{ asset('delete.img\trash-can_115312.png') }}" width="20">&thinsp;<span style="color: red">削除</span>
                    </button>
                </div>

                <h1 class="fw-bold m-4 ">{{ $classdatum->class_name }}</h1>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5><span style="color: #00cc74;">教員</span>&emsp;{{ $classdatum->teacher_name }}</h5>
                        </li>
                        <li class="list-group-item">
                            <h5><span style="color: #00cc74;">評価</span>&emsp;{{ $classdatum->evaluation }}</h5>
                        </li>
                        <li class="list-group-item">
                            <h5><span style="color: #00cc74;">出席</span>&emsp;{{ $classdatum->attendance }}</h5>
                        </li>
                        <li class="list-group-item">
                            <h5><span style="color: #00cc74;">場所</span>&emsp;{{ $classdatum->class_place }}</h5>
                        </li>
                        <li class="list-group-item">
                            <h5><span style="color: #00cc74;">時限</span>&emsp;{{ $classdatum->class_week_day }}{{ $classdatum->class_time }}限</h5>
                        </li>
                        <li class="list-group-item">
                            <h5><span style="color: #00cc74;">単位</span>&emsp;{{ $classdatum->amount_credit }}</h5>
                        </li>    
                        <li class="list-group-item">
                            <h5><span style="color: #00cc74;">枠組1</span>&emsp;{{ $classdatum->division_1 }}</h5>
                        </li>  
                        <li class="list-group-item">
                            <h5><span style="color: #00cc74;">枠組2</span>&emsp;{{ $classdatum->division_2 }}</h5>
                        </li>          
                        
                    </ul>                       
                </div>
            </article>
        @endsection