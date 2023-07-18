<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreditedClass;
use App\Models\ClassDatum;
use Illuminate\Support\Facades\Auth;
use App\Models\Resource;
use Illuminate\Support\Facades\DB;

class CreditedClassController extends Controller
{
   
   // ここから履修済み授業一覧のページのアクション
   // 履修済みページ一覧を表示するアクション
   public function read() {
      $creditedclasses = Auth::user()->credited_classes;

      // amount_creditの合計値
      $credits = CreditedClass::whereUser_id(Auth::id())->selectRaw('SUM(amount_credit) as sum')->get();
           
      return view('creditedclass.readcredited', [ 'classes' => $creditedclasses, 'sum_credits' => $credits ]);      
   }

   // 履修済みの授業の登録ページを表示
   public function select(Request $request) {
        
         $keryword = $request->input('search');
         $result =  Resource::where('class_name', 'LIKE', "%$keryword%")->orderBy('class_name', 'asc');
         $resources = $result->paginate(20);
         return view('creditedclass.select_from_resource', compact('resources'));
   

      return view('creditedclass.select_from_resource', compact('resources'));

   }
   // 履修済み授業の登録
   public function store(Request $request, Resource $resource) {
      $creditedclass = new CreditedClass();
      $creditedclass->class_name = $resource->class_name;
      $creditedclass->teacher_name = $resource->teacher_name;
      $creditedclass->division_1 = $resource->division_1;
      $creditedclass->division_2 = $resource->division_2;
      $creditedclass->amount_credit = $resource->amount_credit;
      $creditedclass->user_id = Auth::id();
      $creditedclass->save();

      return redirect()->route('credited.read');
   }

   // 履修済み授業の編集editビューを表示するアクション
   public function edit(CreditedClass $creditedclass) {
      return view('creditedclass.edit', compact('creditedclass'));
   }

   // 履修済み授業のupdateアクション
   public function update(CreditedClass $creditedclass, Request $request) {
      $request->validate([
         'class_name' => 'required',
         'amount_credit' => 'required|integer',
         
     ]);
      $creditedclass->class_name = $request->input('class_name');
      $creditedclass->teacher_name = $request->input('teacher_name');
      $creditedclass->division_1 = $request->input('division1');
      $creditedclass->division_2 = $request->input('division2');
      $creditedclass->amount_credit = $request->input('amount_credit');
      $creditedclass->user_id = Auth::id();
      $creditedclass->save();

      return redirect()->route('credited.read');
   }

   // 履修済み授業の削除
   public function destroy(CreditedClass $creditedclass) {
      $creditedclass->delete();

      return redirect()->route('credited.read');
   }

   // 時間割から履修済み授業一覧ページへデータを移動させる
   public function migration(ClassDatum $classdatum) {
      $creditedclass = new CreditedClass();
      $creditedclass->class_name = $classdatum->class_name;
      $creditedclass->teacher_name = $classdatum->teacher_name;
      $creditedclass->division_1 = $classdatum->division_1;
      $creditedclass->division_2 = $classdatum->division_2;
      $creditedclass->amount_credit = $classdatum->amout_credit;
      $creditedclass->user_id = Auth::id();
      $creditedclass->save();

      return view('post.recommendation', compact('classdatum'));
      
   }

   // 時間割にある全ての授業を履修済みに移す。
   public function migrationAll() {
      $classdata = Auth::user()->class_data;
      foreach($classdata as $classdatum) {
         $creditedclass = new CreditedClass();
         $creditedclass->class_name = $classdatum->class_name;
         $creditedclass->teacher_name = $classdatum->teacher_name;
         $creditedclass->division_1 = $classdatum->division_1;
         $creditedclass->division_2 = $classdatum->division_2;
         $creditedclass->amount_credit = $classdatum->amout_credit;
         $creditedclass->user_id = Auth::id();
         $creditedclass->save();

      }
      
      $delete_class = ClassDatum::whereUser_id(Auth::id());
      $delete_class->delete();

      return redirect()->route('classdata.read');


   }

   // suggest
   public function suggest() {
      $search_word = request()->get('search');
      
      $data = DB::table('resources')->where('class_name', 'LIKE', "%$search_word%")->get();
      $suggest = [];
      
      foreach($data as $datum) {
          $suggest_array_count = count($suggest);
          $suggest[$suggest_array_count] = $datum->class_name;
      }
              
      return response()->json(['suggest' => $suggest]);
   }

