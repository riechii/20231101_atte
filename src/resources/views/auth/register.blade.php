@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection
@section('content')
    <div class="member">
        <h2 class="member-ttl">会員登録</h2>
        <form class="member-form" action="/register" method="post">
        @csrf
            <div class="member-form-group">
                <input class="member-item" type="text" name="name" placeholder="名前" value="{{ old('name') }}">
            </div>
            <div class="form__error">
                @error('name')
                {{ $message }}
                @enderror
            </div>
            <div class="member-form-group">
                <input class="member-item" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <div class="member-form-group">
                <input class="member-item" type="password" name="password" placeholder="パスワード" >
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
            <div class="member-form-group">
                <input class="member-item" type="password" name="password_confirmation" placeholder="確認用パスワード">
            </div>
            <input class="member-btn" type="submit" value="会員登録" />
        </form>
        <div class="login">
            <p class="login-text">アカウントをお持ちの方はこちら</p>
            <a class="login-link" href="/login">ログイン</a>
        </div>
    </div>
@endsection