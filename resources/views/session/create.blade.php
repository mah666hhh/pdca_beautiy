@extends('layouts/layout')
@section('content')
<h1>ログイン画面</h1>
@if(isset ($message))
<div class="alert alert-danger">
  <li>{{ implode(array_values($message)) }}</li>
</div>
@endif
<form action="/session/login" method="POST">
    {{ csrf_field() }}
    <div class="form-group">

        <label for="email_label">メールアドレス</label>
        @if($errors->has('email'))
          @foreach($errors->get('email') as $error)
            <span class="form-error-field">{{ $error }}</span>
          @endforeach
        @endif
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email_label" required="true">

        <label for="password_label">パスワード</label>
        @if($errors->has('password'))
          @foreach($errors->get('password') as $error)
            <span class="form-error-field">{{ $error }}</span>
          @endforeach
        @endif
        <input type="password" name="password" value="{{ old('password')) }}" class="form-control" id="password_label" required="true">

        <div class="form-group">
            <input type="submit" value="ログインする" class="btn btn-success">
        </div>
    </div>
</form>
<a href="/user/create">登録がまだの方はこちら</a>
@endsection
