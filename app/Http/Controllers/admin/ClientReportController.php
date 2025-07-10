<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientReportRequest;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\ClientReport;
use App\Models\Company;
use App\Models\Department;
use App\Models\Group;
use App\Models\Product;
use App\Models\SubDepartment;
use App\Models\User;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class ClientReportController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view client report', only: ['clientReportIndex']),
            new Middleware('permission:create client report', only: ['clientReportCreate']),
            new Middleware('permission:edit client report', only: ['clientReportEdit']),
            new Middleware('permission:delete client report', only: ['clientReportDestroy']),
        ];
    }

    public function clientReportIndex(){
        $reports = ClientReport::with('company', 'brand', 'product', 'case')->orderBy('id', 'desc')->get();
        // dd($reports);

        return view('admin.client_report.index', compact('reports'));
    }


    public function clientReportCreate()
    {
        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $groups = Group::all();

        $user = Auth::user();
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'superadmin');
        })
        ->get();


        return view('admin.client_report.create', compact('companies', 'brands', 'products', 'departments', 'subDepartments', 'groups', 'users'));
    }


    public function clientReportStore(ClientReportRequest $request)
    {
        $report = $request->only((new ClientReport)->getFillable());
        if ($request->hasFile('document')) {
            $image = $request->file('document');
            $filename = date('dmy') . '_report_' . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('Reports', $filename, 'public');
            $report['document'] = $path;
        }
        ClientReport::create($report);

        return to_route('client-report.index')->with('success', 'client Report Added Successfully');
    }


    public function clientReportEdit($id)
    {
        $report = ClientReport::where('id', $id)->first();

        $brands = Brand::where('company_id', $report->company_id)->get();
        $products = Product::where('company_id', $report->company_id)->get();
        $companies = Company::all();
        // $brands = Brand::all();
        // $products = Product::all();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $groups = Group::all();
        $user = Auth::user();
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'superadmin');
        })
        ->get();

        return view('admin.client_report.edit', compact('report', 'companies', 'brands', 'products', 'departments', 'subDepartments', 'groups', 'users'));
    }


    public function clientReportShow($id)
    {
        // $expense = Expenses::where('id', $id)->first();
        $report = ClientReport::with('user', 'company', 'brand', 'product', 'department')->where('id', $id)->first();

       $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $departments = Department::all();
        $subDepartments = SubDepartment::all();
        $groups = Group::all();

        return view('admin.client_report.view', compact('report', 'companies', 'brands', 'products', 'departments', 'subDepartments', 'groups'));
    }


    public function clientReportUpdate(ClientReportRequest $request, $id)
    {
        // $reports = $request->validated();
        // clientReport::where('id', $id)->update($reports);

        $report = $request->only((new ClientReport)->getFillable());
        if ($request->hasFile('document')) {
            $image = $request->file('document');
            $filename = date('dmy') . '_report_' . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('Reports', $filename, 'public');
            $report['document'] = $path;
        }
        ClientReport::where('id', $id)->update($report);

        return to_route('client-report.index')->with('success', 'Client Report Updated Successfully');
    }



    public function clientReportDestroy($id)
    {
        $reports = ClientReport::find($id);
        $reports->delete();
        return to_route('client-report.index')->with('success', 'Client Report Deleted Successfully');
    }



    public function sortClientReport(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $invoices = ClientReport::with('case', 'company', 'brand', 'product')->orderBy('id', $sortFilter)->get();

        return response()->json($invoices);
    }


    public function getUserData($id)
    {
        $user = User::find($id);
        // dd($user);
        if ($user) {
            return response()->json([
                'auto_id' => $user->auto_id,
                'name' => $user->name,
            ]);
        } else {
            return response()->json([
                'auto_id' => '',
                'name' => '',
            ]);
        }
    }
}
