@extends('layouts.app')
    @section('content')
            <article>
                <input id="week" type="hidden" value="{{ $week }}"></input>
                <input id="time" type="hidden" value="{{ $time }}"></input>
                <input id="autocompleteRoute" type="hidden" value="{{ route('select.suggest') }}"></input>

                <a href="{{ route('classdata.read') }}">
                    <img class="back-button" src="{{ asset('backbutton.img\プレゼンテーション4-removebg-preview.png') }}" width="30">
                </a>
                <h1 class="fw-bold m-4">{{ $week }}{{ $time }}限の授業</h1>
                <div class="m-4">
                    @include('modals.modals_classdata.add_resource_from_classdata')
                    <p>
                        時間割に追加する授業を選んでください。<br>
                        追加したい授業が無いときは
                        <a href="{{ route('resource.create', ['week' => $week, 'time' => $time]) }}" role = "button" data-bs-toggle = "modal" data-bs-target = "#addResource">授業を追加する</a>
                    </p>
                    
                    
                    <form action="{{ route('resource.select', ['week' => $week, 'time' => $time, 'search' => 1] ) }}" method="GET" autocomplete="off">
                        <input type="text" id="searchForm"  name="search" placeholder="授業名で検索">
                        <button type="submit"><img src="{{ asset('search.img\ei-search.png') }}" width = "20" height = "20"></button>
                    </form>
                    <a href="{{ route('resource.select', ['week' => $week, 'time' => $time] ) }}">検索をクリア</a>
                </div>
                <table class="table">
                    <tr>
                        <th>授業名</th>
                        <th>教員名</th>
                        <th>曜日・時限</th>
                        <th>単位数</th>
                        <th><th>
                    </tr>
                    @foreach($resources as $resource) 
                    <tr>
                        <td>{{ $resource->class_name }}</td>
                        <td>{{ $resource->teacher_name }}</td>
                        <td>{{ $resource->class_week_day . $resource->class_time }}限</td>
                        <td>{{ $resource->amount_credit }}</td>
                        <td><a href="{{ route('select.store', $resource) }}" class="button-all btn text-white rounded-pill btn-sm">追加</a></td>      
                    </tr>
                    @endforeach
                </table>

            </article>
            <script src="{{  asset('js\classdata_autocomplete.js') }}"></script>
        @endsection