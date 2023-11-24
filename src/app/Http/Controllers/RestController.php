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
    public function restStart(Request $request)
    {
        $user = Auth::user();
        $time = Time::get();
        foreach ($time as $time){
            $id = $time->id;
        }
        $time = Time::where('user_id', $user->id)->latest()->first();
        $rest = Rest::where('time_id', $time->id)->latest()->first();

        $rest = Rest::create([
            'time_id' => $time->id,
            'reststart' => Carbon::now(),
        ]);
        return redirect('/')->with('message', '休憩開始しました');
    }

    //休憩終了処理
    public function restEnd(Request $request)
    {
        $user = Auth::user();
        $time = Time::get();
        foreach ($time as $time){
            $id = $time->id;
        }
        $time = Time::where('user_id', $user->id)->latest()->first();
        $rest = Rest::where('time_id', $time->id)->latest()->first();

        $rest -> update([
            'restend' => carbon::now(),
        ]);

        return redirect('/')->with('message', '休憩終了しました');
    }
}
