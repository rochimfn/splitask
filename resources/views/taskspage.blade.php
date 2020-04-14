@extends('layouts.default')

@section('title', 'Tasks Page')

@section('content')
    <div class="d-flex justify-content-between mt-4">
        <h2>Tasks Page</h2>
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
            @foreach($tasks as $task)
        <div id="accordion" class="mt-3 col-md-8">
            <div class="card">
                <div class="card-header" id="heading{{ $task['task_id']}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $task['task_id'] }}" aria-expanded="true" aria-controls="collapse{{ $task['task_id'] }}">
                            <h3>{{ $task['task_name'] .' - '. $task['work_name'] }}</h3>
                        </button>
                        @if ($task['task_status'] == 0)
                            (On Progress)
                        @elseif ($task['task_status'] == 1)
                            (Approved)
                        @elseif ($task['task_status'] == 2)
                            (Reported)
                        @elseif ($task['task_status'] == 3)
                            (Rejected)
                        @endif
                    </h5>
                </div>

                <div id="collapse{{ $task['task_id'] }}" class="collapse" aria-labelledby="heading{{ $task['task_id'] }}" data-parent="#accordion">
                    <div class="card-body">
                      <div class="row">
                          <div class="col-sm-8 px-4">
                              <p>Description :  {{ $task['task_description'] }}</p>
                              <p>Deadline : {{ $task['task_deadline'] }}</p>
                              <p>Assigned Date : {{ substr($task['created_at'], 0, 11) }}</p>
                          </div>
                          <div class="col-sm-4">
                            @if( $task['task_status'] == 0 || $task['task_status'] == 3 )
                              <button class="btn btn-dark" onclick="addTaskReport({{ $task['task_id'] }})">Add Report</button>
                            @else
                              <button class="btn btn-dark" onclick="addTaskReport({{ $task['task_id'] }})" disabled>Add Report</button>
                            @endif
                          </div>
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
    @include('addtaskreportpopup')
@endsection
