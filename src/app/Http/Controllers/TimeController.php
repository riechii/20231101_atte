<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
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
        if(!isset($time->id)){

            return view('new_screen');
        }else{
        $rest = Rest::where('time_id', $time->id)->latest()->first();
        return view('index', compact('time', 'rest'));
        }
    }

    //勤務開始処理
    public function store(Request $request)
    {
        $user = Auth::user();
        $time = Time::where('user_id', $user->id)->latest()->first();

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
        $time = Time::all();
        foreach ($time as $time){
            $ids[] = $time->id;
        }
        $rests = Rest::whereIn('time_id', $ids)->get();
        // $rests = Rest::where('time_id', $time->id)->get();

        //複数の結果が予想されすものは配列になる
        $totalrest = 0;
        foreach($rests as $rest){

        $reststart = $rest->reststart;
        $restend = $rest->restend;
        $break = (strtotime($restend) - strtotime($reststart));
        $totalrest += $break;
        }


        $hours = floor($totalrest / 3600);
        $minutes = floor(($totalrest / 60) % 60);
        $seconds = floor($totalrest % 60);
        $hms = sprintf("%2d:%02d:%02d", $hours, $minutes, $seconds);

        $today = Carbon::today();

        $dates=Time::whereDate('date', $today)->paginate(1);

        return view('attendance', compact('time', 'rests','hms','dates','today'));
    }
    //日付別勤怠ページリスト
    public function nextDay(Request $request){

        // $today = Carbon::today();
        // // $today = new Carbon($request->date);
        // $yesterday = Carbon::yesterday();
        // // $yesterday = (new Carbon($request->date))->subDay();
        // $tomorrow = Carbon::tomorrow();
        // // $tomorrow = (new Carbon($request->date))->addDay();
        $next = $request->input('next');
        $today = Carbon::today();

        if ($next === 'yesterday') {
            $today = $today->subDay();
            $dates=Time::whereDate('date', $today)->paginate(1);
        } elseif ($next === 'tomorrow') {
            $today = $today->addDay();
            $dates=Time::whereDate('date', $today)->paginate(1);
        }

        return  view('attendance', compact('dates','today'));
    }
}
