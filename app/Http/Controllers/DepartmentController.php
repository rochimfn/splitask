<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Work;
use App\Department;
use App\User;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $department = Department::join('users', 'departments.department_id', '=', 'users.department_id')->where('users.position', 'manager')->get();
        $works = Work::all();
        return view('departmentpage')->with('departments', $department)->with('works', $works);
    }
    public function store(Request $request)
    {
        $department = $this->validate(
            request(), [
                'department_name' => 'required|unique:departments'
            ]
        );
        Department::create($department);
        return redirect()->route('administrator.index')->with('success', 'Department successfully added');
    }
    public function destroy($id)
    {
        $department = Department::find($id);
        $user = User::where('department_id', $id)->first();
        if($department->department_name == 'Chief') {
            return redirect()->route('administrator.index')->withErrors('Can\'t delete Chief department');
        }
        if( !is_null($user) ) {
            return redirect()->route('administrator.index')->withErrors('Department have user assigned');
        }
        if(Auth::user()->position == 'administrator') {
            $department->delete();
            return redirect()->route('administrator.index')->with('success', 'Department has been deleted');
        } else {
            return redirect()->route('administrator.index')->withErrors('Can\'t delete Department, make sure you\'re Administrator');
        }
    }
}
