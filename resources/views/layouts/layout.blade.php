<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('/css/custom.css') }}" type="text/css">
  <title>bravestar</title>
</head>

<body>
  <header class="navbar fixed-top" id="header-container">
    <a href="/" class="navbar-brand">
      <p class="logo"><img src="{{ asset('image/スライムアイコン-545x460.png') }}" width="30" height="30" alt="スライム">
        　bravestar
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
          <a href="/search" class="header-link">PDCA検索</a>
          <a href="user/{{ $current_user_id }}/edit" class="header-link">プロフィール編集</a>
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

  <div class="container" id="content">
    @if(session('message'))
      <div class="alert alert-success">
        {{ session('message') }}
      </div>
    @endif

    @yield('content')
  </div>

  <footer class="navbar" id="footer-container">
    <a href="mailto:mah666hhh@gmail.com?subject=PDCA美人 お問い合わせ" class="btn btn-primary">お問い合わせ</a>
    <a href="/howto" class="btn btn-default">使い方</a>
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script><!-- Scripts（Jquery） -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!-- Scripts（bootstrapのjavascript） -->
</body>
</html>
