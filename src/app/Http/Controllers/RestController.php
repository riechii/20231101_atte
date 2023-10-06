<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Time;
use Carbon\Carbon;
use Auth;

class RestController extends Controller
{
    //休憩開始処理
    public function store(Request $request)
    {
        $user = Auth::user();
        $time = Time::get();
        foreach ($time as $time){
            $id = $time->id;
        }
        $time = Time::where('user_id', $user->id)->latest()->first();
        $rest = Rest::where('time_id', $time->id)->latest()->first();
        if(!empty($time->end)){
            return redirect('/')->with('error', '出勤していないので休憩できません');
        }else if(empty($rest->restend) && !empty($rest->reststart)){
            return redirect('/')->with('error', '休憩中です');
        }

        $rest = Rest::create([
            'time_id' => $time->id,
            'reststart' => Carbon::now(),
        ]);
        return redirect('/')->with('message', '休憩開始しました');
    }

    //休憩終了処理
    public function update(Request $request)
    {
        $user = Auth::user();
        $time = Time::get();
        foreach ($time as $time){
            $id = $time->id;
        }
        $time = Time::where('user_id', $user->id)->latest()->first();
        $rest = Rest::where('time_id', $time->id)->latest()->first();

        if( !empty($rest->restend) && !empty($rest->reststart)){
            return redirect('/')->with('error', '休憩していません');
        }
        $rest -> update([
            'restend' => carbon::now(),
        ]);

        return redirect('/')->with('message', '休憩終了しました');
    }
}
