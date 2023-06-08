<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassDatum;

class ClassDatumController extends Controller
{
    // トップページを表示するアクション
    public function index() {
        return view('index');
    }

    // 時間割のreadページを表示するアクション
    public function read() {
        $classdata = ClassDatum::all();
        return view('classdatum.read', compact('classdata'));
        
    }

    // createページを表示するアクション
    public function create() {
        return view('classdatum.create');
    }

    // store機能を起動させるコントローラ
    public function store(Request $request) {
        $classdatum = new ClassDatum();
        $classdatum->class_name = $request->input('class_name');
        $classdatum->class_week_day = $request->input('class_week_day');
        $classdatum->class_time = $request->input('class_time');
        $classdatum->class_place = $request->input('class_place');
        $classdatum->amout_credit = $request->input('amout_credit');
        $classdatum->teacher_name = $request->input('teacher_name');
        $classdatum->save();

        return redirect()->route('classdata.read');
    }

    // 編集ページを表示させるアクション
    public function edit(ClassDatum $classdatum) {
        return view('classdatum.edit', compact('classdatum'));
    }

    // updateを行うアクション
    public function update(ClassDatum $classdatum, Request $request) {
        $classdatum->class_name = $request->input('class_name');
        $classdatum->class_week_day = $request->input('class_week_day');
        $classdatum->class_time = $request->input('class_time');
        $classdatum->class_place = $request->input('class_place');
        $classdatum->amout_credit = $request->input('amout_credit');
        $classdatum->teacher_name = $request->input('teacher_name');
        $classdatum->save();

        return redirect()->route('classdata.read');
    }

    // deleteを行うアクション
    public function destroy(ClassDatum $classdatum) {
        $classdatum->delete();

        return redirect()->route('classdata.read');
    }

    // delete前の警告ページを表示するアクション
    public function alert(ClassDatum $classdatum) {
        return view('classdatum.alert', compact('classdatum'));
    }

    

}
