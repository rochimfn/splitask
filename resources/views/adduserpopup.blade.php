<!--    Add User Modal    -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{action('UserController@store')}}" id="addForm">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="addname">Name</label>
                        <input type="text" name="name" id="addname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="addusername">Username</label>
                        <input type="text" name="user_name" id="addusername" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="addemail">Email</label>
                        <input type="email" name="email" id="addemail" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="addpassword">Password</label>
                        <input type="password" name="password" id="addpassword" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="position" id="addrole" class="custom-select">
                            <option id="administrator" value="administrator">Administrator</option>
                            <option id="chief" value="chief">Chief</option>
                            <option id="manager" value="manager">Manager</option>
                            <option id="staff" value="staff">Staff</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select name="department_id" id="adddepartment" class="custom-select">
                            @foreach($departments as $department)
                                <option id="department{{$department['department_id']}}" value="{{$department['department_id']}}">{{$department['department_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark">Add</button>
                </form>
        </div>
    </div>
</div>
<script>
    function addUser() {
        $("#addUserModal").modal()
    }
</script>
