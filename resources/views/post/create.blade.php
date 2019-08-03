
@extends('layouts/layout')
@section('content')
    <h1>PDCA投稿ページ</h1>
    (*は必須入力)
    <form action="/post" method="POST">
        {{ csrf_field() }}
    <!-- {!! Form::open() !!} -->
        <div class="form-group">
            <!-- 第一引数name属性 第二引数value -->
            <!-- {!! Form::label('post_date', '投稿日:') !!} -->
            <!-- ラベルを使用する場合はtextの第一引数と合わせること -->
            <!-- {!! Form::text('post_date', null, ['class' => 'form-control']) !!} -->

            <!-- labelのforと、inputのidを一致させると、ラベルと入力エリアを紐つけることが出來る -->
            <label for="post_day_label">PDCA実施日*</label>
            @if($errors->has('post_day'))
              @foreach($errors->get('post_day') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <input type="date" name="post_day" value="{{ old('post_day') }}" required="true" class="form-control" id="post_day_label">
        </div>
        <div class="form-group">
            <label for="plan_label">Plan*</label>
            @if($errors->has('plan'))
              @foreach($errors->get('plan') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <textarea class="form-control" name="plan" value="{{ old('plan') }}" id="plan_label" required="true"></textarea>
            <!-- {!! Form::label('plan', 'P:') !!}
            {!! Form::textarea('plan', null, ['class' => 'form-control']) !!} -->
        </div>
        <div class="form-group">
            <label for="do_label">Do*</label>
             @if($errors->has('do'))
              @foreach($errors->get('do') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <textarea class="form-control" name="do" id="do_label" value="{{ old('do') }}" required="true"></textarea>
            <!-- {!! Form::label('do', 'D:') !!}
            {!! Form::textarea('do', null, ['class' => 'form-control']) !!} -->
        </div>
        <div class="form-group">
            <label for="check_label">Check*</label>
             @if($errors->has('check'))
              @foreach($errors->get('check') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <textarea class="form-control" name="check" id="check_label" value="{{ old('check') }}" required="true"></textarea>
            <!-- {!! Form::label('check', 'C:') !!}
            {!! Form::textarea('check', null, ['class' => 'form-control']) !!} -->
        </div>
        <div class="form-group">
            <label for="action_label">Action*</label>
             @if($errors->has('action'))
              @foreach($errors->get('action') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
            <textarea class="form-control" name="action" id="action_label" value="{{ old('action') }}" required="true"></textarea>
            <!-- {!! Form::label('action', 'A:') !!}
            {!! Form::textarea('action', null, ['class' => 'form-control']) !!} -->
        </div>
        <div class="form-group">
          <label for="wakeup_time_label">起床時間</label>
           @if($errors->has('wakeup_time'))
              @foreach($errors->get('wakeup_time') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
          <input type="time" class="form-control" name="wakeup_time" id="wakeup_time_label" value="{{ old('wakeup_time') }}">
        </div>
        <div class="form-group">
          <label for="bed_time_label">就寝時間</label>
           @if($errors->has('bed_time'))
              @foreach($errors->get('bed_time') as $error)
                <span class="form-error-field">{{ $error }}</span>
              @endforeach
            @endif
          <input type="time" class="form-control" name="bed_time" id="bed_time_label" value="{{ old('bed_time') }}">
        </div>

        <div class="form-group">
            <input type="submit" value="投稿する" class="btn btn-primary">
            <!-- {!! Form::submit('PDCA投稿', ['class' => 'btn btn-primary form-control']) !!} -->
        </div>

        <!-- {!! Form::close() !!} -->
  </form>
@endsection
