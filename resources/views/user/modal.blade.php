<!-- 切り替えボタンの設定 -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signUpModal">
  新規登録
</button>

<!-- モーダルの設定 -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="signUpModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="signUpModalLabel">新規登録</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="/user" method="POST">
            {{ csrf_field() }}
              <div class="form-group">
                <label for="name_label" class="modal-form-label">お名前</label>
                @if($errors->has('name'))
                  @foreach($errors->get('name') as $error)
                    <span class="form-error-field">{{ $error }}</span>
                  @endforeach
                @endif
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name_label" required="true">
              </div>
              
              <div class="form-group">
                <label for="email_label" class="modal-form-label">メールアドレス</label>
                @if($errors->has('email'))
                  @foreach($errors->get('email') as $error)
                    <span class="form-error-field">{{ $error }}</span>
                  @endforeach
                @endif
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email_label" required="true">
              </div>

              <div class="form-group">
                <label for="goal_label" class="modal-form-label">目標</label>
                @if($errors->has('goal'))
                  @foreach($errors->get('goal') as $error)
                    <span class="form-error-field">{{ $error }}</span>
                  @endforeach
                @endif
                <input type="text" name="goal" value="{{ old('goal') }}" class="form-control" id="goal_label" required="true">
              </div>
      
              <div class="form-group">
                <label for="password_label" class="modal-form-label">パスワード(半角英数字6文字以上)</label>
                @if($errors->has('password'))
                  @foreach($errors->get('password') as $error)
                    <span class="form-error-field">{{ $error }}</span>
                  @endforeach
                @endif
                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password_label" required="true">
              </div>
      
              <div class="form-group">
                <label for="password_confirmation_label" class="modal-form-label">パスワード再確認</label>
                @if($errors->has('password_confirmation'))
                  @foreach($errors->get('password_confirmation') as $error)
                    <span class="form-error-field">{{ $error }}</span>
                  @endforeach
                @endif
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" id="password_confirmation_label" required="true">
              </div>
      
              <div class="form-group">
                  <input type="submit" value="登録する" class="btn btn-success">
              </div>
          </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
