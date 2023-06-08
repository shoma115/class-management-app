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
                <button><a href="{{ route('credited.create') }}">単位取得済み授業を登録</a></button>
                <h1>単位取得済み授業一覧</h1>
                @foreach($sum_credits as $sum_credit)
                <h2>取得済み単位数/卒業要件単位:<br>{{ $sum_credit->sum }}/128</h2>
                @endforeach
                <table>
                        <tr>
                            <th>授業名</th>
                            <th>教員名</th>
                            <th>単位数</th>
                            <th>編集</th>
                            <th>削除</th>
                        </tr>
                    
                        @foreach($classes as $creditedclass)
                        <tr>
                            <td>{{ $creditedclass->class_name }}</td>
                            <td>{{ $creditedclass->teacher_name }}</td>
                            <td>{{ $creditedclass->amount_credit }}</td>
                            <td><a href="{{ route('credited.edit', $creditedclass) }}">編集</a></td>
                            <td>
                                <form action="{{ route('credited.delete', $creditedclass) }}" method='post'>
                                @csrf
                                @method('delete')
                                    <button type="submit">削除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    
                    
                </table>
            </article>
        </main>
    </body>
</html>