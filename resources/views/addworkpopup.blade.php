<!--    Add Task Modal    -->
<div class="modal fade" id="addWorkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWorkModalLabel">Add Work</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('chief.departments.store') }}" id="addForm">
                    {{csrf_field()}}
                    <input id="departmentId" type="hidden" value="" name="department_id">
                    <input id="userId" type="hidden" value="" name="user_id">
                    <div class="form-group">
                        <label for="addworkname">Work Name</label>
                        <input type="text" name="work_name" id="addworkname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="addworkdescription">Work Description</label>
                        <input type="text" name="work_description" id="addworkdescription" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="addworkdeadline">Deadline</label>
                        <input type="date" name="work_deadline" id="addworkdeadline" class="form-control">
                    </div
                    </div>
                    <button type="submit" class="btn btn-dark">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        function addWork(department_id, user_id) {
            document.getElementById('userId').value = `${user_id}`;
            document.getElementById('departmentId').value = `${department_id}`;
            $("#addWorkModal").modal()
        }
    </script>
