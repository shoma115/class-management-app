<div class="modal fade" id="editPost" tabindex="-1" aria-labelledby="editPostLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPostLabel">レビューの編集</h5>
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
                
                <form action="{{ route('review.update', $post) }}" method="POST">
                @csrf
                @method('patch')
                <!-- input要素やselectボックスでは、取得したデータをvalueで初期値に設定している -->
                    <div class="d-flex flex-column">
                        <label class="fw-bold">授業名<span style="color:red">【必須】</span></label>
                        <input type="text" name="class_name" value="{{ old('class_name', $post->class_name) }}" required>

                        <label class="fw-bold">単位取得の難しさ</label>
                            <div class="difficulty_level">
                                @for( $i = 5; $i > 0 ; $i--)
                                    @if((int)old('difficulty_level') === $i)
                                        <input id="difficulty_level{{$i}}" type="radio" name="difficulty_level" value="{{$i}}" checked>
                                        <label for="difficulty_level{{$i}}">★</label>
                                    @elseif($post->difficulty_level === $i)                                           
                                        <input id="difficulty_level{{$i}}" type="radio" name="difficulty_level" value="{{$i}}" checked>
                                        <label for="difficulty_level{{$i}}">★</label>
                                    @else
                                        <input id="difficulty_level{{$i}}" type="radio" name="difficulty_level" value="{{$i}}">
                                        <label for="difficulty_level{{$i}}">★</label>
                                    @endif
                                @endfor
                                       
                            </div>

                            <label class="fs-5 fw-bold">内容の面白さ</label>
                                    <div class="interesting">
                                        @for( $i = 5; $i > 0 ; $i--)
                                            @if((int)old('interesting') === $i)                                          
                                                <input id="interesting{{$i}}" type="radio" name="interesting" value="{{$i}}" checked>
                                                <label for="interesting{{$i}}">★</label>
                                            @elseif($post->interesting === $i)
                                                <input id="interesting{{$i}}" type="radio" name="interesting" value="{{$i}}" checked>
                                                <label for="interesting{{$i}}">★</label>
                                            @else
                                                <input id="interesting{{$i}}" type="radio" name="interesting" value="{{$i}}">
                                                <label for="interesting{{$i}}">★</label>
                                            @endif
                                        @endfor
                                       
                                    </div>
                                    <label class="fs-5 fw-bold">評価方法</label>
                                    <select class="form-control" name="evaluation">
                                    <?php
                                            $evaluation = ['分らない','テスト(1回)のみ', 'テスト(複数回)のみ', 'レポート(期末あり)のみ', 'レポート(期末なし)のみ', '出席のみ', 'テスト+レポート', 'レポート+出席', 'テスト+出席', 'テスト+レポート+出席'];
                                        ?>
                                            @for($i = 0; $i < count($evaluation); $i++)
                                            @if( old('evaluation') === $evaluation[$i])
                                                <option selected>{{ $evaluation[$i] }}</option>
                                            @elseif($post->evaluation === $evaluation[$i])
                                                <option selected>{{ $evaluation[$i] }}</option>
                                            @else
                                                <option>{{ $evaluation[$i] }}</option>
                                            @endif
                                            @endfor   
                                    </select>
                              
                                    <label class="fs-5 fw-bold">出席</label>
                                    <select class="form-control" name="attendance">
                                    <?php
                                            $attendance = ['分らない', '毎回とる', 'たまにとる', 'とらない'];
                                        ?>
                                            @for($i = 0; $i < count($attendance); $i++)
                                            @if( old('evaluation') === $attendance[$i])
                                                <option selected>{{ $attendance[$i] }}</option>
                                            @elseif($post->attendance === $attendance[$i])
                                                <option selected>{{ $attendance[$i] }}</option>
                                            @else
                                                <option>{{ $attendance[$i] }}</option>
                                            @endif
                                            @endfor   
                                    </select>
                               
                            

                        <label class="fw-bold">教員名</label>
                        <input type="text" name="teacher_name" value="{{ old('teacher_name', $post->teacher_name) }}">

                        <label class="fw-bold">曜日</label>
                        <select name="class_week_day" value="{{ $post->class_week_day }}">
                        <?php
                                $weeks = ['月曜', '火曜', '水曜', '木曜', '金曜', '土曜', '日曜'];
                            ?>
                            @for($i = 0; $i < 7; $i++)
                                @if(old('class_week_day') === $weeks[$i])
                                <option selected>{{ $weeks[$i] }}</option>
                                @elseif($post->class_week_day === $weeks[$i])
                                <option selected>{{ $weeks[$i] }}</option>
                                @else
                                <option>{{ $weeks[$i] }}</option>
                                @endif
                            @endfor   
                        </select>

                        <label class="fw-bold">時限</label>
                        <select name="class_time">
                            @for($i = 1; $i < 6; $i++)
                                @if((int)old('class_time') === $i)
                                    <option selected>{{ $i }}</option>
                                @elseif($post->class_time === $i)
                                    <option selected>{{ $i }}</option>
                                @else
                                    <option>{{ $i }}</option>
                                @endif
                            @endfor 
                        </select>

                        <label class="fw-bold">取得可能単位数<span style="color:red">【必須】</span></label>
                        <input type="number" name="amount_credit" min="1" value="{{ old('amount_credt', $post->amount_credit) }}" required>

                        
                        <label class="fw-bold">レビュー</label>
                       
                        <textarea name="content" rows="10">{{ old('content', $post->content) }}</textarea>
                    </div>
                    <button type="submit" class="button-all btn text-white rounded-pill m-1" name="submit" value="create">更新</button>
                </form>
      </div>
    </div>
  </div>
</div>