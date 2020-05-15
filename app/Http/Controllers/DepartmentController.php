<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Work;
use App\Department;

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
}
