@extends('layouts/layout')
@section('content')
<div class="welcome-message-container">
  <h1 class="welcome-app-name">PDCA Beauty</h1>
</div><br/>
<div class="signin-signup-modal">
  @unless (isset ($session_email))
    @include('session/modal')
    @include('user/modal')
  @endunless
</div><br/>
<div class="proverb-area">
  <h1>〜今日の一言〜</h1>
  <h3 style="font-style:italic;">{{ $proverb }}</h3>
</div>
@endsection
