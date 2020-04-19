<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Task::join('works', 'tasks.work_id', '=', 'works.work_id')->where('tasks.user_id', Auth::user()->user_id)->orderBy('tasks.work_id')->get();
        return view('taskspage')->with('tasks', $tasks);
    }

    public function store(Request $request)
    {
        $task = $this->validate(
            request(),[
                'task_name' => 'required',
                'task_description' => 'required',
                'task_deadline' => 'required',
                'user_id' => 'required|numeric',
                'work_id' => 'required|numeric'
            ]
        );
        $task['task_status'] = 0;
        Task::create($task);
        return redirect()->back()->with('success', 'Task has been created');
    }
    public function storeReport(Request $request, $id)
    {
        $this->validate($request, [
            'task_report' => 'required|mimes:pdf,doc,docx'
        ]);

        $task = Task::find($id);
        $filename = $task['task_name']."_".date("Y_m_d_H_i_s");
        if($request->hasFile('task_report')) {
            $path = public_path('reports/tasks');
            $file = $request->file('task_report');
            $filename = $filename.'.'. $file->getClientOriginalExtension();
            $file->move($path, $filename);
        }
//        status list
//        0 = On Progress
//        1 = Approved
//        2 = Reported
//        3 = Rejected

        $task->task_report = $filename;
        $task->task_status = 2;
        $task->save();

        return redirect()->back()->with('success', 'Report Submitted');
    }

    public function updateStatusTask(Request $request, $id)
    {
        $task = Task::find($id);
        $task->task_status = $request->input('task_status');
        $task->save();
        if($request->input('task_status') == 3) {
          return redirect()->back()->withErrors('Report Rejected');
        } elseif ($request->input('task_status') == 1) {
          return redirect()->back()->with('success', 'Report Approved');
        }
    }

    public function show($id)
    {
        $task = Task::join('users','tasks.user_id','=','users.user_id')->where('tasks.task_id',$id)->first();
        $work = Work::where('work_id', $task->work_id)->first();
        $users = User::where('department_id',$work->department_id)->get();
        return view('taskdetailspage')->with('task', $task)->with('users', $users);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            request(),[
                'task_name' => 'required',
                'task_description' => 'required',
                'task_deadline' => 'required',
                'user_id' => 'required|numeric',
                'work_id' => 'required|numeric'
            ]
        );
        $input = $request->except(['_token', '_method']);
        $task = Task::where('task_id', $id)->first();
        $task->fill($input);
        $task->save();
        return redirect()->back()->with('success', 'Task has been updated');
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if(Auth::user()->position == 'manager') {
            $task->delete();
            return redirect('manager')->with('success', 'Task has been deleted');
        } else {
            return redirect()->back()->withErrors('Can\'t delete Task, make sure you\'re Manager');
        }
    }
}
