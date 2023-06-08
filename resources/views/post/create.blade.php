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
                <button><a href="{{ route('review.read') }}">戻る</a></button> 
                <!-- create-taken.phpにデータを送信(このページ自身) -->
                <form action="{{ route('review.store') }}" method="POST">
                @csrf
                    <div>
                        <label>授業名</label>
                        <input type="text" name="class_name">

                        <label>授業の難易度</label>
                        <input type="number" name="difficulty_level" min="1" max="5">
                        <!-- <input type="radio" name="difficulty_level" value="difficulty_level">5（難しい）
                        <input type="radio" name="difficulty_level" value="difficulty_level">4
                        <input type="radio" name="difficulty_level" value="difficulty_level">3
                        <input type="radio" name="difficulty_level" value="difficulty_level">2
                        <input type="radio" name="difficulty_level" value="difficulty_level">1（易しい） -->

                        <label>教員名</label>
                        <input type="text" name="teacher_name">

                        <label>曜日</label>
                        <select name="class_week_day">
                           <option>月曜</option>
                           <option>火曜</option>
                           <option>水曜</option>
                           <option>木曜</option>
                           <option>金曜</option>
                           <option>土曜</option>
                           <option>日曜</option>
                        </select>

                        <label>時限</label>
                        <select name="class_time">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>

                        <label>取得可能単位数</label>
                        <input type="number" name="amount_credit" min="1">

                        <label>レビュー</label>
                        <textarea name="content"></textarea>
                    </div>
                    <button type="submit" class="submit-btn" name="submit" value="create">登録</button>
                </form>
            </article>
        </main>
        
    </body>
</html>