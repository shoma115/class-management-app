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
                <button><a href="{{ route('credited.read') }}">戻る</a></button> 
                <!-- create-taken.phpにデータを送信(このページ自身) -->
                <form action="{{ route('credited.store') }}" method="POST">
                @csrf
                    <div>
                        <label>授業名</label>
                        <input type="text" name="class_name">

                        <label>教員名</label>
                        <input type="text" name="teacher_name">

                        <label>単位数</label>
                        <input type="number" name="amount_credit">

                    </div>
                    <button type="submit" class="submit-btn" name="submit" value="create">登録</button>
                </form>
            </article>
        </main>
        
    </body>
</html>