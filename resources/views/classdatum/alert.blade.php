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
                <button><a href="{{ route('classdata.read') }}">戻る</a></button>
                <div>
                    <p>{{ $classdatum->class_name }}</p>
                    <p>{{ $classdatum->teacher_name }}</p>
                    <p>{{ $classdatum->class_place }}</p>
                    <p>{{ $classdatum->class_week_day }}</p>
                    <p>{{ $classdatum->class_time }}</p>
                    <p>{{ $classdatum->amout_credit }}</p>
                    <form action="{{ route('classdata.delete', $classdatum) }}" method='post'>
                    @csrf
                    @method('delete')
                        <p>本当に削除してもよろしいですか？</p>
                        <button type="submit">削除</button>
                        <button><a href="{{ route('classdata.read') }}">戻る</a></button>
                    </form>
                </div>    

                
            </article>
        </main>
        <footer>&copy;Shoma Tone. All right reserved.</footer>
    </body>
</html>