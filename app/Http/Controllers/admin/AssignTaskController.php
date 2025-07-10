<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignTaskRequest;
use App\Models\AssignTask;
use App\Models\CaseManagement;
use App\Models\Department;
use App\Models\Group;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class AssignTaskController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view assign task', only: ['assignTasksIndex']),
            new Middleware('permission:create assign task', only: ['assignTasksCreate']),
            new Middleware('permission:edit assign task', only: ['assignTasksEdit']),
            new Middleware('permission:delete assign task', only: ['assignTasksDestroy']),
        ];
    }

    public function assignTasksIndex()
    {
        $tasks = AssignTask::with('task', 'department', 'group')->orderBy('id', 'desc')->get();
        foreach ($tasks as $task) {
            $taskIds = explode(',', $task->task_id);
            $task->task_names = Task::whereIn('id', $taskIds)->pluck('task_name')->toArray();

            $userIds = explode(',', $task->user_id);
            $task->user_names = User::whereIn('id', $userIds)->pluck('name')->toArray();
        }
        // dd($tasks);
        return view('admin.assign_tasks.index', compact('tasks'));
    }


    public function assignTasksCreate()
    {
        $tasks = Task::all();
        $users = User::all();
        $groups = Group::all();
        $departments = Department::all();
        $cases = CaseManagement::all();
        return view('admin.assign_tasks.create', compact('tasks', 'departments', 'users', 'groups', 'cases'));
    }


    public function assignTasksStore(Request $request)
    {
        $request->validate([
            'case_management_id' => 'required',
            'task_id' => 'required',
            'task_id' => 'required',
            'user_id' => 'required',
            'department_id' => 'required',
            'group_id' => 'required',
            'group_id' => 'required',
            'location' => 'required',
        ]);
        // dd($request->all());
        $task = new AssignTask();

        $task->user_id = is_array($request->user_id) ? implode(',', $request->user_id) : $request->user_id;
        $task->task_id = is_array($request->task_id) ? implode(',', $request->task_id) : $request->task_id;
        $task->group_id = is_array($request->group_id) ? implode(',', $request->group_id) : $request->group_id;

        $task->auto_id = $request->auto_id;
        $task->case_management_id = $request->case_management_id;
        $task->department_id = $request->department_id;
        $task->assign_date = $request->assign_date;
        $task->expiry_date = $request->expiry_date;
        $task->location = $request->location;
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_task_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('AssignTask', $filename, 'public');
            $task->document = $path;
        }
        $task->save();

        // $userIds = (array) $request->user_id;
        // $taskIds = (array) $request->task_id;
        // $groupIds = (array) $request->group_id;

        // foreach ($userIds as $userId) {
        //     foreach ($taskIds as $taskId) {
        //         foreach ($groupIds as $groupId) {

        //             $task = new AssignTask();
        //             $task->user_id = $userId;
        //             $task->task_id = $taskId;
        //             $task->group_id = $groupId;
        //             $task->case_management_id = $request->case_management_id;
        //             $task->department_id = $request->department_id;
        //             $task->auto_id = $request->auto_id;
        //             $task->assign_date = $request->assign_date;
        //             $task->expiry_date = $request->expiry_date;
        //             $task->location = $request->location;

        //             // Handle file only once (optional)
        //             if ($request->hasFile('document') && !isset($documentPath)) {
        //                 $file = $request->file('document');
        //                 $filename = date('dmy') . '_task_' . '.' . $file->getClientOriginalExtension();
        //                 $documentPath = $file->storeAs('AssignTask', $filename, 'public');
        //             }

        //             if (isset($documentPath)) {
        //                 $task->document = $documentPath;
        //             }

        //             $task->save();
        //         }
        //     }
        // }


        return to_route('assign.tasks.index')->with('success', 'Assign Task Added Successfully');
    }


    public function assignTasksEdit($id)
    {
        $tasks = Task::all();
        $users = User::all();
        $groups = Group::all();
        $departments = Department::all();
        $cases = CaseManagement::all();
        $assignTask = AssignTask::with('task', 'department', 'group', 'case')->where('id', $id)->first();
        // dd($task);

        return view('admin.assign_tasks.edit', compact('assignTask', 'tasks', 'departments', 'groups', 'users', 'cases'));
    }


    public function assignTasksView($id)
    {
        $tasks = Task::all();
        $users = User::all();
        $groups = Group::all();
        $departments = Department::all();
        $assignTask = AssignTask::with('task', 'department', 'group')->where('id', $id)->first();
        // dd($task);

        return view('admin.assign_tasks.view', compact('assignTask', 'tasks', 'departments', 'groups', 'users'));
    }


    public function assignTasksUpdate(AssignTaskRequest $request, $id)
    {
        // dd($request->all());
        $task = AssignTask::find($id);

        $task->user_id = is_array($request->user_id) ? implode(',', $request->user_id) : $request->user_id;
        $task->task_id = is_array($request->task_id) ? implode(',', $request->task_id) : $request->task_id;
        $task->group_id = is_array($request->group_id) ? implode(',', $request->group_id) : $request->group_id;

        // $task->task_id = $request->task_id;
        // $task->group_id = $request->group_id;

        $task->department_id = $request->department_id;
        $task->assign_date = $request->assign_date;
        $task->expiry_date = $request->expiry_date;
        $task->location = $request->location;


        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_task_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('AssignTask', $filename, 'public');
            $task->document = $path;
        }
        $task->update();

        return to_route('assign.tasks.index')->with('success', 'Assign Task Updated Successfully');
    }



    public function assignTasksDestroy($id)
    {
        $task = AssignTask::find($id);
        $task->delete();
        return to_route('assign.tasks.index')->with('success', 'Assign Task Deleted Successfully');
    }



    public function sortassignTasks(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $tasks = AssignTask::with('task', 'department', 'group')->orderBy('id', $sortFilter)->get();
        foreach ($tasks as $task) {
            $taskIds = explode(',', $task->task_id);
            $task->task_names = Task::whereIn('id', $taskIds)->pluck('task_name')->toArray();

            $userIds = explode(',', $task->user_id);
            $task->user_names = User::whereIn('id', $userIds)->pluck('name')->toArray();
        }

        return response()->json($tasks);
    }


    public function updateStatus(Request $request, $id)
    {
        $company = AssignTask::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $company->status = $newStatus;
        $company->save();

        return response()->json(['status' => $newStatus]);
    }
}
