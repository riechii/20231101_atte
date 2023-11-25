@extends('layouts.layouts')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance_list.css') }}" />
@endsection
@section('content')
    <div class='attendance'>
        <form class="attendance_button" action="/userList/nextMonth" method="post" >
            @csrf
            <button class="attendance-next" name='next' type="submit" value="next_month">&lt;</button>
        </form>
        <h2 class='attendance-date'>{{ $month->format('Y-m')}}月
        </h2>
        <form class="attendance_button" action="/userList/nextMonth" method="post" >
            @csrf
            <button class="attendance-next" name='next' type="submit" value="last_month">&gt;</button>
        </form>

        <div class='attendance-table'>
            <table class='attendance-table__inner'>
                <tr class='attendance-table__row'>
                    <th class='attendance-table__tti'>日付</th>
                    <th class='attendance-table__tti'>勤務開始</th>
                    <th class='attendance-table__tti'>勤務終了</th>
                    <th class='attendance-table__tti'>休憩時間</th>
                    <th class='attendance-table__tti'>勤務時間</th>
                </tr>
                @foreach($attendanceData as $date)
                <tr class='attendance-table__row'>
                    <td class='attendance-table__item'>
                    {{$date->date}}
                    </td>
                    <td class='attendance-table__item'>{{$date->start}}</td>
                    <td class='attendance-table__item'>     {{$date->end}}</td>
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
        @if(Route::currentRouteName() === 'detail')
            {{ $attendanceData->appends(request()->input())->links() }}
        @else
            {{ $attendanceData->links() }}
        @endif


    </div>
@endsection