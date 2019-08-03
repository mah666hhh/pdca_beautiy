@extends('layouts/layout')
@section('content')
<h1>新規登録</h1>
<form action="/user" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name_label">お名前</label>
        @if($errors->has('name'))
          @foreach($errors->get('name') as $error)
            <span class="form-error-field">{{ $error }}</span>
          @endforeach
        @endif
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name_label" required="true">

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
        <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password_label" required="true">

        <label for="password_confirmation_label">パスワード再確認</label>
        @if($errors->has('password_confirmation'))
          @foreach($errors->get('password_confirmation') as $error)
            <span class="form-error-field">{{ $error }}</span>
          @endforeach
        @endif
        <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" id="password_confirmation_label" required="true">

        <div class="form-group">
            <input type="submit" value="登録する" class="btn btn-success">
        </div>
    </div>
</form>
<a href="/session/new">登録済の方はこちらからログイン</a>
@endsection
