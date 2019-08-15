@extends('layouts/layout')
@section('content')
<div class="welcome-message-container">
  <h1 class="welcome-app-name">bravestar</h1>
  <h2>★サロン生の自走をサポートするアプリ★</h2>
</div><br/>
<div class="signin-signup-modal">
  @unless (isset ($session_email))
    @include('session/modal')
    @include('user/modal')
      <!-- <a href="/session/new" class="btn btn-primary">ログイン</a><br/> -->
      <!-- <a href="/user/create" class="btn btn-default">新規登録</a> -->
  @endunless
</div><br/>
<div class="proverb-area">
  <h1>〜今日の一言〜</h1>
  <h3 style="font-style:italic;">{{ $proverb }}</h3>
</div>
@endsection
