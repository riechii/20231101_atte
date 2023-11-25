@extends('layouts.layouts')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
@endsection
@section('content')
    <div class="login">
        <h2 class="login-ttl">ログイン</h2>
        <form class="login-form" action="/login" method="post">
        @csrf
            <div class="login-form-group">
                <input class="login-item" type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
            </div>
            <div class="form__error">
                @error('email')
                {{ $message }}
                @enderror
            </div>
            <div class="login-form-group">
                <input class="login-item" type="password" name="password" placeholder="パスワード">
            </div>
            <div class="form__error">
                @error('password')
                {{ $message }}
                @enderror
            </div>
            <input class="login-btn" type="submit" value="ログイン" />
        </form>
        <div class="member">
            <p class="member-text">アカウントをお持ちでない方はこちら</p>
            <a class="member-link" href="/register">会員登録</a>
        </div>
    </div>
@endsection