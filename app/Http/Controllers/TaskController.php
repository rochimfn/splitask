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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return redirect('works')->with('success', 'Task has been created');
    }
    public function storeReport(Request $request, $id)
    {
        if($request->hasFile('task_report')) {
            $fileNameToStore = time().'_'.$request->file('work_report')->getClientOriginalName();
            $path = $request->file('task_report')->storeAs('public/task_report', $fileNameToStore);
        }
//        status list
//        0 = On Progress
//        1 = Approved
//        2 = Reported
//        3 = Rejected

        $task = Task::find($id);
        $task->task_report = $fileNameToStore;
        $task->status = 2;
        $task->save();

        return redirect()->back()->with('success', 'Report Submitted');
    }
    public function disapproveTask($id)
    {
        $task = Task::find($id);
        $task->status = 3;
        $task->save();

        return redirect()->back()->with('success', 'Report Rejected');
    }
    public function approveTask($id)
    {
        $task = Task::find($id);
        $task->status = 1;
        $task->save();

        return redirect()->back()->with('success', 'Report Rejected');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::join('users','tasks.user_id','=','users.user_id')->where('tasks.task_id',$id)->first();
        $work = Work::where('work_id', $task->work_id)->first();
        $users = User::where('department_id',$work->department_id)->get();
        return view('taskdetailspage')->with('task', $task)->with('users', $users);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if(Auth::user()->position == 'manager') {
            $task->delete();
            return redirect('works')->with('success', 'Task has been deleted');
        } else {
            return redirect('works')->withErrors('Can\'t delete Task, make sure you\'re Manager');
        }
    }
}
