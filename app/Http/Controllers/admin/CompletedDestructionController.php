<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompletedDestructionRequest;
use Illuminate\Http\Request;
use App\Models\CompletedDestruction;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Brand;
use App\Models\CaseManagement;
use App\Models\Company;
use App\Models\Department;
use App\Models\Group;
use App\Models\Product;
use App\Models\SubDepartment;

class CompletedDestructionController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view completed destruction', only: ['completedDestructionIndex']),
            new Middleware('permission:create completed destruction', only: ['completedDestructionCreate']),
            new Middleware('permission:edit completed destruction', only: ['completedDestructionEdit']),
            new Middleware('permission:delete completed destruction', only: ['completedDestructionDestroy']),
        ];
    }

    public function completedDestructionIndex(){
        $completed_des = CompletedDestruction::with('department', 'subDepartment', 'company', 'product', 'brand', 'group', 'cases')->orderBy('id', 'desc')->get();
        // dd($completed_des);
        return view('admin.completed_destruction.index', compact('completed_des'));
    }


    public function completedDestructionCreate()
    {
        // dd('ok');
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        $products = Product::all();
        $brands = Brand::all();
        $groups = Group::all();
        $cases = CaseManagement::all();

        return view('admin.completed_destruction.create', compact('sub_departments', 'departments', 'companies', 'products', 'brands', 'groups', 'cases'));
    }


    public function completedDestructionStore(CompletedDestructionRequest $request)
    {
        CompletedDestruction::create($request->validated());

        return to_route('completed.destruction.index')->with('success', 'Completed Destruction Added Successfully');
    }


    public function completedDestructionEdit($id)
    {
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        // $products = Product::all();
        // $brands = Brand::all();
        $groups = Group::all();
        $cases = CaseManagement::all();

        $completed_des = CompletedDestruction::with('department', 'subDepartment', 'company', 'group', 'cases')->where('id', $id)->first();
        // dd($completed_des);

        $brands = Brand::where('company_id', $completed_des->company_id)->get();
        $products = Product::where('company_id', $completed_des->company_id)->get();

        return view('admin.completed_destruction.edit', compact('completed_des','sub_departments', 'departments', 'companies', 'products', 'brands', 'groups', 'cases'));
    }


    public function completedDestructionView($id)
    {
        $completed_des = CompletedDestruction::with('department', 'subDepartment', 'company', 'product', 'brand', 'group', 'cases')->where('id', $id)->first();
        // dd($raid);
        return view('admin.completed_destruction.view', compact('completed_des'));
    }


    public function completedDestructionUpdate(CompletedDestructionRequest $request, $id)
    {
        CompletedDestruction::where('id', $id)->update($request->validated());

        return to_route('completed.destruction.index')->with('success', 'Completed Destruction Updated Successfully');
    }



    public function completedDestructionDestroy($id)
    {
        $raid = CompletedDestruction::find($id);
        $raid->delete();
        return to_route('completed.destruction.index')->with('success', 'Completed Destruction Deleted Successfully');
    }



    public function sortCompletedDestruction(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $pendings = CompletedDestruction::with('department', 'subDepartment', 'company', 'product', 'brand', 'group', 'cases')->orderBy('id', $sortFilter)->get();

        return response()->json($pendings);
    }
}
