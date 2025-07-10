<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Department;
use App\Models\SubDepartment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view task', only: ['taskIndex']),
            new Middleware('permission:create task', only: ['taskCreate']),
            new Middleware('permission:edit task', only: ['taskEdit']),
            new Middleware('permission:delete task', only: ['taskDestroy']),
        ];
    }

    public function tasksIndex(){
        $tasks = Task::with('department', 'subDepartment')->orderBy('id', 'desc')->get();
        // dd($tasks);
        return view('admin.tasks.index', compact('tasks'));
    }


    public function tasksCreate()
    {
        $departments = Department::all();
        $subdepartments = SubDepartment::all();
        return view('admin.tasks.create', compact('departments', 'subdepartments'));
    }


    public function tasksStore(TaskRequest $request)
    {
        $task = new Task();
        $task->auto_id = $request->auto_id;
        $task->task_name = $request->task_name;
        $task->department_id = $request->department_id;
        $task->sub_department_id = $request->sub_department_id;
        $task->start_date = $request->start_date;
        $task->expiry_date = $request->expiry_date;
        $task->status = $request->status;
        $task->task_location = $request->task_location;
        $task->task_description = $request->task_description;


        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_task_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Task', $filename, 'public');
            $task->document = $path;
        }
        $task->save();

        return to_route('tasks.index')->with('success', 'Task Added Successfully');
    }


    public function tasksEdit($id)
    {
        $task = Task::find($id);
        // dd($task);
        $departments = Department::all();
        $subdepartments = SubDepartment::all();
        return view('admin.tasks.edit', compact('departments', 'subdepartments', 'task'));
    }


    public function tasksView($id)
    {
        $task = Task::with('department', 'subDepartment')->where('id', $id)->first();
        $departments = Department::all();
        $subdepartments = SubDepartment::all();
        return view('admin.tasks.view', compact('departments', 'subdepartments', 'task'));
    }


    public function tasksUpdate(TaskRequest $request, $id)
    {
        // dd($request->all());
        $task = Task::find($id);

        $task->auto_id = $request->auto_id;
        $task->task_name = $request->task_name;
        $task->department_id = $request->department_id;
        $task->sub_department_id = $request->sub_department_id;
        $task->start_date = $request->start_date;
        $task->expiry_date = $request->expiry_date;
        $task->status = $request->status;
        $task->task_location = $request->task_location;
        $task->task_description = $request->task_description;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_task_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Task', $filename, 'public');
            $task->document = $path;
        }
        $task->update();

        return to_route('tasks.index')->with('success', 'Task Updated Successfully');
    }



    public function tasksDestroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return to_route('tasks.index')->with('success', 'Task Deleted Successfully');
    }



    public function sortTask(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $tasks = Task::with('department', 'subDepartment')->orderBy('id', $sortFilter)->get();

        return response()->json($tasks);
    }
}
