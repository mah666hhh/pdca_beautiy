<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  @if(\App::isLocal())
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css">
  @elseif(env('APP_ENV') == 'production')
    <link rel="stylesheet" href="{{ secure_asset('css/custom.css') }}" type="text/css">
  @endif
  <title>PDCA Beauty</title>
</head>

<body>
  <header class="navbar fixed-top" id="header-container">
    <a href="/" class="navbar-brand">
      <p class="logo"><img src="{{ asset('image/スライムアイコン-545x460.png') }}" width="30" height="30" alt="スライム">
        　PDCA Beauty
      </p>
    </a>
    <span>
      <div class="header-link-container">
        @if(isset ($session_email))
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Menu
             <span class="caret"></span>
            </button>
            <div class="dropdown-menu header-link-list">
              <a class="dropdown-item header-link" href="/post">マイページ</a><br/>
              <a class="dropdown-item header-link" href="/search">PDCA検索</a><br/>
              <a class="dropdown-item header-link" href="user/{{ $current_user_id }}/edit">プロフィール編集</a><br/>
              <div class="dropdown-divider"></div>
              <!-- <a href="/session/logout" data-method="POST" class="header-link">ログアウト</a> -->
              <form method="post" action="/session/logout" id="logout-field">
                  {{ csrf_field() }}
                  {{ method_field(('delete')) }}
                  <!-- <input name="_method" type="hidden" value="DELETE"> -->
                  <input type="submit" value="ログアウト" class="btn btn-default">
              </form>
              <!-- <a class="dropdown-item header-link" href="#">その他リンク</a> -->
            </div><!-- /.dropdown-menu -->
          </div><!-- /.btn-group -->
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script><!-- Scripts（Jquery） -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!-- Scripts（bootstrapのjavascript） -->
</body>
</html>
