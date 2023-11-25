@extends('layouts.app')
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 5px;
    }

    a {
        color: #007bff;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">本登録</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            メールが送信されました。
                        </div>
                    @endif

                    メールを送信しました。メールからメールアドレスの認証をお願いします。<br>
                    メールが届いていない場合は、
                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit">メールを再送信</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection