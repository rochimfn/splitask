<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::join('departments', 'users.department_id', '=', 'departments.department_id')->orderBy('name')->paginate(10);
        $departments = Department::select('department_id','department_name')->get();
        return view('userlistpage')->with('users', $users)->with('departments',$departments);
    }

    public function store(Request $request)
    {
        $user = $this->validate(
            request(),[
                'name' => 'required',
                'user_name' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required' ,
                'position' => 'required' ,
                'department_id' => 'required|numeric'
            ]
        );
        $user['password'] = Hash::make($request->input('password'));
        User::create($user);
        return redirect()->back()->with('success','User has been added');
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            request(),[
                'name' => 'required',
                'user_name' => 'required',
                'email' => 'required',
                'position' => 'required' ,
                'department_id' => 'required|numeric'
            ]
        );
        $input = $request->except(['_token', '_method', 'password']) ;
        if($request->filled('password')) {
            $input['password'] = Hash::make($request->input('password'));
        }
        $user = User::where('user_id', $id)->first();
        $user->fill($input);
        $user->save();
        return redirect()->back()->with('success', 'User has been updated');
    }

    public function destroy($id)
    {
        if(Auth::user()->user_id == $id) {
            return redirect('users')->withErrors('Can\'t delete');
        }
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success','User has been deleted');
    }
}
