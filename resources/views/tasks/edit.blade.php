@extends('layouts.app')

@include('errors')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Edit Task # - {{ $task->id }}</h3>
                <div class="col-md-12">
                    {!! Form::open(['route' => ['tasks.update', $task->id], 'method'=>'PUT']) !!}

                    <div class="form-group">
                        <input type="text" class="form-control" name="title" value="{{$task->title}}">
                        <br>
                        <textarea name="description" id=""
                                  cols="30"
                                  rows="10"
                                  class="form-control">{{ $task->description }}
                            </textarea>
                        <br>
                        <button class="btn btn-success">Submit</button>
                    </div>

                    {!! Form::close() !!}
                </div>
        </div>
@endsection
