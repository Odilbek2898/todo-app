@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Todo App</h3>
    <a href="{{ route('tasks.create') }}" class="btn btn-success">Create</a>
    <br>
    <br>
    <div class="row">
    <div class="col-md-12">
        @foreach($tasks as $task)
            @if($task->user_id == \Illuminate\Support\Facades\Auth::id())
            <div class="alert alert-info" style="border: double">
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->description }}</p>
                <p><small>{{ $task->created_at }}</small></p>
                <a href="{{ route('tasks.edit', $task->id) }}">
                    <button class="btn btn-info">Редактировать</button>
                </a>

                {!! Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', $task->id]]) !!}
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Удалить</button>
                {!! Form::close() !!}
            </div>
            @endif
        @endforeach
    </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-body">
                {{ $tasks->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection
