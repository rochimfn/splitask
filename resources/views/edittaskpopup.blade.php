<div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{action('TaskController@update', $task['task_id'])}}" id="editForm">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="work_id" value="{{ $task['work_id'] }}">
                    <div class="form-group">
                        <label for="edittaskname">Task Name</label>
                        <input type="text" name="task_name" id="edittaskname" class="form-control" value="{{ $task['task_name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="edittaskdescription">Task Description</label>
                        <input type="text" name="task_description" id="edittaskdescription" class="form-control" value="{{ $task['task_description'] }}">
                    </div>
                    <div class="form-group">
                        <label for="edittaskdeadline">Deadline</label>
                        <input type="date" name="task_deadline" id="edittaskdeadline" class="form-control" value="{{ $task['task_deadline'] }}">
                    </div>
                    <div class="form-group">
                        <label for="role">Assign To</label>
                        <select name="user_id" id="editrole" class="custom-select">
                            @foreach($users as $user)
                                @if($user['user_id'] == $task['user_id'])
                                    <option id="user{{$user['user_id']}}" value="{{$user['user_id']}}" selected>{{$user['name']}}</option>
                                @else
                                    <option id="user{{$user['user_id']}}" value="{{$user['user_id']}}">{{$user['name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function editTask() {
        $("#editTaskModal").modal()
    }
</script>
