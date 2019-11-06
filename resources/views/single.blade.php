@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span>Created by : {{$task['assignee']['name']}}</span>
                    </div>

                    <div class="card-body">
                        {{$task['description']}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
