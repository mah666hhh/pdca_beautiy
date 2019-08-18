@extends('layouts/layout')
@section('content')
    <table class="table table-bordered" style="table-layout:fixed;width:100%;">
        <thead>
            <tr>
                <th style="width:99px;">PDCA実施日</th>
                <th>Plan</th>
                <th>Do</th>
                <th>Check</th>
                <th>Action</th>
                <th style="width:73px;">起床時間</th>
                <th style="width:73px;">就寝時間</th>
                <th>投稿日時</th>
                <th style="width:108px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
              <td>{{ $post->post_day }}</td>
              <td>{!! nl2br(e($post->plan)) !!}</td>
              <td>{!! nl2br(e($post->do)) !!}</td>
              <td>{!! nl2br(e($post->check)) !!}</td>
              <td>{!! nl2br(e($post->action)) !!}</td>
              <td class="index-pdca-time">{{ substr($post->wakeup_time, 0, 5) }}</td>
              <td class="index-pdca-time">{{ substr($post->bed_time, 0, 5) }}</td>
              <td class="index-pdca-text">{{ $post->created_at }}</td>
              <td class="index-pdca-edit-btn"><a href="/post/{{ $post->id }}/edit" class="btn btn-success">PDCA編集</a></td>
            </tr>
            @endforeach
        </tbody>
    </table><br/>
    @include('post/create')
@endsection
