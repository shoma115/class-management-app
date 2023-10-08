<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassDatum;
use App\Models\Resource;
use Illuminate\Support\Facades\Auth;

class ClassDatumController extends Controller
{
    // トップページを表示するアクション
    public function index() {
        return view('index');
    }

    // 時間割のreadページを表示するアクション
    public function read() {
        
        $classdata = Auth::user()->class_data;
        return view('classdatum.read', compact('classdata'));
        
    }
    // 授業の詳細を表示showアクション
    public function show(ClassDatum $classdatum) {
        return view('classdatum.show', compact('classdatum'));
    }

    public function store(Resource $resource) {
        $classdatum = new ClassDatum();
        $classdatum->class_name =  $resource->class_name;
        $classdatum->class_week_day = $resource->class_week_day;
        $classdatum->class_time = $resource->class_time;
        $classdatum->class_place = $resource->class_place;
        $classdatum->amount_credit = $resource->amount_credit;
        $classdatum->teacher_name = $resource->teacher_name;
        $classdatum->evaluation = $resource->evaluation;
        $classdatum->attendance = $resource->attendance;
        $classdatum->division_1 = $resource->division_1;
        $classdatum->division_2 = $resource->division_2;
        $classdatum->user_id = Auth::id();
        $classdatum->save();

        return redirect()->route('classdata.read');
    }

   

    // updateを行うアクション
    public function update(ClassDatum $classdatum, Request $request, $task = null) {
        if((int)$task === 2) {
            $request->validate([
                'deadline' => 'required',
            ]);
    
            $classdatum->deadline = $request->input('deadline');
            $classdatum->save();

            return redirect()->route('classdata.read');
        } else {
            $request->validate([
                'class_name' => 'required',
                'class_week_day' => 'required',
                'class_time' => 'required|integer',
                'amount_credit' => 'required|integer',
                'division1' => 'required'
            ]);
            $classdatum->class_name = $request->input('class_name');
            $classdatum->class_week_day = $request->input('class_week_day');
            $classdatum->class_time = $request->input('class_time');
            $classdatum->class_place = $request->input('class_place');
            $classdatum->amount_credit = $request->input('amount_credit');
            $classdatum->teacher_name = $request->input('teacher_name');
            $classdatum->division_1 = $request->input('division1');
            $classdatum->division_2 = $request->input('division2');
            $classdatum->user_id = Auth::id();
            $classdatum->save();
         }

        return redirect()->route('classdata.show', $classdatum);
    }

    // taskの削除
    public function taskupdate(ClassDatum $classdatum) {
        $classdatum->deadline = null;
        $classdatum->save();

        return redirect()->route('classdata.read');
    }

    // deleteを行うアクション
    public function destroy(ClassDatum $classdatum) {
        $classdatum->delete();

        return redirect()->route('classdata.read');
    }

    
   
    

}
