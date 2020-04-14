<div class="modal fade" id="addWorkReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addWorkReportLabel">Add Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="editForm" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="work_report" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Choose report file</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark">Submit Report</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function addWorkReport(work) {
        document.querySelector('#editForm').action = `{{ action('WorkController@index') }}/${work}/report`;
        $("#addWorkReport").modal()
    }
</script>
