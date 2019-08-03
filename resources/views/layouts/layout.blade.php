<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('/css/custom.css') }}" type="text/css">
  <title>PDCA美人</title>
</head>

<header class="navbar fixed-top" id="header-container">
  <a href="/" class="navbar-brand">
    <p class="logo"><img src="{{ asset('image/スライムアイコン-545x460.png') }}" width="30" height="30" alt="スライム">
      　PDCA美人
    </p>
  </a>
  <span>
    <div align="right" class="header-link-container">
      <span>$session_emailにある値:
      @if(isset ($session_email))
        {{ $session_email }}
      @else
        空です
      @endif
      </span>
      @if(isset ($session_email))
        <a href="/post" class="header-link">PDCA一覧</a>
        <a href="/post/create" class="header-link">PDCA投稿</a>
        <!-- <a href="/session/logout" data-method="POST" class="header-link">ログアウト</a> -->
        <form method="post" action="/session/logout" id="logout-field">
            {{ csrf_field() }}
            {{ method_field(('delete')) }}
            <!-- <input name="_method" type="hidden" value="DELETE"> -->
            <input type="submit" value="ログアウト" class="btn btn-primary">
        </form>
      @endif
  </span>
</header>

@if(session('message'))
  <div class="alert alert-success">
    {{ session('message') }}
  </div>
@endif

@yield('content')

<footer class="navbar fixed-bottom" id=footer-container>
  <a href="mailto:mah666hhh@gmail.com?subject=PDCA美人 お問い合わせ" class="btn btn-primary">お問い合わせ</a>
  <a href="/howto" class="btn btn-default">使い方</a>
</footer>
