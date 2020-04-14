<!--    Add Task Modal    -->
<div class="modal fade" id="editWorkModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editWorkModalLabel">Edit Work</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('chief.works.update', $work['work_id']) }}" id="editForm">
                    @csrf
                    @method('PATCH')
                    <input id="departmentId" type="hidden" value="{{ $work['department_id']}}" name="department_id">
                    <input id="userId" type="hidden" value="{{ $work['user_id'] }}" name="user_id">
                    <div class="form-group">
                        <label for="editworkname">Work Name</label>
                        <input type="text" name="work_name" id="editworkname" value="{{ $work['work_name']}}"class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editworkdescription">Work Description</label>
                        <input type="text" name="work_description" id="editworkdescription" value="{{ $work['work_description']}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editworkdeadline">Deadline</label>
                        <input type="date" name="work_deadline" id="editworkdeadline" value="{{ $work['work_deadline']}}" class="form-control">
                    </div
                    </div>
                    <button type="submit" class="btn btn-dark">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <script>
        function editWork() {
            $("#editWorkModal").modal()
        }
    </script>
