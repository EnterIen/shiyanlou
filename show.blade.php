@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">评论</div>

                <ul class="list-group list-group-flush">
                @foreach($comments as $comment)
                    <li class="list-group-item">
                    <a href="{{ route('user.show',[$comment->user->id]) }}"><img class="avatar-small" src="{{ asset('images/avatar/'.$comment->user->avatar) }}">
                    {{ $comment->user->name }}
                    </a>
                    @if($pid = $comment->parent_id)
                    回复
                    <a href="{{ route('user.show',[$pid]) }}">
                    {{ App\User::where('id',$pid)->first()->name }}
                    </a>
                    @endif
                    <p class="comment-content">{{ $comment->content }}
                    <a class="btn-card-right btn-reply" href="javascript:void(0)" data-id="{{ $comment->user->id }}" data-name="{{ $comment->user->name }}">回复</a>
                    </p>
                    </li>
                @endforeach
                </ul>
                <div class="card-body card-comment">
                    <form method="post" action="{{ route('comment.store') }}">
                      <input type='hidden' name='commentable_id' value="{{ $commentable_id }}">
                      <input type='hidden' name='commentable_type' value="{{ $commentable_type }}">
                      @csrf
                      <div class="form-group">
                        <input type="text" class="form-control" name="content" id="comment" value="{{old('content')}}" placeholder="添加评论">
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