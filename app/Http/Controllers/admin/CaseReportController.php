<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaseReportRequest;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\CaseReport;
use App\Models\Company;
use App\Models\Department;
use App\Models\Group;
use App\Models\Product;
use App\Models\SubDepartment;
use Illuminate\Routing\Controllers\Middleware;

class CaseReportController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view case report', only: ['caseReportIndex']),
            new Middleware('permission:create case report', only: ['caseReportCreate']),
            new Middleware('permission:edit case report', only: ['caseReportEdit']),
            new Middleware('permission:delete case report', only: ['caseReportDestroy']),
        ];
    }

    public function caseReportIndex(){
        $reports = CaseReport::with('company', 'brand', 'product', 'case', 'investigation.company')->orderBy('id', 'desc')->get();
        // dd($expenses);

        return view('admin.case_report.index', compact('reports'));
    }


    public function caseReportCreate()
    {
        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $groups = Group::all();


        return view('admin.case_report.create', compact('companies', 'brands', 'products', 'departments', 'subDepartments', 'groups'));
    }


    public function caseReportStore(CaseReportRequest $request)
    {
        // $data = $request->validated();
        // CaseReport::create($data);

        $report = $request->only((new CaseReport)->getFillable());
        if ($request->hasFile('document')) {
            $image = $request->file('document');
            $filename = date('dmy') . '_report_' . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('Reports', $filename, 'public');
            $report['document'] = $path;
        }
        CaseReport::create($report);

        return to_route('case-report.index')->with('success', 'Case Report Added Successfully');
    }


    public function caseReportEdit($id)
    {
        $report = CaseReport::where('id', $id)->first();

        $companies = Company::all();
        // $brands = Brand::all();
        // $products = Product::all();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $groups = Group::all();
        $brands = Brand::where('company_id', $report->company_id)->get();
        $products = Product::where('company_id', $report->company_id)->get();

        return view('admin.case_report.edit', compact('report', 'companies', 'brands', 'products', 'departments', 'subDepartments', 'groups'));
    }


    public function caseReportShow($id)
    {
        // $expense = Expenses::where('id', $id)->first();
        $report = CaseReport::with('case', 'company', 'brand', 'product', 'department')->where('id', $id)->first();

       $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $groups = Group::all();

        return view('admin.case_report.view', compact('report', 'companies', 'brands', 'products', 'departments', 'subDepartments', 'groups'));
    }


    public function caseReportUpdate(CaseReportRequest $request, $id)
    {
        // $reports = $request->validated();
        // CaseReport::where('id', $id)->update($reports);

        $report = $request->only((new CaseReport)->getFillable());
        if ($request->hasFile('document')) {
            $image = $request->file('document');
            $filename = date('dmy') . '_report_' . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('Reports', $filename, 'public');
            $report['document'] = $path;
        }
        CaseReport::where('id', $id)->update($report);

        return to_route('case-report.index')->with('success', 'Case Report Updated Successfully');
    }



    public function caseReportDestroy($id)
    {
        $reports = CaseReport::find($id);
        $reports->delete();
        return to_route('case-report.index')->with('success', 'Case Report Deleted Successfully');
    }



    public function sortCaseReport(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $invoices = CaseReport::with('case', 'company', 'brand', 'product', 'investigation.company')->orderBy('id', $sortFilter)->get();

        return response()->json($invoices);
    }
}
