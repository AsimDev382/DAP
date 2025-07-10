<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RaidPlainingRequest;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Department;
use App\Models\Group;
use App\Models\Product;
use App\Models\RaidPlaining;
use App\Models\SubDepartment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class RaidPlainingController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view raid plaining & execution', only: ['raidPlainingIndex']),
            new Middleware('permission:create raid plaining & execution', only: ['raidPlainingCreate']),
            new Middleware('permission:edit raid plaining & execution', only: ['raidPlainingEdit']),
            new Middleware('permission:delete raid plaining & execution', only: ['raidPlainingDestroy']),
        ];
    }

    public function raidPlainingIndex(){
        $raid_plainings = RaidPlaining::with('department', 'subDepartment', 'company', 'product', 'brand', 'group')->orderBy('id', 'desc')->get();
        // dd($tasks);
        return view('admin.raid_plaining.index', compact('raid_plainings'));
    }


    public function raidPlainingCreate()
    {
        // dd('ok');
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        $products = Product::all();
        $brands = Brand::all();
        $groups = Group::all();

        return view('admin.raid_plaining.create', compact('sub_departments', 'departments', 'companies', 'products', 'brands', 'groups'));
    }


    public function raidPlainingStore(RaidPlainingRequest $request)
    {
        $raid = new RaidPlaining();
        $raid->auto_id = $request->auto_id;
        $raid->raid_type = $request->raid_type;
        $raid->date = $request->date;
        $raid->status = $request->status;
        $raid->location = $request->location;
        $raid->description = $request->description;
        $raid->department_id = $request->department_id;
        $raid->sub_department_id = $request->sub_department_id;
        $raid->company_id = $request->company_id;
        $raid->brand_id = $request->brand_id;
        $raid->product_id = $request->product_id;
        $raid->group_id = $request->group_id;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_document_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('RaidPlaining', $filename, 'public');
            $raid->document = $path;
        }

        $raid->save();

        return to_route('raid.plaining.index')->with('success', 'Raid Plaining Added Successfully');
    }


    public function raidPlainingEdit($id)
    {
        $companies = Company::all();
        $departments = Department::all();
        $sub_departments = SubDepartment::all();
        // $products = Product::all();
        // $brands = Brand::all();
        $groups = Group::all();

        $raid = RaidPlaining::with('department', 'subDepartment', 'company', 'product', 'brand', 'group')->where('id', $id)->first();
        $brands = Brand::where('company_id', $raid->company_id)->get();
        $products = Product::where('company_id', $raid->company_id)->get();

        // dd($task);

        return view('admin.raid_plaining.edit', compact('raid','sub_departments', 'departments', 'companies', 'products', 'brands', 'groups'));
    }


    public function raidPlainingView($id)
    {
        $raid = RaidPlaining::with('department', 'subDepartment', 'company', 'product', 'brand', 'group', 'cases')->where('id', $id)->first();
        // dd($raid);
        return view('admin.raid_plaining.view', compact('raid'));
    }


    public function raidPlainingUpdate(RaidPlainingRequest $request, $id)
    {
        $raid = RaidPlaining::find($id);
        $raid->auto_id = $request->auto_id;
        $raid->raid_type = $request->raid_type;
        $raid->date = $request->date;
        $raid->status = $request->status;
        $raid->location = $request->location;
        $raid->description = $request->description;
        $raid->department_id = $request->department_id;
        $raid->sub_department_id = $request->sub_department_id;
        $raid->company_id = $request->company_id;
        $raid->brand_id = $request->brand_id;
        $raid->product_id = $request->product_id;
        $raid->group_id = $request->group_id;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_document_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('RaidPlaining', $filename, 'public');
            $raid->document = $path;
        }
        $raid->update();

        return to_route('raid.plaining.index')->with('success', 'Raid Plaining Updated Successfully');
    }



    public function raidPlainingDestroy($id)
    {
        $raid = RaidPlaining::find($id);
        $raid->delete();
        return to_route('raid.plaining.index')->with('success', 'Raid Plaining Deleted Successfully');
    }



    public function sortRaidPlaining(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $raids = RaidPlaining::with('department', 'subDepartment', 'company', 'product', 'brand', 'group')->orderBy('id', $sortFilter)->get();


        return response()->json($raids);
    }


    public function updateStatus(Request $request, $id)
    {
        $raids = Group::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $raids->status = $newStatus;
        $raids->save();

        return response()->json(['status' => $newStatus]);
    }
}
