@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection
@section('content')
    <div class="stamping">
        <h2 class="stamping-name">{{ Auth::user()->name }}さんお疲れ様です！</h2>
        @if (session('message'))
            <div class="stamping__alert--success">
                {{ session('message') }}
            </div>
        @endif
        <div class="stamping-attendance_panel">

            <form class="attendance_button" action="/time" method="post">
            @csrf
                <button class="attendance__button-submit" type="submit">勤務開始</button>
            </form>
            <form class="attendance_button" action="/time/update" method="post">
            @csrf
                <button class="attendance__button-submit" type="submit" disabled>勤務終了</button>
            </form>
        </div>
        <div class="stamping-break_panel">
            <form class="break_button" action="/rest" method="post">
            @csrf
                <button class="break__button-submit" type="submit" disabled>休憩開始</button>
            </form>
            <form class="break_button" action="/rest/update" method="post">
            @csrf
                <button class="break__button-submit" type="submit" disabled>休憩終了</button>
            </form>
        </div>
    </div>
@endsection
