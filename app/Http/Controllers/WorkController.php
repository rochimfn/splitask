<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Work;
use App\Task;
use App\Department;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $works = Work::all();
        $tasks = Task::all();
        $department_id = Auth::user()->department_id;
        $users = User::where('department_id', $department_id)->get();
        return view('workpage')->with('users', $users)->with('works', $works)->with('tasks', $tasks);
    }
    public function indexPerDepartment()
    {
        $department = Department::join('users', 'departments.department_id', '=', 'users.department_id')->where('users.position', 'manager')->get();
        $works = Work::all();
        return view('departmentpage')->with('departments', $department)->with('works', $works);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $work = $this->validate(
          request(),[
              'work_name' => 'required',
              'work_description' => 'required',
              'work_deadline' => 'required',
              'user_id' => 'required|numeric',
              'department_id' => 'required|numeric'
          ]
      );
      $work['work_status'] = 0;
      Work::create($work);
      return redirect()->back()->with('success', 'Work has been created');
    }

    public function storeReport(Request $request, $id)
    {
        if($request->hasFile('work_report')) {
            $fileNameToStore = time().'_'.$request->file('work_report')->getClientOriginalName();
            $path = $request->file('work_report')->storeAs('public/work_report', $fileNameToStore);
        }
//        status list
//        0 = On Progress
//        1 = Approved
//        2 = Reported
//        3 = Rejected

        $work = Work::find($id);
        $work->work_report = $fileNameToStore;
        $work->work_status = 2;
        $work->save();

        return redirect()->back()->with('success', 'Report Submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $work = Work::join('users', 'works.user_id', '=', 'users.user_id')->where('work_id', $id)->first();
      return view('workdetailspage')->with('work', $work);
    }

    /**
    * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
