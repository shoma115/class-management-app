<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CreditedClass;
use App\Models\ClassDatum;

class CreditedClassController extends Controller
{
   
   // ここから履修済み授業一覧のページのアクション
   // 履修済みページ一覧を表示するアクション
   public function read() {
      $creditedclasses = CreditedClass::all();

      // amount_creditの合計値
      $credits = CreditedClass::selectRaw('SUM(amount_credit) as sum')->get();
      
      
      $credited_read_data = [ 'classes' => $creditedclasses, 'sum_credits' => $credits ];
     
     
      return view('creditedclass.readcredited', $credited_read_data);      
   }

   // 履修済みの授業の登録ページを表示
   public function create() {
      return view('creditedclass.create');

   }
   // 履修済み授業の登録
   public function store(Request $request) {
      $creditedclass = new CreditedClass();
      $creditedclass->class_name = $request->input('class_name');
      $creditedclass->teacher_name = $request->input('teacher_name');
      $creditedclass->amount_credit = $request->input('amount_credit');
      $creditedclass->save();

      return redirect()->route('credited.read');
   }

   // 履修済み授業の編集editビューを表示するアクション
   public function edit(CreditedClass $creditedclass) {
      return view('creditedclass.edit', compact('creditedclass'));
   }

   // 履修済み授業のupdateアクション
   public function update(CreditedClass $creditedclass, Request $request) {
      $creditedclass->class_name = $request->input('class_name');
      $creditedclass->teacher_name = $request->input('teacher_name');
      $creditedclass->amount_credit = $request->input('amount_credit');
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
      $creditedclass->amount_credit = $classdatum->amout_credit;
      $creditedclass->save();

      $classdatum->delete();
      return redirect()->route('review.recommendation', $classdatum);
      
   }

   // 時間割にある全ての授業を履修済みに移す。
   public function migrationAll() {
      $classdata = ClassDatum::all();
      foreach($classdata as $classdatum) {
         $creditedclass = new CreditedClass();
         $creditedclass->class_name = $classdatum->class_name;
         $creditedclass->teacher_name = $classdatum->teacher_name;
         $creditedclass->amount_credit = $classdatum->amout_credit;
         $creditedclass->save();

      }

      ClassDatum::query()->delete();

      return redirect()->route('classdata.read');


   }
   
}
