@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
@endsection
@section('content')
    <div class='attendance'>
        <form class="attendance_button" action="/attendance_list" method="get" >
            @csrf
            <button class="attendance-next" type="submit" value="{{  \Carbon\Carbon::yesterday()->format('Y-m-d')}}">&lt;</button>
        </form>
        <h2 class='attendance-date'>{{  \Carbon\Carbon::today()->format('Y-m-d')}}</h2>
        <form class="attendance_button" action="/attendance_list" method="get" >
            @csrf
            <button class="attendance-next" type="submit" >&gt;</button>
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
                
                
                <tr class='attendance-table__row'>
                    @foreach($time as $tim)
                    <td class='attendance-table__item'>
           
                    {{$tim->user->name}}

                    </td>
                    
                    
                    <td class='attendance-table__item'>{{$tim->start}}</td>
                   
                    <td class='attendance-table__item'>{{$tim->end}}</td>
                    <td class='attendance-table__item'>
                       
                    
                    {{$hms}}
                        
                      
                    </td>

                    <td class='attendance-table__item'>
                        {{gmdate("H:i:s",(strtotime($tim->end)-strtotime($tim->start)))}}
                    </td>
                </tr>
                @endforeach
{{ $time->links() }}

            </table>
        </div>
    </div>
@endsection