   // 必要単位の内訳ページ
   public function needcredit() {
      // 共通教育の単位
      $syonennzi_1 = CreditedClass::where('class_name', '=', '初年次セミナーⅠ')->sum('amount_credit');
      $syonennzi_2 = CreditedClass::where('class_name', '=', '初年次セミナーⅡ')->sum('amount_credit');
      $daigaku_to_tiiki = CreditedClass::where('class_name', '=', '大学と地域')->sum('amount_credit');
      $taiiku_rironn = CreditedClass::where('class_name', '=', '体育・健康科学理論')->sum('amount_credit');
      $taiiku_zissyuu = CreditedClass::where('class_name', '=', '体育・健康科学実習')->sum('amount_credit');
      $zyouhou_katuyou = CreditedClass::where('class_name', '=', '情報活用')->sum('amount_credit');
      $English = CreditedClass::where('division_2', '=' , 'グローバル教育科目')->where('class_name', 'LIKE', '英語%')->sum('amount_credit');
      $ibunnka_rikai = CreditedClass::where('class_name', 'LIKE', '異文化理解%')->sum('amount_credit');
      $kyoutuu_zinnbunn_foreign = CreditedClass::where('division_2', '=', '人文・社会科学分野・初修外国語')->sum('amount_credit');
      $kyoutuu_zinnbunn_select = CreditedClass::where('division_2', '=', '人文・社会科学分野・選択科目')->sum('amount_credit');
      $kyoutuu_sizennkagaku_select = CreditedClass::where('division_2', '=', '自然科学分野・選択科目')->sum('amount_credit');
      $kyoutuu_tougou = CreditedClass::where('division_2', 'LIKE', '統合%')->sum('amount_credit');

      // 専門教育の単位
      $zinnbunn_syakai = CreditedClass::where('class_name', '=', '人文社会総合論')->sum('amount_credit');
      $syakaikagaku_kiso = CreditedClass::where('class_name', '=', '社会科学基礎')->sum('amount_credit');
      $syakaikagaku_kiso_ennsyuu = CreditedClass::where('class_name', '=', '社会科学基礎演習')->sum('amount_credit');
      $senmonn_gakkakyoutuu_select = CreditedClass::where('division_2', '=', '学科共通科目・選択')->sum('amount_credit');
      $tiikisyakai_select = CreditedClass::where('division_2', '=', '地域社会コース科目・選択')->sum('amount_credit');
      $other_select = CreditedClass::where('division_2', '=', '他コース(法経社会学科)科目')->sum('amount_credit');
      $ennsyuu = CreditedClass::where('class_name', '=', '演習')->sum('amount_credit');
      $enduser_1 = CreditedClass::where('class_name', '=', 'エンドユーザ実習Ⅰ')->sum('amount_credit');
      $enduser_2 = CreditedClass::where('class_name', '=', 'エンドユーザ実習Ⅱ')->sum('amount_credit');
      $enduser_3 = CreditedClass::where('class_name', '=', 'エンドユーザ実習Ⅲ')->sum('amount_credit');
      $sennmonn_adobannsuto = CreditedClass::where('division_2', 'LIKE', '法文アドバンスト科目%')->sum('amount_credit');
      
      // 共通共育科目の合計単位
      $sum_kyoutuu = CreditedClass::where('division_1', '=', '共通教育')->sum('amount_credit');

      // 専門教育科目の合計単位
      $sum_sennmonn = CreditedClass::where('division_1', '=', '専門教育')->sum('amount_credit');

      // 自由科目
      $free_credit = CreditedClass::where('division_1', '=', '他学科・他学部科目')->sum('amount_credit');

      return view('creditedclass.detail', compact('kyoutuu_tougou', 'kyoutuu_sizennkagaku_select', 'kyoutuu_zinnbunn_select', 'kyoutuu_zinnbunn_foreign', 'ibunnka_rikai', 'English', 'zyouhou_katuyou', 'taiiku_zissyuu', 'taiiku_rironn', 'daigaku_to_tiiki', 'syonennzi_2', 'syonennzi_1', 'sennmonn_adobannsuto', 'enduser_3', 'enduser_2', 'enduser_1', 'ennsyuu', 'tiikisyakai_select', 'other_select', 'senmonn_gakkakyoutuu_select', 'syakaikagaku_kiso_ennsyuu', 'syakaikagaku_kiso', 'zinnbunn_syakai', 'sum_kyoutuu', 'sum_sennmonn', 'free_credit'));
   
   }
   
}
