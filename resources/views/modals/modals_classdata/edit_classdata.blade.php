<div class="modal fade" id="editClassDatum{{ $classdatum->id }}" tabindex="-1" aria-labelledby="editClassDatumLabel{{ $classdatum->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="editClassDatumLabel{{ $classdatum->id }}">授業情報の編集</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                @if($errors->any())
                <div>
                    <ul>
                    @foreach($errors->all() as $error)
                    
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                        
                <form action="{{ route('classdata.update', $classdatum) }}" method="POST">
                @csrf
                @method('patch')
                <!-- input要素やselectボックスでは、取得したデータをvalueで初期値に設定している -->
                    <div class="d-flex flex-column">
                        <label class="fs-5 fw-bold">授業名<span style="color:red">【必須】</span></label>
                        <input class="form-control" type="text" name="class_name" value="{{ old('class_name', $classdatum->class_name) }}" required>

                        <label class="fs-5 fw-bold">教員名</label>
                        <input class="form-control" type="text" name="teacher_name"  value="{{ old('teacher_name', $classdatum->teacher_name) }}" >

                        <label class="fs-5 fw-bold">評価</label>
                                    <select class="form-control" name="evaluation">
                                        <?php
                                            $evaluation = ['テスト(1回)のみ', 'テスト(複数回)のみ', 'レポート(期末あり)のみ', 'レポート(期末なし)のみ', '出席のみ', 'テスト+レポート', 'レポート+出席', 'テスト+出席', 'テスト+レポート+出席'];
                                        ?>
                                            @for($i = 0; $i < count($evaluation); $i++)
                                            @if( old('evaluation') === $evaluation[$i])
                                                <option selected>{{ $evaluation[$i] }}</option>
                                            @elseif($classdatum->evaluation === $evaluation[$i])
                                                <option selected>{{ $evaluation[$i] }}</option>
                                            @else
                                                <option>{{ $evaluation[$i] }}</option>
                                            @endif
                                            @endfor   
                                    </select>
                              
                        <label class="fs-5 fw-bold">出席</label>
                                    <select class="form-control"  name="attendance">
                                        <?php
                                            $attendance = [ '毎回とる', 'たまにとる', 'とらない'];
                                        ?>
                                            @for($i = 0; $i < count($attendance); $i++)
                                            @if( old('evaluation') === $attendance[$i])
                                                <option selected>{{ $attendance[$i] }}</option>
                                            @elseif($classdatum->attendance === $attendance[$i])
                                                <option selected>{{ $attendance[$i] }}</option>
                                            @else
                                                <option>{{ $attendance[$i] }}</option>
                                            @endif
                                            @endfor   
                                    </select>
                                    
                        <label class="fs-5 fw-bold">授業の場所</label>
                        <input class="form-control" type="text" name="class_place" value="{{ old('class_place', $classdatum->class_place) }}">

                        <label class="fs-5 fw-bold">曜日</label>
                        <select class="form-control" name="class_week_day">
                            <?php
                                $week = ['月曜', '火曜', '水曜', '木曜', '金曜', '土曜', '日曜'];
                            ?>
                            @for($i = 0; $i < 7; $i++)
                                @if( old('class_week_day') === $week[$i])
                                <option selected>{{ $week[$i] }}</option>
                                @elseif ( $classdatum->class_week_day === $week[$i])
                                <option selected>{{ $week[$i] }}</option>
                                @else
                                <option>{{ $week[$i] }}</option>
                                @endif
                            @endfor   
                        </select>

                        <label class="fs-5 fw-bold">時限</label>
                        <select class="form-control" name="class_time">
                            @for($i = 1; $i < 6; $i++)
                                @if((int)old('class_time') === $i)
                                <option selected>{{ $i }}</option>
                                @elseif($classdatum->class_time === $i)
                                <option selected>{{ $i }}</option>
                                @else
                                <option>{{ $i }}</option>
                                @endif
                            @endfor 
                        </select>

                        <label class="fs-5 fw-bold">科目枠組1</label>
                            <select name="division1" class="division1 form-control">
                                        <?php
                                            $division1 = [ '共通教育', '専門教育', '他学科・他学部科目'];
                                        ?>
                                            @for($i = 0; $i < count($division1); $i++)
                                                @if( old('division1') === $division1[$i])
                                                    <option selected value="{{ $division1[$i] }}">{{ $division1[$i] }}</option>
                                                @elseif($classdatum->division_1 === $division1[$i])
                                                    <option selected value="{{ $division1[$i] }}">{{ $division1[$i] }}</option>
                                                @else
                                                    <option value="{{ $division1[$i] }}">{{ $division1[$i] }}</option>
                                                @endif
                                            @endfor   
                                    </select>

                                    <div class="division2">
                            <label class="fs-5 fw-bold">科目枠組2</label>
                                <select name="division2" class="division2_list form-control">
                                        <?php
                                            $division2 = [ '初年次教育科目', 'グローバル教育科目', '人文・社会科学分野・初修外国語', '人文・社会科学分野・選択科目', '自然科学分野・選択科目', '統合1', '統合2' ];
                                        ?>
                                            @for($i = 0; $i < count($division2); $i++)
                                                @if( old('division2') === $division2[$i])
                                                    <option selected>{{ $division2[$i] }}</option>
                                                @elseif($classdatum->division_2 === $division2[$i])
                                                    <option selected>{{ $division2[$i] }}</option>
                                                @else
                                                    <option>{{ $division2[$i] }}</option>
                                                @endif
                                            @endfor   
                                        
                                    </select>
                        </div>

                        <div class="division3">
                            <label class="fs-5 fw-bold">科目枠組2</label>
                                <select name="division2" class="division3_list form-control">
                                        <?php
                                            $division3 = [ '法文スタンダード科目', '学科共通科目・必修', '学科共通科目・選択', '地域社会コース科目・必修', '地域社会コース科目・選択', '他コース(法経社会学科)科目', '法文アドバンスト科目1', '法文アドバンスト科目2' ];
                                        ?>
                                            @for($i = 0; $i < count($division3); $i++)
                                                @if( old('division2') === $division3[$i])
                                                    <option selected>{{ $division3[$i] }}</option>
                                                @elseif($classdatum->division_2 === $division3[$i])
                                                    <option selected>{{ $division3[$i] }}</option>
                                                @else
                                                    <option>{{ $division3[$i] }}</option>
                                                @endif
                                            @endfor   
                                    </select>
                        </div>
                        <label class="fs-5 fw-bold">単位数<span style="color:red">【必須】</span></label>
                        <input class="form-control" type="number" name="amount_credit" value="{{ old('amount_credit', $classdatum->amount_credit) }}" required>
                    </div>
                    <button type="submit" class="button-all btn text-white rounded-pill m-2" name="submit" value="create">更新</button>
                </form>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js\modal_default_division.js') }}"> </script>