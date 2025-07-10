<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubDepartmentRequest;
use App\Models\SubDepartment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SubDepartmentController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            // new Middleware('permission:sub department', only: ['index']),
            // new Middleware('permission:sub department', only: ['create']),
            // new Middleware('permission:sub department', only: ['destroy']),
            // new Middleware('permission:sub department', only: ['edit']),

            new Middleware('permission:view sub department', only: ['index']),
            new Middleware('permission:create sub department', only: ['create']),
            new Middleware('permission:edit sub department', only: ['edit']),
            new Middleware('permission:delete sub department', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = SubDepartment::orderBy('id', 'desc')->get();
        return view('admin.subDepartment.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subDepartment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubDepartmentRequest $request)
    {
        $department = new SubDepartment();
        $department->sub_name = $request->sub_name;
        $department->sub_location = $request->sub_location;
        $department->save();
        return to_route('sub-department.index')->with('success', 'Sub Department Added Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($department);
        $department = SubDepartment::find($id);
        return view('admin.subDepartment.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubDepartmentRequest $request, string $id)
    {
        $department = SubDepartment::find($id);
        $department->sub_name = $request->sub_name;
        $department->sub_location = $request->sub_location;
        $department->update();
        return to_route('sub-department.index')->with('success', 'Sub Department Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function show(string $id)
    {
        $department = SubDepartment::find($id);
        $department->delete();
        return to_route('sub-department.index')->with('success', 'Sub Department Deleted successfully');
    }



    public function sortSubDepartment(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $subdepartment = SubDepartment::orderBy('id', $sortFilter)->get();

        return response()->json($subdepartment);
    }
}
