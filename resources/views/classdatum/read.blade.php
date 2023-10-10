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
                        $class_week_and_time = $class_week_day . $classdatum->class_time;                         
                    ?>
                    <script>
                        //曜日と時限で授業データを表示する場所を決めるために使う変数を用意 
                        var classKadai{{ $class_week_and_time }} = '';
                        // 授業の情報をまとめて表示するHTML要素を作成するための変数を用意
                        let classDetail{{ $class_week_and_time}} = '';
                        // 授業の名前を表示するHTML要素を作成するための変数
                        let className{{$class_week_and_time}} = '';
                        // 授業の教員…以下同文
                        let classTeacher{{ $class_week_and_time}} = '';
                        // 授業の場所…以下同文
                        let classPlace{{ $class_week_and_time}} = '' ;
                       
                        // 課題の残り時間を表示するHTML要素
                        let taskDeadline{{ $class_week_and_time}} = '';
                        
                        // ドロップダウンメニューのdiv要素を格納するHTML要素
                        let dropdownDiv{{ $class_week_and_time}} = '';
                        
                        // ドロップダウンメニューのタイトル
                        let dropdownTitle{{ $class_week_and_time}} = '';
                        // タイトルとメニューの境界
                        let dropdownDivider{{ $class_week_and_time}} = '';
                        // ドロップダウンメニューの選択肢のul
                        let dropdownUl{{ $class_week_and_time}} = '';
                        // ドロップダウンメニューの選択肢li
                        let dropdownLi1{{ $class_week_and_time}} = '';
                        // ドロップダウンメニュー、li内のaタグ
                        let dropdownA_in_Li1{{ $class_week_and_time}} = '';
                       
                        // ドロップダウンメニューの選択肢li
                        let dropdownLi3{{ $class_week_and_time}} = '';
                        // ドロップダウンメニュー、li内のaタグ
                        let dropdownA_in_Li3{{ $class_week_and_time}} = '';
                        // ドロップダウンメニューの選択肢li

                         // ドロップダウンメニューの選択肢li
                         let dropdownLi4{{ $class_week_and_time}} = '';
                        // ドロップダウンメニュー、li内のaタグ
                        let dropdownA_in_Li4{{ $class_week_and_time}} = '';
                        // ドロップダウンメニューの選択肢li
                        
                    </script>

                    <?php
                     // 授業名を格納
                     $class_detail_name = $classdatum->class_name;
                     // 授業教員名を格納
                    $class_detail_teacher = '教員名:'.$classdatum->teacher_name;
                    //  // 授業場所を格納
                      $class_detail_place = '場所:'.$classdatum->class_place;
                    //  課題を格納
                    $task = $classdatum->deadline;
                    ?>

                    <script>
                         //選択した曜日、時限によって取得するHTML要素を変えている。上のテーブルでid=mon1とかめっちゃ書いてたやつから選んでくる
                        classKadai{{ $class_week_and_time}} = document.getElementById('{{ $class_week_day }}{{ $classdatum->class_time}}');

                        // 授業の詳細を表示するためのHTML要素を作成
                        classDetail{{ $class_week_and_time}} = document.createElement('div');
                        
                      

                        // classDetailの中で授業名を表示するために作成
                        // 授業名を押すと課題を追加等のメニューをドロップダウンで表示する
                        className{{ $class_week_and_time}} = document.createElement('a');
                        className{{ $class_week_and_time}}.setAttribute("class", "mx-1 mb-1 fw-bold dropdown d-flex justify-content-center");
                        className{{ $class_week_and_time}}.setAttribute("id", "dropdownMenuButton1");
                        className{{ $class_week_and_time}}.href = "#";
                        className{{ $class_week_and_time}}.setAttribute("data-bs-toggle", "dropdown");
                        className{{ $class_week_and_time}}.setAttribute("aria-expanded", "false");

                       
                        // ドロップダウンメニューのための要素を作成
                        // ドロップダウンメニューとトリガーの授業名aタグを全て格納するdiv
                        dropdownDiv{{ $class_week_and_time}} = document.createElement('div');
                        // ドロップダウンメニューのタイトル(何の授業のメニューかが分かるように)
                        dropdownTitle{{ $class_week_and_time}} = document.createElement('li');
                        // ドロップダウンメニューのタイトルとメニューの境界線に利用する要素
                        dropdownDividerLi{{ $class_week_and_time}} = document.createElement('li');
                        dropdownDividerHr{{ $class_week_and_time}} = document.createElement('hr');

                        // メニューに使用する要要素たち
                        dropdownUl{{ $class_week_and_time}} = document.createElement('ul');
                        dropdownLi1{{ $class_week_and_time}} = document.createElement('li');
                        dropdownA_in_Li1{{ $class_week_and_time}} =document.createElement('a');
                       
                        dropdownLi3{{ $class_week_and_time}} = document.createElement('li');
                        dropdownA_in_Li3{{ $class_week_and_time}} = document.createElement('a');

                        dropdownLi4{{ $class_week_and_time}} = document.createElement('li');
                        dropdownA_in_Li4{{ $class_week_and_time}} = document.createElement('a');
                        

                        // ドロップダウンメニューを起動させるための属性を追加
                        dropdownDiv{{ $class_week_and_time}}.setAttribute("class", "dropdown mt-1 ");
                        

                        

                        dropdownUl{{ $class_week_and_time}}.setAttribute("aria-labelledby", "dropdownMenuButton1");
                        dropdownUl{{ $class_week_and_time}}.setAttribute("class", "dropdown-menu");

                        // ドロップダウンメニューのタイトル
                        dropdownTitle{{ $class_week_and_time}}.setAttribute("class", "dropdown-item fw-bold");
                        dropdownTitle{{ $class_week_and_time}}.textContent = "{{ $classdatum->class_name}}";

                        // タイトルとメニューの境界線
                        dropdownDividerHr{{ $class_week_and_time}}.setAttribute("class", "dropdown-divider");
                        dropdownDividerLi{{ $class_week_and_time}}.appendChild(dropdownDividerHr{{ $class_week_and_time}});

                        dropdownA_in_Li1{{ $class_week_and_time}}.setAttribute("class", "dropdown-item");
                        dropdownA_in_Li1{{ $class_week_and_time}}.href = "{{ route('classdata.show', $classdatum)}}";
                        dropdownA_in_Li1{{ $class_week_and_time}}.textContent = '授業の詳細';
                        dropdownLi1{{ $class_week_and_time}}.appendChild(dropdownA_in_Li1{{ $class_week_and_time}});

                        dropdownA_in_Li3{{ $class_week_and_time}}.setAttribute("class", "dropdown-item");
                        dropdownA_in_Li3{{ $class_week_and_time}}.href = "#";
                        dropdownA_in_Li3{{ $class_week_and_time}}.setAttribute("data-bs-toggle", "modal");
                        dropdownA_in_Li3{{ $class_week_and_time}}.setAttribute("data-bs-target", "#addTask{{ $classdatum->id }}");
                        dropdownA_in_Li3{{ $class_week_and_time}}.textContent = '課題を追加';
                        dropdownLi3{{ $class_week_and_time}}.appendChild(dropdownA_in_Li3{{ $class_week_and_time}});

                        dropdownA_in_Li4{{ $class_week_and_time}}.setAttribute("class", "dropdown-item");
                        dropdownA_in_Li4{{ $class_week_and_time}}.href = "#";
                        dropdownA_in_Li4{{ $class_week_and_time}}.setAttribute("data-bs-toggle", "modal");
                        dropdownA_in_Li4{{ $class_week_and_time}}.setAttribute("data-bs-target", "#deleteTask{{ $classdatum->id }}");
                        dropdownA_in_Li4{{ $class_week_and_time}}.textContent = '課題を削除';
                        dropdownLi4{{ $class_week_and_time}}.appendChild(dropdownA_in_Li4{{ $class_week_and_time}});


                        // 作成したHTML要素(ドロップダウンメニュー)を親に格納していく
                        dropdownUl{{ $class_week_and_time}}.appendChild(dropdownTitle{{ $class_week_and_time}});
                        dropdownUl{{ $class_week_and_time}}.appendChild(dropdownDividerLi{{ $class_week_and_time}});
                        dropdownUl{{ $class_week_and_time}}.appendChild(dropdownLi1{{ $class_week_and_time}});
                        dropdownUl{{ $class_week_and_time}}.appendChild(dropdownLi3{{ $class_week_and_time}});
                        dropdownUl{{ $class_week_and_time}}.appendChild(dropdownLi4{{ $class_week_and_time}});
                        

                        dropdownDiv{{ $class_week_and_time}}.appendChild(className{{ $class_week_and_time}});
                        dropdownDiv{{ $class_week_and_time}}.appendChild(dropdownUl{{ $class_week_and_time}});


                        // 課題の締め切りを表示する
                        taskDeadline{{ $class_week_and_time}} = document.createElement('p');
                        taskDeadline{{ $class_week_and_time}}.setAttribute("class", "mx-1 mb-1")
                        </script>
                        
                            @if($task !== null) 
                                    
                                    
                                <script>
                                        var date{{ $class_week_and_time}} = new Date()
                                        var diftime{{ $class_week_and_time}} = {{strtotime($classdatum->deadline)}} - date{{ $class_week_and_time}}.getTime() / 1000;
                                        var timestamp{{ $class_week_and_time}} = () => {
                                                diftime{{ $class_week_and_time}}--;
                                            } 
                                            var nowTimeStamp{{ $class_week_and_time}} = setInterval(() => {
                                                taskDeadline{{ $class_week_and_time}}.innerHTML = '';   

                                                timestamp{{ $class_week_and_time}}();
                                                    
                                                var diffTime_seconds{{ $class_week_and_time}} = diftime{{ $class_week_and_time}} % 60;

                                                var difMinutes{{ $class_week_and_time}} = (diftime{{ $class_week_and_time}} - diffTime_seconds{{ $class_week_and_time}}) / 60;
                                                var diffTime_minutes{{ $class_week_and_time}} = difMinutes{{ $class_week_and_time}} % 60;

                                                var difHours{{ $class_week_and_time}} = (difMinutes{{ $class_week_and_time}} - diffTime_minutes{{ $class_week_and_time}}) / 60;
                                                var diffTime_hours{{ $class_week_and_time}} = difHours{{ $class_week_and_time}} % 24;

                                                var difDays{{ $class_week_and_time}} = (difHours{{ $class_week_and_time}} - diffTime_hours{{ $class_week_and_time}}) / 24;
                                                
                                                taskDeadline{{ $class_week_and_time}}.innerHTML = '課題期限<br>残り' + difDays{{ $class_week_and_time}} + '日と' + diffTime_hours{{ $class_week_and_time}} + 'h' + diffTime_minutes{{ $class_week_and_time}} + 'm';
                                                // diffTime_seconds{{ $class_week_and_time}} + '秒'

                                                if(diftime{{ $class_week_and_time}} < 0){
                                                    clearInterval(nowTimeStamp{{ $class_week_and_time}});
                                                    taskDeadline{{ $class_week_and_time}}.innerHTML = '課題期限<br>期限切れ';
                                                }
                                                
                                            }, 1000);
                                            
                                        
                                        </script>
                        @endif
                        
                        
                    <script>
                        // 作成した授業の詳細、編集・削除・履修済みに登録ボタンを全てclassDetailのDiv要素に突っ込む
                        classDetail{{ $class_week_and_time}}.appendChild(dropdownDiv{{ $class_week_and_time}});
                        classDetail{{ $class_week_and_time}}.appendChild(className{{ $class_week_and_time}});
        
                        classDetail{{ $class_week_and_time}}.appendChild(taskDeadline{{ $class_week_and_time}});
                        

                        // 授業名・教員名・場所を各要素に文として差し込む
                        className{{ $class_week_and_time}}.innerHTML = '{{ $class_detail_name }}';

                        // 授業の詳細を曜日と時限で取得したＨＴＭＬ要素の子要素に追加する
                        classKadai{{ $class_week_and_time}}.appendChild(classDetail{{ $class_week_and_time}});
                        classKadai{{ $class_week_and_time}}.setAttribute("class", "bg-primary-subtle p-0 border border-dark");
                                                
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