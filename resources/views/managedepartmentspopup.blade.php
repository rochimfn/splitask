<div class="modal fade" id="manageDepartmentsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manageDepartmentsModalLabel">Departments List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ $department['department_name'] }}</td>
                                <td>
                                    <form action="{{ route('administrator.departments.destroy', $department['department_id']) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger d-inline" type="submit" onclick="return confirm('Are you sure want to delete this department?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <form method="post" action="{{ route('administrator.departments.store') }}">
                            <td>
                                <input type="text" name="department_name" id="newDepartment" class="form-control" placeholder="New Deparment Name">
                            </td>
                            <td>
                                @csrf
                                <button type="submit" class="btn btn-dark">Add</button>
                            </td>
                            </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function manageDepartmentsModal() {
        $("#manageDepartmentsModal").modal()
    }
</script>
