@extends('layouts/layout')
@section('content')
<div class="welcome-message-container">
  <h1>ようこそPDCA美人へ!</h1>
  <h2>良い習慣を身に付けて、出來る美人になりましょう!</h2>
  @unless (isset ($session_email))
      <a href="/session/new" class="btn btn-primary">ログイン</a>
      <a href="/user/create" class="btn btn-default">新規登録</a>
  @endunless
</div>
@endsection
