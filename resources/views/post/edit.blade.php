<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>時間割アプリ</title>
        <meta name="description" content="時間割を作成するアプリです">
        <!-- <link rel="stylesheet" href="css/style.css"> -->
        <meta name="viewport" cotent="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <header>
            <nav>
                <a href="{{ route('index') }}">時間割作成アプリ</a>
            </nav>
        </header>
        <main>
            <article>
                <button><a href="{{ route('review.read') }}">戻る</a></button>
                <h1>授業情報の編集<h1> 
                <!-- 更新するデータを判別するために、read.phpから飛んできた際にもらったIDをURLに渡す -->
                <form action="{{ route('review.update', $post) }}" method="POST">
                @csrf
                @method('patch')
                <!-- input要素やselectボックスでは、取得したデータをvalueで初期値に設定している -->
                    <div>
                    <label>授業名</label>
                        <input type="text" name="class_name" value="{{ $post->class_name }}">

                        <label>授業の難易度</label>
                        <input type="number" name="difficulty_level" min="1" max="5" value="{{ $post->difficulty_level }}">
                        <!-- <input type="radio" name="difficulty_level" value="difficulty_level">5（難しい）
                        <input type="radio" name="difficulty_level" value="difficulty_level">4
                        <input type="radio" name="difficulty_level" value="difficulty_level">3
                        <input type="radio" name="difficulty_level" value="difficulty_level">2
                        <input type="radio" name="difficulty_level" value="difficulty_level">1（易しい） -->

                        <label>教員名</label>
                        <input type="text" name="teacher_name" value="{{ $post->teacher_name }}">

                        <label>曜日</label>
                        <select name="class_week_day" value="{{ $post->class_week_day }}">
                        <?php
                                $week = ['月曜', '火曜', '水曜', '木曜', '金曜', '土曜', '日曜'];
                            ?>
                            @for($i = 0; $i < 7; $i++)
                            @if($post->class_week_day === $week[$i])
                            <option selected>{{ $week[$i] }}</option>
                            @else
                            <option>{{ $week[$i] }}</option>
                            @endif
                            @endfor   
                        </select>

                        <label>時限</label>
                        <select name="class_time">
                            @for($i = 1; $i < 6; $i++)
                            @if($post->class_time === $i)
                            <option selected>{{ $i }}</option>
                            @else
                            <option>{{ $i }}</option>
                            @endif
                            @endfor 
                        </select>

                        <label>取得可能単位数</label>
                        <input type="number" name="amount_credit" min="1" value="{{ $post->amount_credit }}">

                        <label>レビュー</label>
                        <textarea name="content" value="">{{ $post->content }}</textarea>
                    </div>
                    <button type="submit" class="submit-btn" name="submit" value="create">更新</button>
                </form>
            </article>
        </main>
        
    </body>
</html>