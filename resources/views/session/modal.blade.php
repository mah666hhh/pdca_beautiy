<!-- 切り替えボタンの設定 -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signInModal">
  ログイン
</button>

<!-- モーダルの設定 -->
<div class="modal fade" id="signInModal" tabindex="-1" role="dialog" aria-labelledby="signInModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="signInModalLabel">ログイン</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(isset ($message))
          <div class="alert alert-danger">
            <li>{{ implode(array_values($message)) }}</li>
          </div>
        @endif
        <form action="/session/login" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="signin_email_label" class="modal-form-label">メールアドレス</label>
            @if($errors->has('email'))
              @foreach($errors->get('email') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="signin_email_label" required="true">
          </div>

          <div class="form-group">
            <label for="signin_password_label" class="modal-form-label">パスワード</label>
              @if($errors->has('password'))
                @foreach($errors->get('password') as $error)
                  <span class="form-error-field">{{ $error }}</span>
                @endforeach
              @endif
            <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="signin_password_label" required="true">
          </div>

          <div class="form-group">
              <input type="submit" value="ログインする" class="btn btn-success">
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->