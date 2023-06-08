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
                <button><a href="{{ route('review.read') }}">戻る</a></button>

                <a href="{{ route('review.edit', $post) }}">投稿の編集</a>
                <h2>{{ $post->class_name }}</h2>
                <h3>授業の難易度</h3>
                <p>{{ $post->difficulty_level }}</p>
                <h3>曜日・時限</h3>
                <p>{{ $post->class_week_day }}{{ $post->class_time }}限</p>
                <h3>取得可能単位数</h3>
                <p>{{ $post->amount_credit }}</p>
                <h3>レビュー</h3>
                <p>{{ $post->content }}</p>

               
            </article>
        </main>
    </body>
</html>