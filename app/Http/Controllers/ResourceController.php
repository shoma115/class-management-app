<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resource;
use App\Models\ClassDatum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResourceController extends Controller
{
   
    
    public function select(Request $request, $week, $time, $search = null) {
        
        if((int)$search === 1) {
            $keryword = $request->input('search');
            $result =  Resource::whereClass_week_day($week)->whereClass_time($time)->where('class_name', 'LIKE', "%$keryword%");
            $resources = $result->get();
            return view('classdatum.select', ['resources' => $resources, 'week' => $week, 'time' => $time]);
        }
        $resources = Resource::whereClass_week_day($week)->whereClass_time($time)->get();
       
        return view('classdatum.select', ['resources' => $resources, 'week' => $week, 'time' => $time]);
    }

     // createアクション
     public function create($week, $time) {
        return view('classdatum.addResource', ['week' => $week, 'time' => $time]);
    }
    // storeアクション
    public function store( Request $request, $week = null, $time = null) {
        $request->validate([
            'class_name' => 'required',
            'class_week_day' => 'required',
            'class_time' => 'required|integer',
            
            'amount_credit' => 'required|integer',
            
            'evaluation' =>  'required',
            'attendance' =>  'required',
            'division1' => 'required'
        ]);

        $resource = new Resource();
        $resource->class_name = $request->input('class_name');
        $resource->teacher_name = $request->input('teacher_name');
        $resource->class_place = $request->input('class_place');
        $resource->class_week_day = $request->input('class_week_day');
        $resource->class_time = $request->input('class_time');
        $resource->amount_credit = $request->input('amount_credit');
        $resource->evaluation = $request->input('evaluation');
        $resource->attendance = $request->input('attendance');
        $resource->division_1 = $request->input('division1');
        $resource->division_2 = $request->input('division2');
        $resource->save();
        
        if($week === null) {
            return redirect()->route('credited.select');
        } else { 
            return redirect()->route('resource.select', ['week' => $week, 'time' => $time]);
        }

    }

    public function suggest() {
        $search_word = request()->get('search');
        $week = request()->get('week');
        $time = request()->get('time');
        
        $data = DB::table('resources')->whereClass_week_day($week)->whereClass_time($time)->where('class_name', 'LIKE', "%$search_word%")->get();
        $suggest = [];
        
        foreach($data as $datum) {
            $suggest_array_count = count($suggest);
            $suggest[$suggest_array_count] = $datum->class_name;
        }
                
        return response()->json(['suggest' => $suggest]);
    }

    
}
