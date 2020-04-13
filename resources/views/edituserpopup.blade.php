<!--    Edit User Modal    -->
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="editForm">
                    {{csrf_field()}}
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="user_name" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="position" id="role" class="custom-select">
                            <option id="administrator" value="administrator">Administrator</option>
                            <option id="chief" value="chief">Chief</option>
                            <option id="manager" value="manager">Manager</option>
                            <option id="staff" value="staff">Staff</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select name="department_id" id="department" class="custom-select">
                            @foreach($departments as $department)
                            <option id="department{{$department['department_id']}}" value="{{$department['department_id']}}">{{$department['department_name']}}</option>
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
    function editUser(user) {
        const userData = document.querySelector(`#${user}`);
        document.querySelector('#name').value = userData.dataset.name;
        document.querySelector('#username').value = userData.dataset.username;
        document.querySelector('#email').value = userData.dataset.email;
        document.querySelector('#editForm').action = `{{action('UserController@index')}}/${user.substring(4)}`;
        document.querySelector(`#department${userData.dataset.department}`).selected=true;
        document.querySelector(`#${userData.dataset.role}`).selected=true;
        $("#editUserModal").modal()
    }
</script>
