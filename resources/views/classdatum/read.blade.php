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
                    <button><a href="{{ route('classdata.create') }}">授業を登録する</a></button>
                    <button><a href="{{ route('credited.read') }}">単位取得済みの授業を見る</a></button>
                    <button><a href="{{ route('credited.migrationAll') }}">全ての授業を単位取得済みにする</a></button>
                </div>
                <div>
                    
                <table>
                    <tr>
                        <td></td>
                        <th id="mon">月</th>
                        <th id="tue">火</th>
                        <th id="wed">水</th>
                        <th id="thu">木</th>
                        <th id="fri">金</th>
                        <th id="sat">土</th>
                        <th id="sun">日</th>
                    </tr>
                    <tr>
                        <th>1限目</th>
                        <td id="mon1"></td>
                        <td id="tue1"></td>
                        <td id="wed1"></td>
                        <td id="thu1"></td>
                        <td id="fri1"></td>
                        <td id="sat1"></td>
                        <td id="sun1"></td>
                    </tr>
                    <tr>
                        <th>2限目</th>
                        <td id="mon2"></td>
                        <td id="tue2"></td>
                        <td id="wed2"></td>
                        <td id="thu2"></td>
                        <td id="fri2"></td>
                        <td id="sat2"></td>
                        <td id="sun2"></td>
                    </tr>
                    <tr>
                        <th>3限目</th>
                        <td id="mon3"></td>
                        <td id="tue3"></td>
                        <td id="wed3"></td>
                        <td id="thu3"></td>
                        <td id="fri3"></td>
                        <td id="sat3"></td>
                        <td id="sun3"></td>
                    </tr>
                    <tr>
                        <th>4限目</th>
                        <td id="mon4"></td>
                        <td id="tue4"></td>
                        <td id="wed4"></td>
                        <td id="thu4"></td>
                        <td id="fri4"></td>
                        <td id="sat4"></td>
                        <td id="sun4"></td>
                    </tr>
                    <tr>
                        <th>5限目</th>
                        <td id="mon5"></td>
                        <td id="tue5"></td>
                        <td id="wed5"></td>
                        <td id="thu5"></td>
                        <td id="fri5"></td>
                        <td id="sat5"></td>
                        <td id="sun5"></td>
                    </tr>

                    <script>
                        //曜日と時限で授業データを表示する場所を決めるために使う変数を用意 
                        let classKadai = '';
                        // 授業の情報をまとめて表示するHTML要素を作成するための変数を用意
                        let classDetail = '';
                        // 授業の名前を表示するHTML要素を作成するための変数
                        let className = '';
                        // 授業の教員…以下同文
                        let classTeacher = '';
                        // 授業の場所…以下同文
                        let classPlace = '' ;
                        // 授業情報の編集ボタンを作るHTML要素を作成するための変数
                        let classEdit = '';
                        // 授業の削除ボタンを…以下同文
                        let classDeleteForm = '';
                        let classDeleteButton = '';
                        let classDeleteInput = '';
                        // 授業を単位取得済み一覧に移すためのボタンを…以下同文
                        let classGoTaken = '';
                    </script>

                    @foreach($classdata as $classdatum)
                    @if($classdatum->class_week_day === '月曜') 
                    <?php
                        $class_week_day = 'mon';
                    ?> 
                    @elseif($classdatum->class_week_day === '火曜')
                    <?php
                        $class_week_day = 'tue';
                    ?>
                    @elseif($classdatum->class_week_day === '水曜')
                    <?php
                        $class_week_day = 'wed';
                    ?>
                    @elseif($classdatum->class_week_day === '木曜')
                    <?php
                        $class_week_day = 'thu';
                    ?>
                    @elseif($classdatum->class_week_day === '金曜')
                    <?php
                        $class_week_day = 'fri';
                    ?>
                    @elseif($classdatum->class_week_day === '土曜')
                    <?php
                        $class_week_day = 'sat';
                    ?>
                    @elseif($classdatum->class_week_day === '日曜')
                    <?php
                        $class_week_day = 'sun';
                    ?>
                    @endif

                    <?php
                     // 授業名を格納
                     $class_detail_name = $classdatum->class_name;
                     // 授業教員名を格納
                     $class_detail_teacher = '教員名:'.$classdatum->teacher_name;
                     // 授業場所を格納
                     $class_detail_place = '場所:'.$classdatum->class_place;
                    ?>

                    <script>
                         //選択した曜日、時限によって取得するHTML要素を変えている。上のテーブルでid=mon1とかめっちゃ書いてたやつから選んでくる
                        classKadai = document.getElementById('{{ $class_week_day }}{{ $classdatum->class_time}}');

                        // 授業の詳細を表示するためのHTML要素を作成
                        classDetail = document.createElement('div');

                        // classDetailの中で授業名を表示するために作成
                        className = document.createElement('p');

                        // classDetailの中で教員名を表示するために作成
                        classTeacher = document.createElement('p');

                        // classDetailの中で授業場所を表示するために作成
                        classPlace = document.createElement('p');

                        // 編集機能のためのaタグを追加
                        classEdit = document.createElement('a');
                        // // 編集の際に飛ぶ場所へのリンク。その際、授業のIDを渡す（編集するデータを識別するため）
                        classEdit.href = "{{ route('classdata.edit', $classdatum)}}";
                        classEdit.textContent = '編集';


                        // 削除機能のためのformタグを追加
                        classDeleteForm = document.createElement('a');
                        // deleteの確認ページに飛ぶ
                        classDeleteForm.href = "{{ route('classdata.alert', $classdatum)}}";
                        classDeleteForm.textContent = '削除';

                        // classDeleteForm.action = "{{ route('classdata.delete', $classdatum) }}";
                        // classDeleteForm.method = 'post';
                        // classDeleteInput = document.createElement('input');
                        // classDeleteInput.type = 'hidden';
                        // classDeleteInput.name = '_method';
                        // classDeleteInput.value = 'DELETE';
                        // classDeleteForm.appendChild(classDeleteInput);
                        // classDeleteButton = document.createElement('button');
                        // classDeleteButton.textContent = '削除';
                        // classDeleteForm.appendChild(classDeleteButton);


                        // 履修済みに登録するためのHTML要素を追加
                        classGoTaken = document.createElement('a');
                        // // 履修済みに登録する際に飛ぶ場所へのリンク。移動させるするデータを判別するためにIDを渡す
                        classGoTaken.href = "{{ route('credited.migration', $classdatum) }}";
                        classGoTaken.textContent = '単位取得済に登録';



                        // 作成した授業の詳細、編集・削除・履修済みに登録ボタンを全てclassDetailのDiv要素に突っ込む
                        classDetail.appendChild(className);
                        classDetail.appendChild(classTeacher);
                        classDetail.appendChild(classPlace);
                        classDetail.appendChild(classEdit);
                        classDetail.appendChild(classDeleteForm);
                        classDetail.appendChild(classGoTaken);

                        // 授業名・教員名・場所を各要素に文として差し込む
                        className.innerHTML = '{{ $class_detail_name }}';
                        classTeacher.innerHTML = '{{ $class_detail_teacher }}';
                        classPlace.innerHTML = '{{ $class_detail_place }}';

                        // 授業の詳細を曜日と時限で取得したＨＴＭＬ要素の子要素に追加する
                        classKadai.appendChild(classDetail);
                    </script>
                    @endforeach

                </table>
            </article>
        </main>
        <footer>&copy;Shoma Tone. All right reserved.</footer>
    </body>
</html>