<!--    Add Task Modal    -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('manager.tasks.store') }}" id="addForm">
                    {{csrf_field()}}
                    <input id="workId" type="hidden" value="{{ $work['work_id'] }}" name="work_id">
                    <div class="form-group">
                        <label for="addtaskname">Task Name</label>
                        <input type="text" name="task_name" id="addtaskname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="addtaskdescription">Task Description</label>
                        <input type="text" name="task_description" id="addtaskdescription" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="addtaskdeadline">Deadline</label>
                        <input type="date" name="task_deadline" id="addtaskdeadline" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role">Assign To</label>
                        <select name="user_id" id="addrole" class="custom-select">
                            @foreach($users as $user)
                            <option id="user{{$user['user_id']}}" value="{{$user['user_id']}}">{{$user['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        function addTask(work_id) {
            document.getElementById('workId').value = work_id;
            $("#addTaskModal").modal()
        }
    </script>
