@extends('layouts.app')
    @section('content')
            <article class="pb-2">
                
                <h1 class="fw-bold m-3">レビューを投稿しませんか？</h1>
            
                @if($errors->any())
                <div>
                    <ul>
                    @foreach($errors->all() as $error)
                    
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('review.recostore', $classdatum) }}" method="POST">
                @csrf
                <table class="table">
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold">授業名</label>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="class_name" value="{{ old('class_name', $classdatum->class_name) }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold">楽単</label>
                                </td>
                                <td>
                                    <div class="difficulty_level">
                                        @for( $i = 5; $i > 0 ; $i--)
                                            @if((int)old('difficulty_level') === $i)                                          
                                                <input id="star{{$i}}" type="radio" name="difficulty_level" value="{{$i}}" checked>
                                                <label for="star{{$i}}">★</label>
                                            @else
                                                <input id="star{{$i}}" type="radio" name="difficulty_level" value="{{$i}}">
                                                <label for="star{{$i}}">★</label>
                                            @endif
                                        @endfor
                                       
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold">学び</label>
                                </td>
                                <td>
                                    <div class="interesting">
                                        @for( $i = 5; $i > 0 ; $i--)
                                            @if((int)old('interesting') === $i)                                          
                                                <input id="interesting{{$i}}" type="radio" name="interesting" value="{{$i}}" checked>
                                                <label for="interesting{{$i}}">★</label>
                                            @else
                                                <input id="interesting{{$i}}" type="radio" name="interesting" value="{{$i}}">
                                                <label for="interesting{{$i}}">★</label>
                                            @endif
                                        @endfor
                                       
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold">評価</label>
                                </td>
                                <td>
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
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold">出席</label>
                                </td>
                                <td>
                                    <select class="form-control" name="attendance">
                                        <?php
                                            $attendance = [ '毎回とる', 'たまにとる', 'とらない'];
                                        ?>
                                            @for($i = 0; $i < count($attendance); $i++)
                                                @if( old('attendance') === $attendance[$i])
                                                    <option selected>{{ $attendance[$i] }}</option>
                                                @elseif($classdatum->attendance === $attendance[$i])
                                                    <option selected>{{ $attendance[$i] }}</option>
                                                @else
                                                    <option>{{ $attendance[$i] }}</option>
                                                @endif
                                            @endfor   
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold">教員名</label>
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="teacher_name" value="{{ old('teacher_name', $classdatum->teacher_name) }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold">曜日</label>
                                </td>
                                <td>
                                    <select class="form-control" name="class_week_day">
                                        <?php
                                            $week = ['月曜', '火曜', '水曜', '木曜', '金曜', '土曜', '日曜'];
                                        ?>
                                            @for($i = 0; $i < 7; $i++)
                                            @if( old('class_week_day') === $week[$i])
                                                <option selected>{{ $week[$i] }}</option>
                                            @elseif( $classdatum->class_week_day === $week[$i])
                                                <option selected>{{ $week[$i] }}</option>
                                            @else
                                                <option>{{ $week[$i] }}</option>
                                            @endif
                                            @endfor   
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold">時限</label>
                                </td>
                                <td>
                                    <select class="form-control" name="class_time">
                                    @for($i = 1; $i < 6; $i++)
                                        @if((int)old('class_time') === $i)
                                            <option selected>{{ $i }}</option>
                                        @elseif( $classdatum->class_time === $i)
                                            <option selected>{{ $i }}</option>
                                        @else
                                            <option>{{ $i }}</option>
                                        @endif
                                        @endfor 
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold" >単位数</label>
                                </td>
                                <td>
                                    <input class="form-control" type="number" name="amount_credit" min="1" value="{{ old('amount_credit', $classdatum->amount_credit) }}">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="fs-5 fw-bold">レビュー</label>
                                </td>
                                <td>
                                <script src = "{{ asset('question.js/main.js') }}"></script>
                                    <textarea class="form-control" name="content">{{ old('content') }}</textarea>
                                </td>
                            </tr>
                        </table>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="button-all btn text-white rounded-pill w-50 mx-3" name="submit" value="create">投稿</button>
                    </div>
                </form>
                <form class="d-flex justify-content-center" action="{{ route('classdata.delete', $classdatum) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-outline-secondary rounded-pill w-50 m-3">投稿しない</button>
                </form> 
            </article>
        @endsection