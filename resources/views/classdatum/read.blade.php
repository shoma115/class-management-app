@extends('layouts.app')
    @section('content')
    @include('modals.modals_classdata.alert_deleteAll')
    @include('modals.modals_classdata.alert_classdata')
            <nav>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="#" class="btn btn-outline-secondary rounded-pill mx-1 mb-1" data-bs-toggle = "modal" data-bs-target = "#migrationAll">全授業を履修済みへ</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-danger rounded-pill mx-1 mb-1" data-bs-toggle = "modal" data-bs-target = "#alert">注意事項</a>
                    </div>
                    <div>
                </div>
            </nav>

            <article class="pb-2">
                <div class="week-column">
                    <div class="item p-1 bg-secondary text-white border th"></div>
                    @foreach($weeks as $week)
                        <div class="item p-1 bg-secondary text-white border th">{{$week}}</div>
                    @endforeach
                </div>

                <div class="line-table-union">
                    <div class="periods-line">
                        @foreach($periods as $period)
                            <div class="p-0 bg-secondary-subtle border-top border-dark th">{{ $period }}</div>
                        @endforeach
                    </div>

                    <div class="lesson-table">
                        @foreach($timetable as $timetable_cell)
                                    <a class="cell p-1 th" href="{{ $timetable_cell['route'] }}">
                                        <div class="name">{{ $timetable_cell['class_name'] }}</div><br>
                                        <div class="place">{{ $timetable_cell['class_place'] }}</div>
                                    </a>                            
                        @endforeach
                    </div>
                </div>
            </article>
        @endsection