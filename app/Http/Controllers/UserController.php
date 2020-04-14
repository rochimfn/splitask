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

    public function edit()
    {
        $user = Auth::user();
        return view('accountsettingspage')->with('user', $user);
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

    public function updateProfile(Request $request)
    {
        $this->validate(
            request(),[
                'user_name' => 'required',
                'email' => 'required',
                'profile_picture' => 'mimes:jpg,jpeg,png'           ]
        );

        $input = $request->except(['_token', '_method', 'password', 'profile_picture']) ;

        if($request->filled('password')) {
            $input['password'] = Hash::make($request->input('password'));
        }

        if($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');

            $path = public_path('images/profile_picture');

            $filename = md5(Auth::user()->name)."_".date("Y_m_d_H_i_s");
            $filename = '.'. $file->getClientOriginalExtension();

            $file->move($path, $filename);

            $input['profile_picture'] = $filename;
        }

        $id = Auth::user()->user_id;
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
