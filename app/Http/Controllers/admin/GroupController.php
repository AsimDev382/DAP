<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Company;
use App\Models\Department;
use App\Models\Group;
use App\Models\SubDepartment;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class GroupController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view groups', only: ['groupIndex']),
            new Middleware('permission:create groups', only: ['groupCreate']),
            new Middleware('permission:edit groups', only: ['groupEdit']),
            new Middleware('permission:delete groups', only: ['groupDestroy']),
        ];
    }

    public function groupIndex(){
        $groups = Group::with('department', 'subDepartment', 'company', 'user')->orderBy('id', 'desc')->get();
        // dd($tasks);
        return view('admin.group.index', compact('groups'));
    }


    public function groupCreate()
    {
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        $users = User::all();
        return view('admin.group.create', compact('sub_departments', 'departments', 'companies', 'users'));
    }


    public function groupStore(GroupRequest $request)
    {
        $group = new Group();
        $group->group_name = $request->group_name;
        $group->user_id = $request->user_id;
        $group->department_id = $request->department_id;
        $group->sub_department_id = $request->sub_department_id;
        $group->company_id = $request->company_id;
        $group->save();

        return to_route('group.index')->with('success', 'Group Added Successfully');
    }


    public function groupEdit($id)
    {
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        $users = User::all();

        $group = Group::with('department', 'subDepartment', 'company', 'user')->where('id', $id)->first();
        // dd($task);

        return view('admin.group.edit', compact('group', 'companies', 'departments', 'sub_departments', 'users'));
    }


    public function groupView($id)
    {
        $group = Group::with('department', 'subDepartment', 'company', 'user')->where('id', $id)->first();

        return view('admin.group.view', compact('group'));
    }


    public function groupUpdate(GroupRequest $request, $id)
    {
        $group = Group::find($id);
        $group->group_name = $request->group_name;
        $group->user_id = $request->user_id;
        $group->department_id = $request->department_id;
        $group->sub_department_id = $request->sub_department_id;
        $group->company_id = $request->company_id;
        $group->update();

        return to_route('group.index')->with('success', 'Group Updated Successfully');
    }



    public function groupDestroy($id)
    {
        $task = Group::find($id);
        $task->delete();
        return to_route('group.index')->with('success', 'Group Deleted Successfully');
    }



    public function sortgroup(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $groups = Group::with('subDepartment', 'department', 'company', 'user')->orderBy('id', $sortFilter)->get();

        return response()->json($groups);
    }


    public function updateStatus(Request $request, $id)
    {
        $group = Group::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $group->status = $newStatus;
        $group->save();

        return response()->json(['status' => $newStatus]);
    }
}
