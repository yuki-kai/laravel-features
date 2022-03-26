<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS 読み込み -->
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- fontawesome 読み込み -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <!-- jQuery 読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- CSS only Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>
<body>

<header class="sticky-top">
    <div class="header-wrapper">
        <div class="header-left">
            <h1><a href="{{ route('user.index') }}">Laravel Features</a></h1>
        </div>
        <div class="header-right">
            {{-- <span>ユーザー：</span> --}}
        </div>
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item dropdown">
            <a class="nav-link" href="{{ route('user.index') }}" role="button">
                ユーザ一覧全般機能
            </a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                スクラッチのログイン機能
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="">動画新規作成画面</a></li>
                <li><a class="dropdown-item" href="">動画一覧画面</a></li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                サムネイル自動生成機能
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="">デジタルサイネージ登録画面</a></li>
                <li><a class="dropdown-item" href="{{ route('video.index') }}">動画一覧画面</a></li>
            </ul>
        </li>
    </ul>
</header>

<body>
    @yield('content')
</body>
