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
                <div>
                    <button><a href="{{ route('review.create') }}">授業のレビューを投稿する</a></button>        
                </div>

                @foreach($posts as $post)
                <h2>{{ $post->class_name }}</h2>
                <h3>授業の難易度</h3>
                <p>{{ $post->difficulty_level }}</p>

                <a href="{{ route('review.show', $post) }}">詳細を見る</a>
                
                <form action="{{ route('review.delete', $post) }}" method='post'>
                @csrf
                @method('delete')
                    <button type="submit">レビューを削除する</button>
                </form>
                @endforeach

            </article>
        </main>
    </body>
</html>