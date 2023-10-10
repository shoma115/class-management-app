@extends('layouts.app')
    @section('content')
            <article>
                <a href="{{ route('classdata.read') }}">
                    <img class="back-button" src="{{ asset('backbutton.img\プレゼンテーション4-removebg-preview.png') }}" width="30">
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
                            <h3><span style="color: #00cc74;">担当の教員</span>&emsp;{{ $classdatum->teacher_name }}</h3>
                        </li>
                        <li class="list-group-item">
                            <h3><span style="color: #00cc74;">評価方法</span>&emsp;{{ $classdatum->evaluation }}</h3>
                        </li>
                        <li class="list-group-item">
                            <h3><span style="color: #00cc74;">出席</span>&emsp;{{ $classdatum->attendance }}</h3>
                        </li>
                        <li class="list-group-item">
                            <h3><span style="color: #00cc74;">授業の場所</span>&emsp;{{ $classdatum->class_place }}</h3>
                        </li>
                        <li class="list-group-item">
                            <h3><span style="color: #00cc74;">曜日・時限</span>&emsp;{{ $classdatum->class_week_day }}{{ $classdatum->class_time }}限</h3>
                        </li>    
                        <li class="list-group-item">
                            <h3><span style="color: #00cc74;">科目枠組1</span>&emsp;{{ $classdatum->division_1 }}</h3>
                        </li>  
                        <li class="list-group-item">
                            <h3><span style="color: #00cc74;">科目枠組2</span>&emsp;{{ $classdatum->division_2 }}</h3>
                        </li>          
                        <li class="list-group-item">
                            <h3><span style="color: #00cc74;">取得可能単位数</span>&emsp;{{ $classdatum->amount_credit }}</h3>
                        </li>
                    </ul>                       
                </div>               
            </article>
        @endsection