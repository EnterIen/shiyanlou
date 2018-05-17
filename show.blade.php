@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">通知
                @if($notifications->count() > 0)
                <a href="{{ route('notification.read') }}" class="btn-card-right">标记已读</a>
                @endif
                </div>

                <ul class="list-group list-group-flush">
                    @if($notifications->count() == 0)
                    <li class="list-group-item">暂无通知</li>
                    @else

                    @foreach($notifications as $note)
                    <li class="list-group-item{{ $note->read_at ? '':' message-new' }}">
                    <a href="{{ route('user.show',[$note->data['user']['id']]) }}"> {{ $note->data['user']['name'] }} </a>
                    {{ $note->data['note'] }}
                    @switch($note->type)
                    @case('App\Notifications\FollowNotification')
                    @break
                    @case('App\Notifications\MessageNotification')
                    <a href="{{ route('message.read',[$note->data['user']['id']]) }}"> 查看</a>
                    @break
                    @case('App\Notifications\CommentQuestionNotification')
                    <a href="{{ route('question.show',[$note->data['question']['id']]) }}"> {{ $note->data['question']['title'] }}</a>
                    @break

                    @default
                    <a href="{{ route('question.show',[$note->data['question']['id']]) }}#answer{{ $note->data['answer'] }}"> {{ $note->data['question']['title'] }}</a>
                    @endswitch

                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection