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
        $this->validate($request, [
            'work_report' => 'required|mimes:pdf,doc,docx'
        ]);
        $work = Work::find($id);
        $filename = $work['work_name']."_".date("Y_m_d_H_i_s");
        if($request->hasFile('work_report')) {
            $path = public_path('reports/works');
            $file = $request->file('work_report');
            $filename = $filename.'.'.$file->getClientOriginalExtension();
            $file->move($path, $filename);
        }
//        status list
//        0 = On Progress
//        1 = Approved
//        2 = Reported
//        3 = Rejected

        $work->work_report = $filename;
        $work->work_status = 2;
        $work->save();

        return redirect()->back()->with('success', 'Report Submitted');
    }

    public function show($id)
    {
      $work = Work::join('users', 'works.user_id', '=', 'users.user_id')->where('work_id', $id)->first();
      return view('workdetailspage')->with('work', $work);
    }

    public function update(Request $request, $id)
    {
      $this->validate(
          request(),[
              'work_name' => 'required',
              'work_description' => 'required',
              'work_deadline' => 'required',
              'user_id' => 'required|numeric',
              'department_id' => 'required|numeric'
          ]
      );
      $input = $request->except(['_token', '_method']);
      $work = Work::where('work_id', $id)->first();
      $work->fill($input);
      $work->save();
      return redirect()->back()->with('success', 'Work has been updated');
    }

    public function updateStatusWork(Request $request, $id)
    {
        $work = Work::find($id);
        $work->work_status = $request->input('work_status');
        $work->save();
        if($request->input('work_status') == 3) {
          return redirect()->back()->withErrors('Report Rejected');
        } elseif ($request->input('work_status') == 1) {
          return redirect()->back()->with('success', 'Report Approved');
        }
    }

    public function destroy($id)
    {
      $work = Work::find($id);
      if(Auth::user()->position == 'chief') {
          $work->delete();
          return redirect('chief')->with('success', 'Work has been deleted');
      } else {
          return redirect()->back()->withErrors('Can\'t delete Work, make sure you\'re Chief');
      }
    }
}
