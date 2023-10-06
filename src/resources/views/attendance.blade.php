@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
@endsection
@section('content')
    <div class='attendance'>
        <h2 class='attendance-date'>見たい日付</h2>
        <div class='attendance-table'>
            <table class='attendance-table__inner'>
                <tr class='attendance-table__row'>
                    <th class='attendance-table__tti'>名前</th>
                    <th class='attendance-table__tti'>勤務開始</th>
                    <th class='attendance-table__tti'>勤務終了</th>
                    <th class='attendance-table__tti'>休憩時間</th>
                    <th class='attendance-table__tti'>勤務時間</th>
                </tr>
                <tr class='attendance-table__row'>
                    <td class='attendance-table__item'>テスト</td>
                    <td class='attendance-table__item'>テスト</td>
                    <td class='attendance-table__item'>テスト</td>
                    <td class='attendance-table__item'>テスト</td>
                    <td class='attendance-table__item'>テスト</td>
                </tr>
            </table>
        </div>
    </div>
@endsection