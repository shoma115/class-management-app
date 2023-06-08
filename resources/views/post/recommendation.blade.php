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
                <a href="index.php">時間割作成アプリ</a>
            </nav>
        </header>
        <main>
            <article>
                
                <h1>レビューを投稿しませんか？</h1>
                <button><a href="{{ route('classdata.read') }}">投稿しない</a></button> 
                <!-- create-taken.phpにデータを送信(このページ自身) -->
                <form action="{{ route('review.store') }}" method="POST">
                @csrf
                    <div>
                        <label>授業名</label>
                        <input type="text" name="class_name" value="{{ $classdatum->class_name }}">

                        <label>授業の難易度</label>
                        <input type="number" name="difficulty_level" min="1" max="5">
                        
                        <label>教員名</label>
                        <input type="text" name="teacher_name" value="{{ $classdatum->teacher_name }}">

                        <label>授業の場所</label>
                        <input type="text" name="class_place" value="{{ $classdatum->class_place }}">

                        <label>曜日</label>
                        <select name="class_week_day" value="{{ $classdatum->class_week_day }}">
                        <?php
                                $week = ['月曜', '火曜', '水曜', '木曜', '金曜', '土曜', '日曜'];
                            ?>
                            @for($i = 0; $i < 7; $i++)
                            @if($classdatum->class_week_day === $week[$i])
                            <option selected>{{ $week[$i] }}</option>
                            @else
                            <option>{{ $week[$i] }}</option>
                            @endif
                            @endfor   
                        </select>

                        <label>時限</label>
                        <select name="class_time">
                            @for($i = 1; $i < 6; $i++)
                            @if($classdatum->class_time === $i)
                            <option selected>{{ $i }}</option>
                            @else
                            <option>{{ $i }}</option>
                            @endif
                            @endfor 
                        </select>

                        <label>取得可能単位数</label>
                        <input type="number" name="amount_credit" min="1" value="{{ $classdatum->amount_credit }}">

                        <label>レビュー</label>
                        <textarea name="content"></textarea>
                    </div>
                    <button type="submit" class="submit-btn" name="submit" value="create">投稿</button>
                </form>
            </article>
        </main>
        
    </body>
</html>