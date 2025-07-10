<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\Company;
use App\Models\SubDepartment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DepartmentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            // new Middleware('permission:department', only: ['index']),
            // new Middleware('permission:department', only: ['create']),
            // new Middleware('permission:department', only: ['destroy']),
            // new Middleware('permission:department', only: ['edit']),

            new Middleware('permission:view department', only: ['index']),
            new Middleware('permission:create department', only: ['create']),
            new Middleware('permission:edit department', only: ['edit']),
            new Middleware('permission:delete department', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with('company')->orderBy('id', 'desc')->get();
        return view('admin.department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::all();
        $sub_department = SubDepartment::all();
        return view('admin.department.create', compact('companies', 'sub_department'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $department = new Department();
        $department->name = $request->name;
        $department->head_name = $request->head_name;
        $department->location = $request->location;
        $department->company_id = $request->company_id;
        $department->sub_department_id = $request->sub_department_id;

        $department->save();
        if($request->action == 'SubDepartment'){
            return to_route('sub-department.create')->with('success', 'Department Added Successfully');
        }
        return to_route('department.index')->with('success', 'Department Added Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $companies = Company::all();
        $sub_departments = SubDepartment::all();
        $department = Department::find($id);

        return view('admin.department.edit', compact('companies', 'department', 'sub_departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $department = Department::find($id);
        $department->name = $request->name;
        $department->head_name = $request->head_name;
        $department->location = $request->location;
        $department->company_id = $request->company_id;
        $department->sub_department_id = $request->sub_department_id;
        $department->update();

        if($request->action == 'SubDepartment'){
            return to_route('sub-department.create')->with('success', 'Department Added Successfully');
        }

        return to_route('department.index')->with('success', 'Department Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function show($id)
    {
        $department = Department::find($id);
        $department->delete();
        return to_route('department.index')->with('success', 'Department Deleted successfully');
    }

    public function updateDepartmentStatus(Request $request, $id)
    {
        $company = Department::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $company->status = $newStatus;
        $company->save();

        return response()->json(['status' => $newStatus]);
    }


    public function sortDepartment(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $department = Department::with('company')->orderBy('id', $sortFilter)->get();

        return response()->json($department);
    }
}
