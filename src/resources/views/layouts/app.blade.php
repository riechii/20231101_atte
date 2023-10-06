<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header-nav">
            <h1 class="header-ttl">
                <a class="header-logo" href="">Atte</a>
            </h1>
            <nav class="header-nav-list">
                <ul class="header-nav-inner">
                    @if (Auth::check())
                    <li class="header-nav-item"><a class="header-nav-item-list" href="/">ホーム</a></li>
                    <li class="header-nav-item"><a class="header-nav-item-list" href="/attendance">日付一覧</a></li>
                    <li class="header-nav-item">
                        <form action="/logout" method="post">
                        @csrf
                            <button class="header-nav-btn" href="">ログアウト</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <small>Atte,inc.</small>
    </footer>
</html>