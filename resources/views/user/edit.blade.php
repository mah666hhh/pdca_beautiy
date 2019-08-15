@extends('layouts/layout')
@section('content')
<h2>プロフィール編集</h2><br/>
<form action="/user/{{ $current_user_id }}" method="POST">
    {{ csrf_field() }}
    {{ method_field(('patch')) }}
    <div class="form-group">
        <label for="name_label">お名前</label>
        @if($errors->has('name'))
          @foreach($errors->get('name') as $error)
            <span class="form-error-field">{{ $error }}</span>
          @endforeach
        @endif
        <input type="text" name="name" value="{{ old('name', $current_user->name) }}" class="form-control" id="name_label" required="true">

        <div class="form-group">
            <label for="email_label">メールアドレス</label>
            @if($errors->has('email'))
              @foreach($errors->get('email') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <input type="email" name="email" value="{{ old('email', $current_user->email) }}" class="form-control" id="email_label" required="true">
          </div>

          <div class="form-group">
            <label for="goal_label">目標</label>
            @if($errors->has('goal'))
              @foreach($errors->get('goal') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <input type="text" name="goal" value="{{ old('goal', $current_user->goal) }}" class="form-control" id="goal_label" required="true">
          </div>

          <div class="form-group">
            <label for="password_label">パスワード(半角英数字6文字以上)</label>
            @if($errors->has('password'))
              @foreach($errors->get('password') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password_label" required="true">
          </div>

          <div class="form-group">
            <label for="password_confirmation_label">パスワード再確認</label>
            @if($errors->has('password_confirmation'))
              @foreach($errors->get('password_confirmation') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" id="password_confirmation_label" required="true">
          </div>
        <div class="form-group">
            <input type="submit" value="更新する" class="btn btn-success">
        </div>
    </div>
</form>
@endsection