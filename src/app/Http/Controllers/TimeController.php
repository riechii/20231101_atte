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
    public function workStart(Request $request)
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
    public function workEnd(Request $request)
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
    public function attendancePage(Request $request)
    {
        $time = Time::all();
        foreach ($time as $time){
            $id = $time->id;
        }
        $rests = Rest::where('time_id', $time->id)->get();
        $today = Carbon::today();
        $dates = Time::whereDate('date', $today)->paginate(5);

        return view('attendance', compact('time', 'rests','dates','today'));
    }
    //日付別勤怠ページ日付変更ボタン
    public function nextDay(Request $request){

        $next = $request->input('next');
        $today = session('last_date', Carbon::today());

        if ($next === 'yesterday') {
            $today = $today->subDay();
        } elseif ($next === 'tomorrow') {
            $today = $today->addDay();
        }
        $dates=Time::whereDate('date', $today)->paginate(5);
        session(['last_date' => $today]);

        return  view('attendance', compact('dates','today'));
    }

    //社員一覧ページ
    public function userList(Request $request){
        $users = User::orderBy('created_at')->paginate(5);;
        foreach($users as $user){
            $id = $user->id;
        }
        return view('user_list', compact('users','id'));
    }

    //社員一覧詳細ページ
    public function detail(Request $request){
        $userId = $request->input('user_id');
        $user = User::find($userId);
        //詳細押した時のIDをセッションに保存
        session(['remember_user_id' => $userId]);

        $month = Carbon::today();

        $attendanceData = Time::where('user_id', $userId)
        ->whereYear('date', $month->year)
        ->whereMonth('date', $month->month)
        ->paginate(5);

        session(['remember_user_id']);

        return view('attendance_list',compact('user','month','attendanceData'));

    }

    //社員詳細ページ月変更ボタン
    public function nextMonth(Request $request){
        $next = $request->input('next');
        $month = session('remember_month', Carbon::today());

        $userId = session('remember_user_id');

        if ($next === 'next_month') {
            $month = $month->subMonth();
        } elseif ($next === 'last_month') {
            $month = $month->addMonth();
        }

        $attendanceData = Time::where('user_id', $userId)
        ->whereYear('date', $month->year)
        ->whereMonth('date', $month->month)
        ->paginate(5);

        session(['remember_month' => $month]);
        return  view('attendance_list', compact('month','attendanceData'));
    }

}
