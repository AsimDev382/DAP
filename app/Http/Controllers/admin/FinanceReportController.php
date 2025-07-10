<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FinanceReport as RequestsFinanceReport;
use App\Http\Requests\FinanceReportRequest;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Department;
use App\Models\FinanceReport;
use App\Models\Group;
use App\Models\Product;
use App\Models\SubDepartment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class FinanceReportController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view finance report', only: ['financeReportIndex']),
            new Middleware('permission:create finance report', only: ['financeReportCreate']),
            new Middleware('permission:edit finance report', only: ['financeReportEdit']),
            new Middleware('permission:delete finance report', only: ['financeReportDestroy']),
        ];
    }

    public function financeReportIndex(){
        $reports = FinanceReport::with('company', 'brand', 'product', 'investigation.company')->orderBy('id', 'desc')->get();
        // dd($reports);

        return view('admin.finance_report.index', compact('reports'));
    }


    public function financeReportCreate()
    {
        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $groups = Group::all();


        return view('admin.finance_report.create', compact('companies', 'brands', 'products', 'departments', 'subDepartments', 'groups'));
    }


    public function financeReportStore(FinanceReportRequest $request)
    {
        $report = $request->only((new FinanceReport)->getFillable());
        if ($request->hasFile('document')) {
            $image = $request->file('document');
            $filename = date('dmy') . '_report_' . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('Reports', $filename, 'public');
            $report['document'] = $path;
        }
        FinanceReport::create($report);

        return to_route('finance-report.index')->with('success', 'Finance Report Added Successfully');
    }


    public function financeReportEdit($id)
    {
        $report = FinanceReport::where('id', $id)->first();

        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $groups = Group::all();

        return view('admin.finance_report.edit', compact('report', 'companies', 'brands', 'products', 'departments', 'subDepartments', 'groups'));
    }


    public function financeReportShow($id)
    {
        // $expense = Expenses::where('id', $id)->first();
        $report = FinanceReport::with('company', 'brand', 'product', 'department')->where('id', $id)->first();

        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $groups = Group::all();

        return view('admin.finance_report.view', compact('report', 'companies', 'brands', 'products', 'departments', 'subDepartments', 'groups'));
    }


    public function financeReportUpdate(FinanceReportRequest $request, $id)
    {

        $report = $request->only((new FinanceReport)->getFillable());
        if ($request->hasFile('document')) {
            $image = $request->file('document');
            $filename = date('dmy') . '_report_' . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('Reports', $filename, 'public');
            $report['document'] = $path;
        }
        FinanceReport::where('id', $id)->update($report);

        return to_route('finance-report.index')->with('success', 'Finance Report Updated Successfully');
    }



    public function financeReportDestroy($id)
    {
        $reports = FinanceReport::find($id);
        $reports->delete();
        return to_route('finance-report.index')->with('success', 'Finance Report Deleted Successfully');
    }



    public function sortfinanceReport(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $invoices = FinanceReport::with('company', 'brand', 'product', 'investigation.company')->orderBy('id', $sortFilter)->get();

        return response()->json($invoices);
    }
}
