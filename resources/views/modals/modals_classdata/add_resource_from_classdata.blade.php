<div class="modal fade" id="addResource" tabindex="-1" aria-labelledby="addResourceLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addResourceLabel"><span class="fw-bold">{{ $week }}{{ $time }}限の授業を作成</span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"
                @if($errors->any())
                <div>
                    <ul>
                    @foreach($errors->all() as $error)
                    
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                 
                <form action="{{ route('resource.store', ['week' => $week, 'time' => $time]) }}" method="POST">
                @csrf
                
                <!-- input要素やselectボックスでは、取得したデータをvalueで初期値に設定している -->
                    <div class="d-flex flex-column">
                        <label class="fs-5 fw-bold">授業名<span style="color:red">【必須】</span></label>
                        <input type="text" name="class_name" value="{{ old('class_name') }}" required>

                        <label class="fs-5 fw-bold">教員名</label>
                        <input type="text" name="teacher_name"  value="{{ old('teacher_name') }}" >

                        <label class="fs-5 fw-bold">授業の場所</label>
                        <input type="text" name="class_place" value="{{ old('class_place') }}">
                        
                        <label class="fs-5 fw-bold">評価方法</label>
                                    <select name="evaluation">
                                        <?php
                                            $evaluation = ['分らない', 'テスト(1回)のみ', 'テスト(複数回)のみ', 'レポート(期末あり)のみ', 'レポート(期末なし)のみ', '出席のみ', 'テスト+レポート', 'レポート+出席', 'テスト+出席', 'テスト+レポート+出席'];
                                        ?>
                                            @for($i = 0; $i < count($evaluation); $i++)
                                                @if( old('evaluation') === $evaluation[$i])
                                                    <option selected>{{ $evaluation[$i] }}</option>
                                                @else
                                                    <option>{{ $evaluation[$i] }}</option>
                                                @endif
                                            @endfor   
                                    </select>
                              
                        <label class="fs-5 fw-bold">出席</label>
                                    <select name="attendance">
                                        <?php
                                            $attendance = ['分らない', '毎回とる', 'たまにとる', 'とらない'];
                                        ?>
                                            @for($i = 0; $i < count($attendance); $i++)
                                            @if( old('evaluation') === $attendance[$i])
                                                <option selected>{{ $attendance[$i] }}</option>
                                            @else
                                                <option>{{ $attendance[$i] }}</option>
                                            @endif
                                            @endfor   
                                    </select>

                        <label class="fs-5 fw-bold">曜日</label>
                        <select name="class_week_day">
                            <?php
                                $weeks = ['月曜', '火曜', '水曜', '木曜', '金曜', '土曜', '日曜'];
                            ?>
                            @for($i = 0; $i < 7; $i++)
                                @if( old('class_week_day') === $weeks[$i])
                                <option selected>{{ $weeks[$i] }}</option> 
                                @elseif($week === $weeks[$i])
                                <option selected>{{ $weeks[$i] }}</option>
                                @else
                                <option>{{ $weeks[$i] }}</option>
                            
                                @endif
                            @endfor   
                        </select>

                        <label class="fs-5 fw-bold">時限</label>
                        <select name="class_time">
                        <?php
                                $times = [1, 2, 3, 4, 5];
                            ?>
                            @for($i = 0; $i < 5; $i++)
                                @if((int)old('class_time') === $times[$i])
                                <option selected>{{ $times[$i] }}</option>
                                @elseif((int)$time === $times[$i])
                                <option selected>{{ $times[$i] }}</option>
                                @else
                                <option>{{ $times[$i] }}</option>
                                @endif
                            @endfor 
                        </select>

                        <label class="fs-5 fw-bold">科目枠組1</label>
                            <select name="division1" class="division1">
                                        <?php
                                            $division1 = ['共通教育', '専門教育', '他学科・他学部科目', 'その他'];
                                        ?>
                                            @for($i = 0; $i < count($division1); $i++)
                                                @if( old('division1') === $division1[$i])
                                                    <option selected value="{{ $division1[$i] }}">{{ $division1[$i] }}</option>
                                                @else
                                                    <option value="{{ $division1[$i] }}">{{ $division1[$i] }}</option>
                                                @endif
                                            @endfor   
                                    </select>

                        <div class="division2">
                            <label class="fs-5 fw-bold">科目枠組2</label>
                                <select name="division2" class="division2_list">
                                        <?php
                                            $division2 = ['分らない', '初年次教育科目', 'グローバル教育科目', '人文・社会科学分野・初修外国語', '人文・社会科学分野・選択科目', '自然科学分野・選択科目', '統合Ⅰ', '統合Ⅱ' ];
                                        ?>
                                            @for($i = 0; $i < count($division2); $i++)
                                                @if( old('division2') === $division2[$i])
                                                    <option selected>{{ $division2[$i] }}</option>
                                                @else
                                                    <option>{{ $division2[$i] }}</option>
                                                @endif
                                            @endfor   
                                        
                                    </select>
                        </div>

                        <div class="division3">
                            <label class="fs-5 fw-bold">科目枠組2</label>
                                <select name="division2" class="division3_list">
                                        <?php
                                            $division3 = ['分らない', '法文スタンダード科目', '学科共通科目・必修', '学科共通科目・選択', '地域社会コース科目・必修', '地域社会コース科目・選択', '他コース(法経社会学科)科目', '法文アドバンスト科目Ⅰ', '法文アドバンスト科目Ⅱ' ];
                                        ?>
                                            @for($i = 0; $i < count($division3); $i++)
                                                @if( old('division2') === $division3[$i])
                                                    <option selected>{{ $division3[$i] }}</option>
                                                @else
                                                    <option>{{ $division3[$i] }}</option>
                                                @endif
                                            @endfor   
                                    </select>
                        </div>
                        
                        <script>
                            var division1 = $(".division1");
                            var division2 = $(".division2");
                            var division3 = $(".division3");
                            var division2List = $(".division2_list");
                            var division3List = $(".division3_list");
                            var div1Value = $(division1).val();
                            console.log(div1Value)
                            
                            // 初期値で表示を変える
                            if(div1Value === '共通教育') {
                                division3.hide();
                                division2.show();
                                division2List.prop('disabled', false);
                                division3List.prop('disabled', true);

                            }else if(div1Value === '専門教育') {
                                division2.hide();
                                division3.show();
                                division2List.prop('disabled', true);
                                division3List.prop('disabled', false);
                            }else if(div1Value === '他学科・他学部科目' || 'その他') {
                                division2.hide();
                                division3.hide();
                                division2List.prop('disabled', true);
                                division3List.prop('disabled', true);
                            };

                            division1.change(function() {
                                var div1Value = $(this).val();
                                // 科目枠組1で「共通教育」を選んでいた場合
                                if(div1Value === '共通教育') {
                                    division3.hide();
                                    division2.show();
                                    division2List.prop('disabled', false);
                                    division3List.prop('disabled', true);
                                   

                                    // 科目枠組1で「専門教育」を選んだ場合
                                }else if(div1Value === '専門教育') {
                                    division2.hide();
                                    division3.show();
                                    division2List.prop('disabled', true);
                                    division3List.prop('disabled', false);
                                    // 科目枠組み1で他学部科目を選んだ
                                }else if(div1Value === '他学科・他学部科目' || 'その他') {
                                division2.hide();
                                division3.hide();
                                division2List.prop('disabled', true);
                                division3List.prop('disabled', true);
                            };
                            });
                        </script>


                        <label class="fs-5 fw-bold" required>単位数<span style="color:red">【必須】</span></label>
                        <input type="number" name="amount_credit" value="{{ old('amount_credit') }}">
                    </div>
                    <button type="submit" class="button-all btn text-white rounded-pill m-2" name="submit" value="create">登録</button>
                </form>
      </div>
    </div>
  </div>
</div>