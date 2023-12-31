@extends('layouts.layouts')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
@endsection
@section('content')
    <div class='attendance'>
        <form class="attendance_button" action="/attendance/nextDay" method="post" >
            @csrf
            <button class="attendance-next" name='next' type="submit" value="yesterday">&lt;</button>
        </form>
        <h2 class='attendance-date'>{{ $today->format('Y-m-d')}}</h2>
        <form class="attendance_button" action="/attendance/nextDay" method="post" >
            @csrf
            <button class="attendance-next" name='next' type="submit" value="tomorrow">&gt;</button>
        </form>

        <div class='attendance-table'>
            <table class='attendance-table__inner'>
                <tr class='attendance-table__row'>
                    <th class='attendance-table__tti'>名前</th>
                    <th class='attendance-table__tti'>勤務開始</th>
                    <th class='attendance-table__tti'>勤務終了</th>
                    <th class='attendance-table__tti'>休憩時間</th>
                    <th class='attendance-table__tti'>勤務時間</th>
                </tr>
                @foreach($dates as $date)
                <tr class='attendance-table__row'>
                    <td class='attendance-table__item'>
                    {{$date->user->name}}
                    </td>
                    <td class='attendance-table__item'>{{$date->start}}</td>
                    <td class='attendance-table__item'>{{$date->end}}</td>
                    <td class='attendance-table__item'>
                    @php
                        $totalRestTime = 0;
                    @endphp
                    @foreach($date->rest as $rest)
                    @php
                        $restTime = strtotime($rest->restend) - strtotime($rest->reststart);
                        $totalRestTime += $restTime;
                    @endphp
                    @endforeach
                        {{ gmdate("H:i:s", $totalRestTime) }}
                    </td>
                    <td class='attendance-table__item'>
                        {{gmdate("H:i:s",(strtotime($date->end)-strtotime($date->start)-$totalRestTime))}}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        {{ $dates->links() }}
    </div>
@endsection