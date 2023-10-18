@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/attendance.css') }}" />
@endsection
@section('content')
    <div class='attendance'>
        @foreach($time as $tim)
        <h2 class='attendance-date'>{{$tim->date}}</h2>
        @endforeach
        {{ $time->links() }}
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
                        {{gmdate("H:i:s",(strtotime($rest->restend)-strtotime($rest->reststart)))}}
                        
                      
                    </td>
                    <td class='attendance-table__item'>
                        {{gmdate("H:i:s",(strtotime($tim->end)-strtotime($tim->start)))}}
                    </td>
                </tr>
                @endforeach


            </table>
        </div>
    </div>
@endsection