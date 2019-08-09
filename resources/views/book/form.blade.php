<div class="container ops-main">
  <div class="row">
    <div class="col-md-6">
      <h2>書籍登録</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 col-md-offset-1">

      @include('message')

      @if($target == 'store')
      <form action="/book" method="post">
        @elseif($target == 'update')
        <form action="/book/{{ $book->id }}" method="post">
          <input type="hidden" name="_method" value="PUT">
          @endif
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label for="name">書籍名</label>
            <input type="text" class="form-control" name="name" value="{{ $book->name }}">
          </div>
          <div class="form-group">
            <label for="price">価格</label>
            <input type="text" class="form-control" name="price" value="{{ $book->price }}">
          </div>
          <div class="form-group">
            <label for="author">著者</label>
            <input type="text" class="form-control" name="author" value="{{ $book->author }}">
          </div>
          @if($target == 'store')
          <button type="submit" class="btn btn-success">登録</button>
          @elseif($target == 'update')
          <button type="submit" class="btn btn-sucesss">更新</button>
          @endif
          <a href="/book" class="btn btn-primary">戻る</a>
        </form>
    </div>
  </div>
</div>