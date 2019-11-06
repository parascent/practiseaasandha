@extends('layouts.app')

@section('content')
<div class="container">

    @if(Auth::user()->is_admin == true)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add new task</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tasks') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus>

                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="assignee" class="col-md-4 col-form-label text-md-right">assignee</label>

                            <div class="col-md-6">
                                <select name="assignee" id="assignee">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @error('assignee')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Task
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    
    <br>
    @foreach($tasks as $task)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Created by : {{$task['assignee']['name']}}</span>
                    <span>Status : {{$task['completed'] == false ? "Todo" : "Completed"}}</span>
                    @if(Auth::user()->is_admin == true)
                    <form method="POST" action="/tasks/{{$task['id']}}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" >Delete</button>
                    </form>
                    {{-- <button href="{{ route('normindex') }}">Edit</button> --}}
                    @endif

                    @if($task['completed'] == false)
                    <form method="POST" action="/tasks/{{$task['id']}}/markdone">
                        @csrf
                        {{ method_field('PATCH') }}
                        <button class="btn btn-primary" type="submit">Mark as complete</button>
                    </form>
                    @endif
                    
                </div>

                <div class="card-body">
                   {{$task['description']}}
                </div>
            </div>
        </div>
    </div>
        <br>
    @endforeach
</div>
@endsection
