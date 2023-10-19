@extends('layouts.app')
    @section('content')
    @include('modals.modals_classdata.add_resource_from_classdata')
            <input id="week" type="hidden" value="{{ $week }}"></input>
            <input id="time" type="hidden" value="{{ $time }}"></input>
            <input id="autocompleteRoute" type="hidden" value="{{ route('select.suggest') }}"></input>
            <article>
                <a  class="btn btn-secondary rounded-pill ms-3" href="{{ route('classdata.read') }}">戻る</a>
                <h1 class="fw-bold m-4">{{ $week }}{{ $time }}限の授業</h1>
                <div class="m-4">
                   
                    <a class="create-button" href="{{ route('resource.create', ['week' => $week, 'time' => $time]) }}" role = "button" data-bs-toggle = "modal" data-bs-target = "#addResource"></a>

                    <form action="{{ route('resource.select', ['week' => $week, 'time' => $time, 'search' => 1] ) }}" method="GET" autocomplete="off">
                        <input type="text" id="searchForm"  name="search" placeholder="授業名で検索">
                        <button type="submit" class="search-button">
                            <div class="search icon"></div>
                        </button>
                    </form>
                    <a href="{{ route('resource.select', ['week' => $week, 'time' => $time] ) }}">検索をクリア</a>
                </div>
                <table class="table">
                    <tr>
                        <th></th>
                        <th>授業名</th>
                        <th>教員名</th>
                        <th>時限</th>
                        <th>単位数</th>
                    </tr>
                    @foreach($resources as $resource) 
                    <tr>
                        <td><a href="{{ route('select.store', $resource) }}" class="button-all btn text-white rounded-pill btn-sm">追加</a></td> 
                        <td>{{ $resource->class_name }}</td>
                        <td>{{ $resource->teacher_name }}</td>
                        <td>{{ $resource->class_week_day . $resource->class_time }}限</td>
                        <td>{{ $resource->amount_credit }}</td>
                    </tr>
                    @endforeach
                </table>

            </article>
            <script src="{{  asset('js\classdata_select.js') }}"></script>
        @endsection