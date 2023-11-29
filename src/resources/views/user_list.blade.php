@extends('layouts.layouts')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/user_list.css') }}" />
@endsection
@section('content')
    <div class='user-list'>
        <h2 class='user-list__ttl'>社員一覧</h2>
        <div class='user-list__table'>
            <table class='user-list__table__inner'>
                <tr class='user-list__table__row'>
                    <th class='user-list__table__ttl'>名前</th>
                    <th class='user-list__table__ttl'>メールアドレス</th>
                </tr>
                @foreach($users as $user)
                <form class='user-list__btn' action="/userList/detail"  method='get'>
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <tr class='user-list__table__row'>
                        <td class='user-list__table__item'>{{$user->name}}</td>
                        <td class='user-list__table__item'>{{$user->email}}</td>
                        <td class='user-list__table__item'><button class="user-list__btn__submit" type="submit" value="">詳細</button></td>
                    </tr>
                </form>
                @endforeach
            </table>
        </div>
        {{ $users->links() }}
    </div>

@endsection