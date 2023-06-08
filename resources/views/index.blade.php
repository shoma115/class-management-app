<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>時間割アプリ</title>
        <meta name="description" content="時間割を作成するアプリです">
        <link rel="stylesheet" href="css/style.css">
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
                <h1>学生による学生のための時間割</h1>
                <button >
                    <a href="{{ route('classdata.read') }}">時間割を作る</a>
                </button>
                <a href="{{ route('review.read') }}">授業のレビューを見る</a>
            </article>
        </main>
        <footer>&copy;Shoma Tone. All right reserved.</footer>
    </body>
</html>