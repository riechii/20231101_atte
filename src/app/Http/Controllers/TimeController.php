<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use Carbon\Carbon;
use Auth;

class TimeController extends Controller
{
    //打刻画面表示
    public function index()
    {
        $time = Time::all();
        return view('index', ['time' => $time]);
    }

    //勤務開始処理
    public function store(Request $request)
    {
        $user = Auth::user();
        $time = Time::where('user_id', $user->id)->latest()->first();
        //打刻は１日一回まで
        if(new Carbon($time->date) == Carbon::today()){
            return redirect('/')->with('error', '今日は既に出勤しています');
        }

        $time = Time::create([
            'user_id' => $user->id,
            'date' => Carbon::now(),
            'start' => Carbon::now(),
        ]);
        return redirect('/')->with('message', '勤務開始しました');

    }

    //勤務終了処理
    public function update(Request $request)
    {
        $user = Auth::user();
        $time = Time::where('user_id', $user->id)->latest()->first();
        if( !empty($time->end)){
            return redirect('/')->with('error', '出勤していません');
        }
        // else if( !empty($rest->reststart) && empty($rest->restnd)){
        //     return redirect('/')->with('error', '休憩終了してください');
        // }
        $time -> update([
            'end' => carbon::now()
        ]);

        return redirect('/')->with('message', '勤務終了しました');
    }

    //日付別勤怠ページ
    public function show()
    {
        $time = Time::all();
        return view('attendance');
    }
}
