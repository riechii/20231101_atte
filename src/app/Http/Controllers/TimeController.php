<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Time;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Auth;

class TimeController extends Controller
{
    //打刻画面表示
    public function index()
    {
        $user = Auth::user();
        $time = Time::where('user_id', $user->id)->latest()->first();
        $rest = Rest::where('time_id', $time->id)->latest()->first();
        return view('index', compact('time', 'rest'));
    }

    //勤務開始処理
    public function store(Request $request)
    {
        $user = Auth::user();
        $time = Time::where('user_id', $user->id)->latest()->first();
        $rest = Rest::where('time_id', $time->id)->latest()->first();

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
        $rest = Rest::where('time_id', $time->id)->latest()->first();

        $time -> update([
            'end' => carbon::now()
        ]);

        return redirect('/')->with('message', '勤務終了しました');
    }

    //日付別勤怠ページ
    public function show(Request $request)
    {
        // $user = Auth::user();
        $user = User::all();
        // $users = User::get();

        $time = Time::all();
        foreach ($time as $time){
            $id = $time->id;
        }

        $rest = Rest::all();
        $rest = Rest::where('time_id', $time->id)->latest()->first();
        
        // $reststart = $rest->reststart;
        // $restend = $rest->restend;
        // $work = (strtotime($restend) - strtotime($reststart)); 
        // $hours = floor($work / 3600);
        // $minutes = floor(($work / 60) % 60);
        // $seconds = floor($work % 60);
        // $hms = sprintf("%2d:%02d:%02d", $hours, $minutes, $seconds);
        // echo $hms;



        // $rest = Rest::select('time_id','reststart','restend')->groupBy('time_id','reststart','restend')->get();



        // $reststart = new Carbon($rest->reststart);
        // $restend = new Carbon($rest->restend);
        // $resttime = $restend->diffInSeconds($reststart);


        // $time = Time::join('rests','rests.time_id','=','times.id')->get();
        $time = Time::latest( 'created_at' )->simplePaginate(1);


        $time->user_id = $request->user()->id;
        


        


        return view('attendance', compact('time', 'rest'));
    }
}
