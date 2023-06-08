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
                <a href="{{ route('index')}}">時間割作成アプリ</a>
            </nav>
        </header>
        <main>
            <article>
                <button><a href="{{ route('classdata.read') }}">戻る</a></button>
                 
                <form action="{{ route('classdata.store') }}" method="POST">
                @csrf
                    <div>
                        <label>授業名</label>
                        <input type="text" name="class_name">

                        <label>教員名</label>
                        <input type="text" name="teacher_name">

                        <label>授業の場所</label>
                        <input type="text" name="class_place">

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

                        <label>単位数</label>
                        <input type="number" name="amout_credit">
                    </div>
                    <button type="submit" class="submit-btn" name="submit" value="create">登録</button>
                </form>
            </article>
        </main>
        
    </body>
</html>