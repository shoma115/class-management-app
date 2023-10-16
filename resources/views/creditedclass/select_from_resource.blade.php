@extends('layouts.app')
    @section('content')
    @include('modals.modals_credited.add_resource_from_credited')
    <article>
            <a href="{{ route('credited.read') }}">
                    <a  class="btn btn-secondary rounded-pill ms-3" href="{{ route('classdata.read') }}">戻る</a>
            </a>
            <div class="m-3">
                <h1>授業一覧</h1>
                <a href="#" class="create-button" role = "button" data-bs-toggle = "modal" data-bs-target = "#addResource"></a>
                <form action="{{ route('credited.select') }}" method="GET" autocomplete="off">
                    <input type="text" id="searchCredited"  name="search" placeholder="授業名で検索">
                   <button type="submit" class="search-button">
                            <div class="search icon"></div>
                        </button>
                </form>
                <a href="{{ route('credited.select') }}">検索をクリア</a>
            </div>
                <div class="justify-content-center">
                    {{ $resources->appends(Request::only('search'))->links('vendor.pagination.simple-bootstrap-4') }}
                    {{ $resources->total() }}件中
                    {{ $resources->firstItem() }}〜{{ $resources->lastItem() }} 件を表示
                </div>
                <script>
                     $.ajaxSetup({
                        headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content") },
                    })
                    $(document).ready( function() {
                        $('#searchCredited').autocomplete({
                            source: function(request, response) { 
                                        
                                $.ajax({
                                url: "{{ route('credited.suggest') }}",
                                method: "POST",
                                data: { search : request.term },
                                dataType: "json",
                                }).done(function(res){
                                    response(res.suggest);
                                    console.log(res.suggest);
                                    
                                    
                                }).fail(function(){
                                        alert('通信の失敗をしました');
                                });
                            }
                        })
                    })
                </script>
                
                <div>
                    <table class="table">
                        <tr>
                            <th></th>
                            <th>授業名</th>
                            <th>教員名</th>
                            <th>科目枠組</th>
                            <th>単位数</th>
                        </tr>
                        @foreach($resources as $resource)
                            <tr> 
                                <td><a href="{{ route('credited.store', $resource) }}" class="button-all p-0 btn text-white rounded-pill btn-sm">登録</a></td>
                                <td>{{ $resource->class_name }}</td>
                                <td>{{ $resource->teacher_name }}</td>
                                <td>{{ $resource->division_1 }}<br>{{ $resource->division_2 }}</td>
                                <td>{{ $resource->amount_credit }}</td>
                            <tr>
                        @endforeach
                    </table>
                </div>
    
                
            </article>
        @endsection