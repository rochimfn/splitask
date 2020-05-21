@extends('layouts.default')

@section('title', 'Users List Page')

@section('content')
            <div class="d-flex justify-content-between mt-4">
                <span>
                    <h2>User List</h2>
                </span>
                <div class="form-group">
                <button class="btn btn-dark" onclick="manageDepartmentsModal()">Manage Departments</button>
                <button class="btn btn-dark" onclick="addUser()">+ Add User</button>
                </div>
            </div>
            <div class="mt-2">
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
                <table class="table table-responsive-sm mt-2">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Department</th>
                        <th scope="col">Position</th>
                        <th scope="col" colspan="2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr id="user{{$user['user_id']}}" data-name="{{$user['name']}}" data-username="{{$user['user_name']}}" data-email="{{$user['email']}}" data-role="{{$user['position']}}" data-department="{{$user['department_id']}}">
                        <th scope="row">{{$user['name']}}</th>
                        <td>{{$user['department_name']}}</td>
                        <td>{{ucfirst($user['position'])}}</td>
                        <td><button href="" class="btn btn-dark" onclick="editUser('user{{$user['user_id']}}')">Edit</button></td>
                        <td>
                            <form action="{{ route('administrator.destroy', $user['user_id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger d-inline" type="submit" onclick="return confirm('Are you sure want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
            
@endsection
@section('script')
    @include('inc.script')
    @include('managedepartmentspopup')
    @include('edituserpopup')
    @include('adduserpopup')
@endsection
