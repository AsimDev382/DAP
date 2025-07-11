<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            // new Middleware('permission:company', only: ['companyIndex']),
            // new Middleware('permission:company', only: ['companyCreate']),
            // new Middleware('permission:company', only: ['companyDestroy']),
            // new Middleware('permission:company', only: ['companyEdit']),

            new Middleware('permission:view company', only: ['companyIndex']),
            new Middleware('permission:create company', only: ['companyCreate']),
            new Middleware('permission:edit company', only: ['companyEdit']),
            new Middleware('permission:delete company', only: ['companyDestroy']),
        ];
    }

    public function companyIndex(Request $request)
    {
        $companies = Company::orderBy('id', 'desc')->get();

        // $query = Company::query();

        // if ($request->has('search') && $request->search != '') {
        //     $search = $request->search;

        //     $query->where(function($q) use ($search) {
        //         $q->where('company_name', 'LIKE', "%{$search}%")
        //           ->orWhere('company_email', 'LIKE', "%{$search}%")
        //           ->orWhere('phone_no', 'LIKE', "%{$search}%")
        //           ->orWhere('company_address', 'LIKE', "%{$search}%")
        //           ->orWhere('status', 'LIKE', "%{$search}%");
        //     });
        // }
        // $companies = $query->get();


        return view('admin.company.index', compact('companies'));
    }

    public function companyCreate(){
        return view('admin.company.create');
    }

    public function companyStore(CompanyRequest $request)
    {
        // dd($request->all());
        $company = new Company();
        $company->company_name = $request->company_name;
        $company->company_address = $request->company_address;
        $company->company_email = $request->company_email;
        $company->phone_no = $request->phone_no;
        // $company->password = encrypt($request->password);
        $company->mou_start_date = $request->mou_start_date;
        $company->mou_end_date = $request->mou_end_date;
        $company->company_detail = $request->company_detail;
        $company->status = 'Active';
        // $company->user_id = Auth::user()->id;
        // $company->company_id = $request->company_id;

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $filename = date('dmy') . '_logo_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Company', $filename, 'public');
            $company->company_logo = $path;
        }

        if ($request->hasFile('company_pdf')) {
            $file = $request->file('company_pdf');
            $filename = date('dmy') . '_pdf_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Company', $filename, 'public');
            $company->company_pdf = $path;
        }

        $company->save();
        if($request->action == 'Brand'){
            return to_route('brand.create')->with('success', 'Company Added Successfully');
        }
        return to_route('company.index')->with('success', 'Company Added Successfully');
    }


    public function companyEdit($id)
    {
        $company = Company::find($id);
        return view('admin.company.edit', compact('company'));
    }


    public function companyView($id)
    {
        $company = Company::find($id);

        $users = User::with('company')
        ->whereDoesntHave('roles', function ($query) {
            $query->where('name', 'superadmin');
        })
        ->orderBy('id', 'desc')
        ->get();

        // dd($users);


        $brands = Brand::withCount([
            'case as approved_count' => function ($q) {
                $q->where('status', 'Approved');
            },
            'case as pending_count' => function ($q) {
                $q->where('status', 'Pending Approved');
            },
            'case as closed_count' => function ($q) {
                $q->where('status', 'Rejected');
            },
            'case as in_progress_count' => function ($q) {
                $q->where('status', 'In Progress');
            },
        ])->with('case')->orderBy('id', 'desc')->get();


        $products = Product::withCount([
            'case as approved_count' => function ($q) {
                $q->where('status', 'Approved');
            },
            'case as pending_count' => function ($q) {
                $q->where('status', 'Pending Approved');
            },
            'case as closed_count' => function ($q) {
                $q->where('status', 'Rejected');
            },
            'case as in_progress_count' => function ($q) {
                $q->where('status', 'In Progress');
            },
        ])->with('case', 'brand', 'company')->orderBy('id', 'desc')->get();

        return view('admin.company.view', compact('company', 'users', 'brands', 'products'));
    }


    public function companyUpdate(CompanyRequest $request, $id)
    {
        // dd($request->all());
        $company = Company::find($id);
        $company->company_name = $request->company_name;
        $company->company_address = $request->company_address;
        $company->company_email = $request->company_email;
        $company->phone_no = $request->phone_no;
        $company->password = encrypt($request->password);
        $company->mou_start_date = $request->mou_start_date;
        $company->mou_end_date = $request->mou_end_date;
        $company->company_detail = $request->company_detail;

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $filename = date('dmy') . '_logo_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Company', $filename, 'public');
            $company->company_logo = $path;
        }

        if ($request->hasFile('company_pdf')) {
            $file = $request->file('company_pdf');
            $filename = date('dmy') . '_pdf_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Company', $filename, 'public');
            $company->company_pdf = $path;
        }
        $company->update();

        if($request->action == 'Brand'){
            return to_route('brand.create')->with('success', 'Company Added Successfully');
        }

        return to_route('company.index')->with('success', 'Company Updated Successfully');
    }

    public function companyDestroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return to_route('company.index')->with('success', 'Company Deleted Successfully');
    }

    public function updateStatus(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $company->status = $newStatus;
        $company->save();

        return response()->json(['status' => $newStatus]);
    }



    public function sortCompany(Request $request)
    {

        // Retrieve filter inputs
        $sortFilter = $request->get('sortFilter');
        // Query to filter tickets
        $companies = Company::orderBy('id', $sortFilter)->get();

        // Return JSON response to be handled by AJAX
        return response()->json($companies);
    }

}
