@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ App\User::find($to_user_id)->name }}
                </div>
                 <div class="card-body">
                    @foreach($messages as $message)
                    @if(Auth::id() == $message->from_user_id)
                    <p class="message message-right">
                    <label class="alert alert-primary message-to" role="alert">{{ $message->content }}</label>
                    <a href="{{ route('user.show',[$message->fromUser->id]) }}">
                    <img class="avatar-small" src="{{ asset('images/avatar/'.$message->fromUser->avatar) }}"></a>
                    </p>
                    @else
                    <p class="message">
                    <a href="{{ route('user.show',[$message->fromUser->id]) }}">
                    <img class="avatar-small" src="{{ asset('images/avatar/'.$message->fromUser->avatar) }}"></a>
                    <label class="alert alert-success message-from">{{ $message->content }}</label>
</p>
                    @endif
                    @endforeach
                 </div>
                 <div class="card-body card-comment">
                    <form method="post" action="{{ route('user.message') }}">
                      <input type="hidden" id="setid" name="to_user_id" value="{{ $to_user_id }}">
                      @csrf
                      <div class="form-group">
                        <textarea class="form-control" id="comment" name="content" value="{{old('content')}}" rows="3" placeholder="回复"></textarea>
                        @if ($errors->has('content'))
                        <p class="alert alert-danger">{{ $errors->first('content') }}</p>
                        @endif
                      </div>
                      <button type="submit" class="btn btn-primary">提交</button>
                    </form>
</div>
                </div>
        </div>
    </div>
</div>
@endsection