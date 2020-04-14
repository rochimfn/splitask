@extends('layouts.default')

@section('title', 'Work Details Page')

@section('content')
    <div class="d-flex justify-content-between mt-4">
        <h2>{{ $work['work_name'] }} Details</h2>
        <div class="d-flex">
            <form action="{{ route('chief.works.destroy', $work['work_id'])}}" method="post">
                <button class="btn btn-dark" type="button" onclick="editTask()">Edit Work</button>
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
                <li class="list-group-item"><h4>Description</h4> <h5>{{$work['work_description']}}</h5></li>
                <li class="list-group-item"><h4>Deadline</h4> <h5>{{$work['work_deadline']}}</h5></li>
                <li class="list-group-item"><h4>Asigned to</h4> <h5>{{$work['name']}}</h5></li>
                <li class="list-group-item"><h4>Status</h4>
                @if($work['work_status'] == 0)
                    <h5>On Progress</h5></li>
                    <li class="list-group-item text-right text-white">
                        <button class="btn btn-dark" disabled>See Report</button>&nbsp;<button class="btn btn-dark" disabled>Action</button>&nbsp;
                    </li>
                @elseif($work['work_status'] == 1)
                    <h5>Approved</h5></li>
                    <li class="list-group-item text-right text-white">
                        <a class="btn btn-dark">See Report</a>&nbsp;<button class="btn btn-dark" disabled>Action</button>&nbsp;
                    </li>
                @elseif($work['work_status'] == 2)
                    <h5>Reported</h5></li>
                    <li class="list-group-item text-right text-white">
                        <a class="btn btn-dark">See Report</a>&nbsp;<button class="btn btn-dark" onclick="modalAction()"">Action</button>&nbsp;
                    </li>
                @elseif($work['work_status'] == 3)
                    <h5>Rejected</h5></li>
                    <li class="list-group-item text-right text-white">
                        <a class="btn btn-dark">See Report</a>&nbsp;<button class="btn btn-dark" disabled>Action</button>&nbsp;
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
                    <form method="post" action="{{route('manager.task.update.status',  $work['work_id'] )}}" id="taskAction">
                        {{csrf_field()}}
                        @method('PATCH')
                        <input id="work_status" type="hidden" name="work_status" value="">
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
    <script>
        function modalAction() {
            $("#modalAction").modal();
        }
        function taskAction(value) {
          document.getElementById('work_status').value = value;
          document.getElementById('taskAction').submit()
        }
    </script>
@endsection