<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvestigationRequest;
use App\Models\Brand;
use App\Models\CaseManagement;
use App\Models\Company;
use App\Models\Investigation;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class InvestigationController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view investigation', only: ['investigationIndex']),
            new Middleware('permission:create investigation', only: ['investigationCreate']),
            new Middleware('permission:edit investigation', only: ['investigationEdit']),
            new Middleware('permission:delete investigation', only: ['investigationDestroy']),
        ];
    }

    public function investigationIndex(){
        $investigations = Investigation::with('company', 'brand', 'product', 'case')->orderBy('id', 'desc')->get();
        // dd($investigations);
        return view('admin.investigation.index', compact('investigations'));
    }


    public function investigationCreate()
    {
        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $cases = CaseManagement::all();
        $users = User::all();
        return view('admin.investigation.create', compact('companies', 'brands', 'products', 'cases', 'users'));
    }


    public function investigationStore(InvestigationRequest $request)
    {
        // dd($request->all());
        $investigation = new Investigation();
        $investigation->auto_id = $request->auto_id;
        $investigation->client_id = $request->client_id;
        $investigation->case_id = $request->case_id;
        $investigation->invest_name = $request->invest_name;
        $investigation->case_type = $request->case_type;
        $investigation->company_id = $request->company_id;
        $investigation->brand_id = $request->brand_id;
        $investigation->product_id = $request->product_id;
        $investigation->current_status = $request->current_status;
        $investigation->location = $request->location;
        $investigation->user_id = $request->user_id;
        $investigation->task_start_date = $request->task_start_date;
        $investigation->task_deadline = $request->task_deadline;
        $investigation->investigation_description = $request->investigation_description;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_investigation_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Investigation', $filename, 'public');
            $investigation->document = $path;
        }
        $investigation->save();

        if($request->action == 'Raid'){
            return to_route('raid.plaining.create')->with('success', 'Brand Added Successfully');
        }

        return to_route('investigation.index')->with('success', 'Investigation Added Successfully');
    }


    public function investigationEdit($id)
    {
        $investigation = Investigation::with('user')->where('id', $id)->first();
        // dd($investigation);
        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $cases = CaseManagement::all();
        $users = User::all();

        return view('admin.investigation.edit', compact('companies', 'brands', 'investigation', 'products', 'cases', 'users'));
    }
    public function investigationView($id)
    {
        $investigation = Investigation::with('user')->where('id', $id)->first();
        // dd($investigation);
        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $cases = CaseManagement::all();
        $users = User::all();

        return view('admin.investigation.view', compact('companies', 'brands', 'investigation', 'products', 'cases', 'users'));
    }


    public function investigationUpdate(InvestigationRequest $request, $id)
    {
        $investigation = Investigation::find($id);

        $investigation->auto_id = $request->auto_id;
        $investigation->client_id = $request->client_id;
        $investigation->case_id = $request->case_id;
        $investigation->invest_name = $request->invest_name;
        $investigation->case_type = $request->case_type;
        $investigation->company_id = $request->company_id;
        $investigation->brand_id = $request->brand_id;
        $investigation->product_id = $request->product_id;
        $investigation->current_status = $request->current_status;
        $investigation->location = $request->location;
        $investigation->user_id = $request->user_id;
        $investigation->task_start_date = $request->task_start_date;
        $investigation->task_deadline = $request->task_deadline;
        $investigation->investigation_description = $request->investigation_description;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_investigation_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Investigation', $filename, 'public');
            $investigation->document = $path;
        }
        $investigation->update();

        if($request->action == 'Raid'){
            return to_route('raid.plaining.create')->with('success', 'Brand Added Successfully');
        }

        return to_route('investigation.index')->with('success', 'Investigation Updated Successfully');
    }



    public function investigationDestroy($id)
    {
        $investigation = Investigation::find($id);
        $investigation->delete();
        return to_route('investigation.index')->with('success', 'Investigation Deleted Successfully');
    }



    public function sortInvestigation(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $invest = Investigation::with('company', 'brand', 'product', 'case', 'case')->orderBy('id', $sortFilter)->get();

        return response()->json($invest);
    }
}
