@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">提问</div>

                <div class="card-body">
                    <form method="post" action="{{ route('question.store') }}">
                      @csrf
                      <div class="form-group">
                        <label for="question">问题</label>
                        <input type="text" name="title" class="form-control" id="question" value="{{old('title')}}">
                        @if ($errors->has('title'))
                        <p class="alert alert-danger">{{ $errors->first('title') }}</p>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="description">问题描述</label>
                        <textarea class="form-control" name="description" id="description" rows="8">{{old('description')}}</textarea>
                        @if ($errors->has('description'))
                        <p class="alert alert-danger">{{ $errors->first('description') }}</p>
                        @endif
                      </div>
                      <div class="form-group">
                        <label for="Label">标签</label>
                        <input type="text" class="form-control" name="labels" id="labels" value="{{old('labels')}}" placeholder="多个标签用空格分隔">
                        @if ($errors->has('labels'))
                        <p class="alert alert-danger">{{ $errors->first('labels') }}</p>
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