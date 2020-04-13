@extends('layouts.default')

@section('title', 'Works Page')

@section('content')
    <div class="d-flex justify-content-between mt-4">
        <h2>Works Page</h2>
    </div>
    <div class="mt-2">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{\Session::get('success') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            @foreach($works as $work)
        <div id="accordion" class="mt-3 col-md-8">
            <div class="card">
                <div class="card-header" id="heading{{$work['work_id']}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$work['work_id']}}" aria-expanded="true" aria-controls="collapse{{$work['work_id']}}">
                            <h3>{{ $work['work_name'] }}</h3>
                        </button>
                    </h5>
                    <div class="row">
                        <div class="col-sm-8 px-4">
                            <p>Description :  {{ $work['work_description'] }}</p>
                            <p>Deadline : {{ $work['work_deadline'] }}</p>
                            <p>Assigned Date : {{ substr($work['created_at'], 0, 11) }}</p>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-dark" onclick="addWorkReport({{ $work['work_id'] }})">Add Report</button>
                        </div>
                    </div>
                </div>

                <div id="collapse{{ $work['work_id'] }}" class="collapse" aria-labelledby="heading{{ $work['work_id'] }}" data-parent="#accordion">
                    <div class="card-body">
                        @foreach($tasks as $task)
                            @if($task['work_id'] == $work['work_id'])
                        <a href="{{ action('TaskController@show',$task['task_id'])}}" class="text-decoration-none text-black-50"><h4>{{ $task['task_name'] }}</h4></a>
                        <hr>
                            @endif
                        @endforeach
                        <div class="text-center">
                            <button class="btn btn-light" onclick="addTask({{ $work['work_id'] }})">+ Add Task</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                @endforeach
    </div>
@endsection
@section('script')
    @include('inc.script')
    @include('addtaskpopup')
    @include('addworkreportpopup')
@endsection
