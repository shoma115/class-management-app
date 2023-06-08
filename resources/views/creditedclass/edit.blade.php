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
                <button><a href="{{ route('credited.read') }}">戻る</a></button>
                <h1>授業情報の編集<h1> 
                <!-- 更新するデータを判別するために、read.phpから飛んできた際にもらったIDをURLに渡す -->
                <form action="{{ route('credited.update', $creditedclass) }}" method="POST">
                @csrf
                @method('patch')
                <!-- input要素やselectボックスでは、取得したデータをvalueで初期値に設定している -->
                    <div>
                        <label>授業名</label>
                        <input type="text" name="class_name" value="{{ $creditedclass->class_name }}">

                        <label>教員名</label>
                        <input type="text" name="teacher_name"  value="{{ $creditedclass->teacher_name }}" >

                        
                        <label>単位数</label>
                        <input type="number" name="amount_credit" value="{{ $creditedclass->amount_credit }}" required>
                    </div>
                    <button type="submit" class="submit-btn" name="submit" value="create">更新</button>
                </form>
            </article>
        </main>
        
    </body>
</html>