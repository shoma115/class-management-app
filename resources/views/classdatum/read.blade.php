@extends('layouts.app')
    @section('content')
    @include('modals.modals_classdata.alert_deleteAll')
    @include('modals.modals_classdata.alert_classdata')
            <nav>
                <div class="d-flex justify-content-between">
                    <div>
                        <a href="#" class="btn btn-outline-secondary rounded-pill mx-1 mb-1" data-bs-toggle = "modal" data-bs-target = "#migrationAll">全ての授業を単位取得済みにする</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-danger rounded-pill mx-1 mb-1" data-bs-toggle = "modal" data-bs-target = "#alert">注意事項</a>
                    </div>
                    <div>
                </div>
            </nav>

            <article class="pb-2">
                
                         
                <table class="table p-0 border">
                    <tr>
                        <td style="width: 2%" class="bg-secondary text-white"></td>
                        <th id="mon" style="width: 15%" class="p-1 bg-secondary text-white border th">月</th>
                        <th id="tue" style="width: 15%" class="p-1 bg-secondary text-white border th">火</th>
                        <th id="wed" style="width: 15%" class="p-1 bg-secondary text-white border th">水</th>
                        <th id="thu" style="width: 15%" class="p-1 bg-secondary text-white border th">木</th>
                        <th id="fri" style="width: 15%" class="p-1 bg-secondary text-white border th">金</th>
                        <th id="sat" style="width: 15%" class="p-1 bg-secondary text-white border th">土</th>
                    </tr>
                    <tr>
                        <th class="p-0 my-auto time bg-secondary-subtle border-top border-dark th" style="height: 120px">一限目</th>
                        <td id="mon1" class="p-0 border border-dark"></td>
                        <td id="tue1" class="p-0 border border-dark"></td>
                        <td id="wed1" class="p-0 border border-dark"></td>
                        <td id="thu1" class="p-0 border border-dark"></td>
                        <td id="fri1" class="p-0 border border-dark"></td>
                        <td id="sat1" class="p-0 border border-dark"></td>
                    </tr>
                    <tr>
                        <th class="p-0 time bg-secondary-subtle border-top border-dark th" style="height: 120px">二限目</th>
                        <td id="mon2" class="p-0 border border-dark"></td>
                        <td id="tue2" class="p-0 border border-dark"></td>
                        <td id="wed2" class="p-0 border border-dark"></td>
                        <td id="thu2" class="p-0 border border-dark"></td>
                        <td id="fri2" class="p-0 border border-dark"></td>
                        <td id="sat2" class="p-0 border border-dark"></td>
                       
                    </tr>
                    <tr>
                        <th class="p-0 time bg-secondary-subtle border-top border-dark th" style="height: 120px">三限目</th>
                        <td id="mon3" class="p-0 border border-dark"></td>
                        <td id="tue3" class="p-0 border border-dark"></td>
                        <td id="wed3" class="p-0 border border-dark"></td>
                        <td id="thu3" class="p-0 border border-dark"></td>
                        <td id="fri3" class="p-0 border border-dark"></td>
                        <td id="sat3" class="p-0 border border-dark"></td>
                      
                    </tr>
                    <tr>
                        <th class="p-0 time bg-secondary-subtle border-top border-dark th" style="height: 120px">四限目</th>
                        <td id="mon4" class="p-0 border border-dark"></td>
                        <td id="tue4" class="p-0 border border-dark"></td>
                        <td id="wed4" class="p-0 border border-dark"></td>
                        <td id="thu4" class="p-0 border border-dark"></td>
                        <td id="fri4" class="p-0 border border-dark"></td>
                        <td id="sat4" class="p-0 border border-dark"></td>
                    </tr>
                    <tr>
                        <th class="p-0 time bg-secondary-subtle border-top border-dark th" style="height: 120px">五限目</th>
                        <td id="mon5" class="p-0 border border-dark"></td>
                        <td id="tue5" class="p-0 border border-dark"></td>
                        <td id="wed5" class="p-0 border border-dark"></td>
                        <td id="thu5" class="p-0 border border-dark"></td>
                        <td id="fri5" class="p-0 border border-dark"></td>
                        <td id="sat5" class="p-0 border border-dark"></td>
                    </tr>
                    @php
                        $weekday = array("月曜" => "mon", 
                                     "火曜" => "tue",
                                     "水曜" => "wed",
                                     "木曜" => "thu",
                                     "金曜" => "fri",
                                     "土曜" => "sat",
                                    );
                    @endphp

                    @foreach($classdata as $classdatum)
                    @include('modals.modals_classdata.delete_classdata')
                    @include('modals.modals_classdata.add_task')
                    @include('modals.modals_classdata.delete_task')
                    <!-- mon1,thu2などの変数を指定。これでJSを取得する -->
                    <?php  
                        $class_week_day = $weekday[$classdatum->class_week_day];
            $class_week_day . $classdatum->class_time;                         
                    ?>
                    <script>
                        var classaaaa = document.getElementById("classdata");

                        //曜日と時限で授業データを表示する場所を決めるために使う変数を用意 
                        var classKadai = '';
                        // 授業の情報をまとめて表示するHTML要素を作成するための変数を用意
                        var classDetail = '';
                        // 授業の名前を表示するHTML要素を作成するための変数
                        var className = '';
                        // 授業の場所…以下同文
                        var classPlace = '' ;                        

                         //選択した曜日、時限によって取得するHTML要素を変えている。上のテーブルでid=mon1とかめっちゃ書いてたやつから選んでくる
                        classKadai = document.getElementById('{{ $class_week_day }}{{ $classdatum->class_time}}');

                        // 授業の詳細を表示するためのHTML要素を作成
                        classDetail = document.createElement('a');
                        classDetail.href = "{{ route('classdata.show', $classdatum)}}";
                        
                      

                        // classDetailの中で授業名を表示するために作成
                        // 授業名を押すと課題を追加等のメニューをドロップダウンで表示する
                        className = document.createElement("div");
                        classPlace = document.createElement("div")
                        
                        classDetail.appendChild(className);
                        classDetail.appendChild(classPlace);
                        // 授業名・場所を各要素に文として差し込む
                        className.innerHTML = '{{ $classdatum->class_name }}';
                        classPlace.innerHTML = '{{ $classdatum->class_place }}';

                        // 授業の詳細を曜日と時限で取得したＨＴＭＬ要素の子要素に追加する
                        classKadai.appendChild(classDetail);
                        classKadai.setAttribute("class", "bg-primary-subtle p-0 border border-dark");
                                                
                    </script>
                    @endforeach

                    <script>
                        let WAT = '';
                        let addClass = '';
                    </script>

                        <?php
                        $weekAndTimes = ['mon1', 'mon2', 'mon3', 'mon4', 'mon5', 'tue1', 'tue2', 'tue3', 'tue4', 'tue5', 'wed1', 'wed2', 'wed3', 'wed4', 'wed5', 'thu1', 'thu2', 'thu3', 'thu4', 'thu5', 'fri1', 'fri2', 'fri3', 'fri4', 'fri5', 'sat1', 'sat2', 'sat3', 'sat4', 'sat5'];
                        $weekDay = ['月曜', '火曜', '水曜', '木曜', '金曜', '土曜'];
                        $classTime = [1, 2, 3, 4, 5];
                        $weekDayCount = 0;
                        $classTimeCount = 0;
                        ?>
                        
                        @foreach($weekAndTimes as $weekAndTime)
                            <script>                                
                                if({{$weekAndTime}}.childElementCount === 0) {               
                                        addClass = document.createElement('a');
                                        addClass.textContent = '+';
                                        addClass.setAttribute("class", "add-class fs-4 text-decoration-none d-flex align-items-center justify-content-center text-black-50");
                                        addClass.setAttribute("style", "height: 120px");
                                        addClass.href = '{{ route('resource.select', ['week' => $weekDay[$weekDayCount], 'time' => $classTime[$classTimeCount]]) }}'
                                        {{$weekAndTime}}.appendChild(addClass);       
                                }
                            </script>
                            <?php
                            $classTimeCount++;
                            if( $classTimeCount % 5 === 0) {
                                $classTimeCount = 0;
                                $weekDayCount++;
                            }
                            ?>
                        @endforeach
                                                    
                   
                </table>
              
            </article>
        @endsection