@extends('layouts.default')

@section('title', 'Task Details Page')

@section('content')
    <div class="d-flex justify-content-between mt-4">
        <span>
            <h2>{{ $task['task_name'] }} Details</h2>
            <a href="{{ url('/') }}">
            <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 24 24" width="24"><path d="M11.67 3.87L9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12z"/><path d="M0 0h24v24H0z" fill="none"/></svg>Go back</a>
        </span>
        <div class="d-flex">
            <form action="{{ route('manager.tasks.destroy', $task['task_id'])}}" method="post">
                <button class="btn btn-dark" type="button" onclick="editTask()">Edit Task</button>
                &nbsp;
                {{csrf_field()}}
                @method('DELETE')
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
                <li class="list-group-item"><h4>Assigned to</h4> <h5>{{$task['name']}}</h5></li>
                <li class="list-group-item"><h4>Status</h4>
                @if($task['task_status'] == 0)
                    <h5>On Progress</h5></li>
                    <li class="list-group-item text-right text-white">
                        <button class="btn btn-dark" disabled>See Report</button>&nbsp;<button class="btn btn-dark" disabled>Action</button>&nbsp;
                    </li>
                @elseif($task['task_status'] == 1)
                    <h5>Approved</h5></li>
                    <li class="list-group-item text-right text-white">
                        <a href="{{ asset('reports/tasks/'.$task['task_report']) }}" target="_blank" class="btn btn-dark">See Report</a>&nbsp;<button class="btn btn-dark" disabled>Action</button>&nbsp;
                    </li>
                @elseif($task['task_status'] == 2)
                    <h5>Reported</h5></li>
                    <li class="list-group-item text-right text-white">
                        <a href="{{ asset('reports/tasks/'.$task['task_report']) }}" target="_blank" class="btn btn-dark">See Report</a>&nbsp;<button class="btn btn-dark" onclick="modalAction()"">Action</button>&nbsp;
                    </li>
                @elseif($task['task_status'] == 3)
                    <h5>Rejected</h5></li>
                    <li class="list-group-item text-right text-white">
                        <a href="{{ asset('reports/tasks/'.$task['task_report']) }}" target="_blank" class="btn btn-dark">See Report</a>&nbsp;<button class="btn btn-dark" disabled>Action</button>&nbsp;
                    </li>
                @endif
            </ul>
        </div>
    </div>
    {{-- Task Action modal --}}
    <div class="modal fade" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalActionLabel">Do you want to approve this task?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('manager.task.update.status',  $task['task_id'] )}}" id="taskAction">
                        {{csrf_field()}}
                        @method('PATCH')
                        <input id="task_status" type="hidden" name="task_status" value="">
                    </form>
                    <button type="button" class="btn btn-dark" onclick="taskAction(1)">Approve</button>
                    <button type="button" class="btn btn-dark" onclick="taskAction(3)">Disapprove</button>
                  </div>
              </div>
        </div>
    </div>
@endsection
@section('script')
    @include('inc.script')
    @include('edittaskpopup')
    <script>
        function modalAction() {
            $("#modalAction").modal();
        }
        function taskAction(value) {
          document.getElementById('task_status').value = value;
          document.getElementById('taskAction').submit()
        }
    </script>
@endsection
