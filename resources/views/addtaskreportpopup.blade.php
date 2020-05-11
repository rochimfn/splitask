<div class="modal fade" id="addTaskReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskReportLabel">Add Task Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ action('TaskController@index') }}/{{ $task['task_id'] }}/report" id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="task_report" id="customFile" onchange="displayReportName(this)" required>
                            <label class="custom-file-label" for="customFile">Choose report file</label>
                        </div>
                    </div>
                    <p><em>*upload dalam format docx atau pdf</em></p>
                    <button type="submit" class="btn btn-dark">Submit Report</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function addTaskReport(task) {
        document.querySelector('#editForm').action = `{{ action('TaskController@index') }}/${task}/report`;
        $("#addTaskReport").modal()
    }
    function displayReportName(input) {
        if (input.files && input.files[0]) {
            document.querySelector('label[for="customFile"]').textContent = input.files[0].name;
        }
    }
</script>
