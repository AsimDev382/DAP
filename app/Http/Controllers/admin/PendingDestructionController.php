<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendingDestructionRequest;
use App\Models\Brand;
use App\Models\CaseManagement;
use App\Models\Company;
use App\Models\Department;
use App\Models\Group;
use App\Models\PendingDestruction;
use App\Models\Product;
use App\Models\RaidPlaining;
use App\Models\SubDepartment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class PendingDestructionController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view pending destruction', only: ['pendingDestructionIndex']),
            new Middleware('permission:create pending destruction', only: ['pendingDestructionCreate']),
            new Middleware('permission:edit pending destruction', only: ['pendingDestructionEdit']),
            new Middleware('permission:delete pending destruction', only: ['pendingDestructionDestroy']),
        ];
    }

    public function pendingDestructionIndex(){
        $pending_des = PendingDestruction::with('department', 'subDepartment', 'company', 'product', 'brand', 'group', 'cases')->orderBy('id', 'desc')->get();
        // dd($pending_des);
        return view('admin.pending_destruction.index', compact('pending_des'));
    }


    public function pendingDestructionCreate()
    {
        // dd('ok');
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        $products = Product::all();
        $brands = Brand::all();
        $groups = Group::all();
        $cases = CaseManagement::all();

        return view('admin.pending_destruction.create', compact('sub_departments', 'departments', 'companies', 'products', 'brands', 'groups', 'cases'));
    }


    public function pendingDestructionStore(PendingDestructionRequest $request)
    {
        // $raid = new PendingDestruction();
        // $raid->auto_id = $request->auto_id;
        // $raid->raid_type = $request->raid_type;
        // $raid->date = $request->date;
        // $raid->status = $request->status;
        // $raid->location = $request->location;
        // $raid->description = $request->description;
        // $raid->department_id = $request->department_id;
        // $raid->sub_department_id = $request->sub_department_id;
        // $raid->company_id = $request->company_id;
        // $raid->brand_id = $request->brand_id;
        // $raid->product_id = $request->product_id;
        // $raid->group_id = $request->group_id;
        // $raid->save();

        PendingDestruction::create($request->validated());

        return to_route('pending.destruction.index')->with('success', 'Pending Destruction Added Successfully');
    }


    public function pendingDestructionEdit($id)
    {
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        // $products = Product::all();
        // $brands = Brand::all();
        $groups = Group::all();
        $cases = CaseManagement::all();

        $pending_des = PendingDestruction::with('department', 'subDepartment', 'company', 'product', 'brand', 'group', 'cases')->where('id', $id)->first();

        $brands = Brand::where('company_id', $pending_des->company_id)->get();
        $products = Product::where('company_id', $pending_des->company_id)->get();

        return view('admin.pending_destruction.edit', compact('pending_des','sub_departments', 'departments', 'companies', 'products', 'brands', 'groups', 'cases'));
    }


    public function pendingDestructionView($id)
    {
        $pending_des = PendingDestruction::with('department', 'subDepartment', 'company', 'product', 'brand', 'group', 'cases')->where('id', $id)->first();
        // dd($raid);
        return view('admin.pending_destruction.view', compact('pending_des'));
    }


    public function pendingDestructionUpdate(PendingDestructionRequest $request, $id)
    {
        PendingDestruction::where('id', $id)->update($request->validated());

        return to_route('pending.destruction.index')->with('success', 'Pending Destruction Updated Successfully');
    }



    public function PendingDestructionDestroy($id)
    {
        $raid = PendingDestruction::find($id);
        $raid->delete();
        return to_route('pending.destruction.index')->with('success', 'Pending Destruction Deleted Successfully');
    }



    public function sortPendingDestruction(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $pendings = PendingDestruction::with('department', 'subDepartment', 'company', 'product', 'brand', 'group', 'cases')->orderBy('id', $sortFilter)->get();

        return response()->json($pendings);
    }
}
