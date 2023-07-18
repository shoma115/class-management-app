@extends('layouts.app')
    @section('content')
            <article class="pb-5">
                
                <a href="{{ route('credited.read') }}">
                        <img class="back-button" src="{{ asset('backbutton.img\プレゼンテーション4-removebg-preview.png') }}" width="30">
                </a>
                <div class="m-3">
                    <h1 class="fw-bold">取得単位の内訳</h1>
                    <h3 class="fw-bold">基本的な見方</h5>
                    <p>
                        現在取得の単位数/必要単位数<br>
                        例）<span class="fw-bold">20/30</span>という表記の場合、<span class="fw-bold">20が現在取得している単位数、30が卒業に必要な単位数</span>を表しています。
                        <br>
                    </p>
                    <h3 style="color:red" class="fw-bold">注意</h3>
                    <p>以下は「法文学部修学の手引き」を参考に作成していますが、個人が作成しているため<span style="color:red">正確さを保障することはできません。</span>あくまで参考程度にご使用ください。<br>正確な情報は大学が作成している資料、もしくは学務係への問い合わせで確認してください。</p>
                </div>
                <div class="m-2">
                    <h1 class="fw-bold">共通教育科目の合計:&emsp;{{ $sum_kyoutuu }}/30</h1>
                        <div class="m-2">
                            <div class="card">
                                <div class="m-2">
                                    <h2 class="fw-bold">共通教育・必修科目</h2>

                                    <?php
                                    // 共通必修(英語・体育除く)
                                    $kyoutuu = [$syonennzi_1, $syonennzi_2, $daigaku_to_tiiki, $zyouhou_katuyou, $ibunnka_rikai,];
                                    $class_name = ['初年次セミナーⅠ', '初年次セミナーⅡ', '大学と地域', '情報活用', '異文化理解'];
                                    // 体育理論・実習
                                    $PE = [$taiiku_rironn, $taiiku_zissyuu];
                                    $PE_division = ['体育・健康理論', '体育・健康実習'];
                                    
                                    
                                    ?>
                                    <!-- 体育、英語以外の共通必修 -->
                                    @for($i = 0; $i < count($kyoutuu); $i++)
                                        <p>{{ $class_name[$i] }}:&emsp;{{ $kyoutuu[$i]}}/2</p>
                                    @endfor

                                    <!-- 体育理論と実習 -->
                                    @for($i = 0; $i < count($PE); $i++)
                                        <p>{{ $PE_division[$i] }}:&emsp;{{ $PE[$i]}}/1</p>
                                    @endfor

                                    <!-- 英語 -->
                                    <p>英語:&emsp;{{ $English}}/4</p>
                                </div>
                            </div>
                        </div>
                    <div class="m-2">
                        <div class="card">
                            <div class="m-2">
                                <h3 class="fw-bold">共通教育・選択必修科目</h3>
                                
                                <h4 class="fw-bold">人文・社会科学分野</h4>
                                <!-- 初修外国語 -->
                                <p>初修外国語:&emsp;{{ $kyoutuu_zinnbunn_foreign}}/4</p>
                                <p>選択科目:&emsp;{{ $kyoutuu_zinnbunn_select}}/2</p>
                                <h4 class="fw-bold">自然科学分野</h4>
                                <p>選択科目:&emsp;{{ $kyoutuu_sizennkagaku_select}}/4</p>
                                <h4 class="fw-bold">教養活用科目</h4>
                                <p>統合:&emsp;{{ $kyoutuu_tougou}}/4</p>
                                <p>※統合Ⅰ,Ⅱどちらかのみで4単位でも可</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="m-2">
                    <h1 class="fw-bold">専門教育科目の合計:&emsp;{{ $sum_sennmonn + $free_credit }}/94</h1>
                    <div class="m-2">
                        <div class="card">
                            <div class="m-2">
                                <h2 class="fw-bold">専門教育・必修科目</h2>
                                <?php 
                                // 専門教育科目必修
                                $sennmonn = [$zinnbunn_syakai, $syakaikagaku_kiso, $syakaikagaku_kiso_ennsyuu];
                                $sennmonn_class_name = ['人文社会総合論', '社会科学基礎', '社会科学基礎演習' ];
                                // 専門教育科目必修、エンドユーザー実習1単位のもの
                                $sennmonn_credit_1 = [$enduser_1, $enduser_2, $enduser_3];
                                $sennmonn_credit_1_name = ['エンドユーザー実習Ⅰ', 'エンドユーザー実習Ⅱ', 'エンドユーザー実習Ⅲ']
                                ?>
                                <!-- 専門基礎科目必修 -->
                                @for($i = 0; $i < count($sennmonn); $i++)
                                    <p>{{ $sennmonn_class_name[$i] }}:&emsp;{{ $sennmonn[$i]}}/2</p>
                                @endfor

                                <!-- 演習 -->
                                <p>演習(特殊研究も含む):&emsp;{{ $ennsyuu}}/14</p>

                                <!-- エンドユーザー実習 -->
                                @for($i = 0; $i < count($sennmonn_credit_1); $i++)
                                    <p>{{ $sennmonn_credit_1_name[$i] }}:&emsp;{{ $sennmonn_credit_1[$i]}}/1</p>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="m-2">
                        <div class="card">
                            <div class="m-2">
                                <h3 class="fw-bold">専門教育・選択科目&emsp;<br>{{ $senmonn_gakkakyoutuu_select + $other_select + $tiikisyakai_select}}/53単位以上</h3>
                                <h5>また専門教育・選択科目の中で</h5>
                                <p>学科共通科目:&emsp;{{ $senmonn_gakkakyoutuu_select}}/6単位以上必要</p>
                                <p>他コース科目:&emsp;{{ $other_select}}/14単位まで取得可</p>
                                <p>地域社会コース科目:&emsp;{{ $tiikisyakai_select}}/制限なし</p>
                                <h5>以上の条件・枠組から53単位以上取得することが必要</h5>
                            </div>
                        </div>
                    </div>
                    <div class="m-2">
                        <div class="card">
                            <div class="m-2">
                                <h3 class="fw-bold">法文アドバンスト科目</h3>
                                <p>法文アドバンスト科目Ⅰ・Ⅱ:&emsp;{{ $sennmonn_adobannsuto}}/6</p>
                                <p>※法文アドバンスト科目1,2のどちらかのみで6単位でも可</p>
                            </div>
                        </div>
                    </div>
                    <div class="m-2">
                        <div class="card">
                            <div class="m-2">
                            <h3 class="fw-bold">自由科目</h3>
                                @if($sennmonn_adobannsuto > 6)
                                    <p class="m-0">自由科目:&emsp;{{ $free_credit + $sennmonn_adobannsuto}}/6単位まで取得可</p>
                                @else
                                    <p class="m-0">自由科目:&emsp;{{ $free_credit }}/6単位まで取得可</p>
                                @endif
                        
                                @include('modals.modals_credited.free_credit')
                                <a href="#" data-bs-toggle = "modal" data-bs-target = "#freeCredit">自由科目とは？</a>
                            </div>
                        </div>
                    </div>
                </div>                
            </article>
@endsection