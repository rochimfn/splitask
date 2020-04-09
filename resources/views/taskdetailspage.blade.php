@extends('layouts.default')

@section('title', 'Task Page')

@section('content')
    <div class="d-flex justify-content-between mt-4">
        <h2>{{ $task['task_name'] }} Details</h2>
        <div class="d-flex">
            <form action="{{action('TaskController@destroy', $task['task_id'])}}" method="post">
                <button class="btn btn-dark" type="button" onclick="editTask()">Edit Task</button>
                &nbsp;
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-dark" type="submit" onclick="return confirm('Are you sure want to delete this task?')">Delete</button>
            </form>
        </div>
    </div>
    <div class="mt-4">
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
        <div class="card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><h4>Description</h4> <h5>{{$task['task_description']}}</h5></li>
                <li class="list-group-item"><h4>Deadline</h4> <h5>{{$task['task_deadline']}}</h5></li>
                <li class="list-group-item"><h4>Asigned to</h4> <h5>{{$task['name']}}</h5></li>
                <li class="list-group-item"><h4>Status</h4>
                @if($task['task_status'] == 0)
                    <h5>On Progress</h5></li>
                    <li class="list-group-item text-right text-white">
                        <button class="btn btn-dark" disabled>See Report</button>&nbsp;<a class="btn btn-dark">Approve</a>&nbsp;
                    </li>
                @elseif($task['task_status'] == 1)
                    <h5>Approved</h5></li>
                    <li class="list-group-item text-right text-white">
                        <button class="btn btn-dark">See Report</button>&nbsp;<a class="btn btn-dark">Approve</a>&nbsp;
                    </li>
                @elseif($task['task_status'] == 2)
                    <h5>Reported</h5></li>
                    <li class="list-group-item text-right text-white">
                        <button class="btn btn-dark">See Report</button>&nbsp;<a class="btn btn-dark">Approve</a>&nbsp;
                    </li>
                @elseif($task['task_status'] == 3)
                    <h5>Rejected</h5></li>
                    <li class="list-group-item text-right text-white">
                        <a class="btn btn-dark">See Report</a>&nbsp;<a class="btn btn-dark">Approve</a>&nbsp;
                    </li>
                @endif
            </ul>
        </div>
    </div>
@endsection
@section('script')
    @include('inc.script')
    @include('edittaskpopup')
@endsection
