@extends('layouts/layout')
@section('content')
<!-- // 検索フォーム -->
  <h2>PDCA検索</h2>
  <div class="row">
    <div class="col-md-3">
      <h3>検索条件</h3>
      <form action="/search" method="GET">
        <div class="form-group">
          @if($post_start_day && $post_end_day)
            <label for="post_day_label">PDCA実施日</label><br/>
            <input type="date" class="form-control post-day-time-area" name="post_start_day" value="{{ $post_start_day }}" id="post_day_label" require="true">から
            <input type="date" class="form-control post-day-time-area" name="post_end_day" value="{{ $post_end_day }}" id="post_day_label" require="true">
          @else
            <label for="post_day_label">PDCA実施日</label><br/>
            <input type="date" class="form-control post-day-time-area" name="post_start_day" id="post_day_label">から
            <input type="date" class="form-control post-day-time-area" name="post_end_day" id="post_day_label">
          @endif

          <br/>

          @if($post_user_name)
            <label for="post_user_name_label">投稿者名</label>
            <select class="form-control post-user-name-area" name="post_user_name">
              @if($users_name)
                @foreach($users_name as $user_name)
                  <!-- 投稿者名と投稿者一覧が一致するものをselectedにする -->
                  @if($post_user_name == $user_name)
                    <option value={{ $post_user_name }} selected>{{ $post_user_name }}</option>
                  @else
                    <option value={{ $user_name }}>{{ $user_name }}</option>
                  @endif
                @endforeach
              @endif
            </select>
          @else
            <label for="post_user_name_label">投稿者名</label>
            <select class="form-control post-user-name-area" name="post_user_name">
              <option value="選択して下さい">選択して下さい</option>
              @if($users_name)
                @foreach($users_name as $user_name)
                  <option value={{ $user_name }}>{{ $user_name }}</option>
                @endforeach
              @endif
            </select>
          @endif

          @if($plan)
            <label for="plan_label">Plan</label>
            <input type="checkbox" name="plan" value="{{ $plan }}" id="plan_label">
          @else
            <label for="plan_label">Plan</label>
            <input type="checkbox" name="plan" id="plan_label">
          @endif

          @if($do)
            <label for="do_label">Do</label>
            <input type="checkbox" name="do" value="{{ $do }}" id="do_label">
          @else
            <label for="do_label">Do</label>
            <input type="checkbox" name="do" id="do_label">
          @endif

          @if($check)
            <label for="check_label">Check</label>
            <input type="checkbox" name="check" value="{{ $check }}" id="check_label">
          @else
            <label for="check_label">Check</label>
            <input type="checkbox" name="check" id="check_label">
          @endif

          @if($action)
            <label for="action_label">Action</label>
            <input type="checkbox" name="action" value="{{ $action }}" id="action_label"><br/>
          @else
            <label for="action_label">Action</label>
            <input type="checkbox" name="action" id="action_label"><br/>
          @endif
          <input type="submit" value="検索" class="btn btn-primary">
        </div>
      </form>
      <form action="/search" method="GET">
        <div class="form-group">
          <input type="submit" value="表示内容をリセット" class="btn btn-default">
        </div>
      </form>
    </div>
  </div>
  <table class="table table-bordered" style="table-layout:fixed;width:100%;">
        @if($posts)
        <thead>
            <tr>
                <th>PDCA実施日</th>
                <th>投稿者名</th>
                <th>Plan</th>
                <th>Do</th>
                <th>Check</th>
                <th>Action</th>
                <th style="width:73px;">起床時間</th>
                <th style="width:73px;">就寝時間</th>
                <th style="width:88px text-ailgn:center;">投稿日時</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
              <td>{!! nl2br(e($post->post_day)) !!}</td>
              <td>{!! nl2br(e($post->user->name)) !!}</td>

              <td>{!! nl2br(e($post->plan)) !!}</td>
              <td>{!! nl2br(e($post->do)) !!}</td>
              <td>{!! nl2br(e($post->check)) !!}</td>
              <td>{!! nl2br(e($post->action)) !!}</td>
              <td class="index-pdca-time">{{ substr($post->wakeup_time, 0, 5) }}</td>
              <td class="index-pdca-time">{{ substr($post->bed_time, 0, 5) }}</td>
              <td class="index-pdca-text">{{ $post->created_at }}</td>

              <!-- 自分のPDCAの場合のみ編集ボタンを表示する -->
              <td class="index-pdca-edit-btn">
                @if($current_user_id == $post->user_id)
                  <a href="/post/{{ $post->id }}/edit" class="btn btn-success">PDCA編集</a>
                @endif
              </td>
            </tr>
            @endforeach
        @else

          @if(
              !empty ($planItems) && $planItems !== null ||
              !empty ($doItems) && $doItems !== null ||
              !empty ($checkItems) && $checkItems !== null ||
              !empty ($actionItems) && $actionItems !== null
            )
              <tr>
                <th class="search-th">PDCA実施日</th>
                <th class="search-th">投稿者名</th>

                @unless(empty ($planItems))
                  <th class="search-th">Plan</th>
                @endif

                @unless(empty ($doItems))
                  <th class="search-th">Do</th>
                @endif

                @unless(empty ($checkItems))
                  <th class="search-th">Check</th>
                @endif

                @unless(empty ($actionItems))
                  <th class="search-th">Action</th>
                @endif
              </tr>

              @if(
                !empty ($planItems) && $planItems !== null ||
                !empty ($doItems) && $doItems !== null ||
                !empty ($checkItems) && $checkItems !== null ||
                !empty ($actionItems) && $actionItems !== null
              )

                @if($targets = $planItems ?: $doItems ?: $checkItems ?: $actionItems)
                  @foreach($targets as $target)
                    <tr>
                      <td>{!! nl2br(e($target->post_day)) !!}</td>
                      <td>{!! nl2br(e($target->user->name)) !!}</td>

                      @unless(empty ($planItems))
                        <td>{!! nl2br(e($target->plan)) !!}</td>
                      @endif

                      @unless(empty ($doItems))
                        <td>{!! nl2br(e($target->do)) !!}</td>
                      @endif

                      @unless(empty ($checkItems))
                        <td>{!! nl2br(e($target->check)) !!}</td>
                      @endif

                      @unless(empty ($actionItems))
                        <td>{!! nl2br(e($target->action)) !!}</td>
                      @endif
                  @endforeach
                @endif
              @endif
          @endif
        @endif
        </tbody>
    </table>
@endsection
