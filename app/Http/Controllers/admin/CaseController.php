<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaseRequest;
use App\Models\AssignTask;
use App\Models\Brand;
use App\Models\CaseManagement;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class CaseController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('permission:view case management', only: ['caseIndex']),
            new Middleware('permission:create case management', only: ['caseCreate']),
            new Middleware('permission:edit case management', only: ['caseEdit']),
            new Middleware('permission:delete case management', only: ['caseDestroy']),
        ];
    }

    public function caseIndex()
    {
        // $user = Auth::user();
        // $isSuperAdmin = $user->roles()->where('name', 'superadmin')->exists();
        // $cases = CaseManagement::with('product', 'company', )
        //     ->when(!$isSuperAdmin, function ($query) use ($user) {
        //         $query->where('company_id', $user->company_id); // Filter by user_id
        //     })
        //     ->orderBy('id', 'desc')
        //     ->get();

        // $user = Auth::user();
        // $assignedCaseIds = AssignTask::whereRaw("FIND_IN_SET(?, user_id)", [$user->id])
        // ->pluck('case_management_id')
        // ->unique();
        // // Determine if superadmin
        // $isSuperAdmin = $user->roles()->where('name', 'superadmin')->exists();

        // // Fetch those cases only
        // $cases = CaseManagement::with('product', 'company')
        //     ->whereIn('id', $assignedCaseIds)
        //     ->when(!$isSuperAdmin, function ($query) use ($user) {
        //             $query->where('company_id', $user->company_id);
        //     })
        // ->orderBy('id', 'desc')
        // ->get();

        $user = Auth::user();

        // Get all case IDs where this user is assigned
        $assignedCaseIds = AssignTask::whereRaw("FIND_IN_SET(?, user_id)", [$user->id])
            ->pluck('case_management_id')
            ->unique();
        // dd($assignedCaseIds);

        // Determine if superadmin
        $isSuperAdmin = $user->roles()->where('name', 'superadmin')->exists();

        // Fetch those cases only
        $cases = CaseManagement::with('product', 'company')
            ->when(!$isSuperAdmin, function ($query) use ($user, $assignedCaseIds) {
                $query->whereIn('id', $assignedCaseIds);
            })
            ->when($isSuperAdmin, function ($query) use ($user) {})
            ->orderBy('id', 'desc')
            ->get();

        // dd($cases);

        return view('admin.case.index', compact('cases'));
    }

    public function caseCreate()
    {
        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        return view('admin.case.create', compact('companies', 'brands', 'products'));
    }


    public function caseStore(CaseRequest $request)
    {
        $case = new CaseManagement();
        $case->user_id = Auth::user()->id;
        $case->auto_id = $request->auto_id;
        $case->client_id = $request->client_id;
        $case->case_name = $request->case_name;
        $case->case_type = $request->case_type;
        $case->target_category = $request->target_category;
        $case->case_priority = $request->case_priority;
        $case->case_fee = $request->case_fee;
        $case->flag = $request->flag;
        $case->case_location = $request->case_location;
        $case->start_date = $request->start_date;
        $case->end_date = $request->end_date;
        $case->status = $request->status;
        $case->description = $request->description;
        $case->company_id = $request->company_id;
        $case->brand_id = $request->brand_id;
        $case->product_id = $request->product_id;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_document_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Case', $filename, 'public');
            $case->document = $path;
        }
        $case->save();

        if($request->action == 'Investigation'){
            return to_route('investigation.create')->with('success', 'Brand Added Successfully');
        }
        return to_route('case.index')->with('success', 'Case Added Successfully');
    }


    public function caseEdit($id)
    {
        $case = CaseManagement::find($id);
        $companies = Company::all();
        // $brands = Brand::all();
        // $products = Product::all();

        $brands = Brand::where('company_id', $case->company_id)->get();
        $products = Product::where('company_id', $case->company_id)->get();
        // dd($case);

        return view('admin.case.edit', compact('companies', 'brands', 'case', 'products'));
    }


    public function caseView($id)
    {
        $case = CaseManagement::find($id);
        $company = Company::where('id', $case->company_id)->first();
        $brand = Brand::where('id', $case->brand_id)->first();
        $product = Product::where('id', $case->product_id)->first();
        return view('admin.case.view', compact('company', 'brand', 'case', 'product'));
    }


    public function caseUpdate(CaseRequest $request, $id)
    {
        $case = CaseManagement::find($id);

        // $case->auto_id = $request->auto_id;
        $case->client_id = $request->client_id;
        $case->case_name = $request->case_name;
        $case->case_type = $request->case_type;
        $case->target_category = $request->target_category;
        $case->case_priority = $request->case_priority;
        $case->case_fee = $request->case_fee;
        $case->task = $request->task;
        $case->flag = $request->flag;
        $case->case_location = $request->case_location;
        $case->start_date = $request->start_date;
        $case->end_date = $request->end_date;
        $case->status = $request->status;
        $case->description = $request->description;
        $case->company_id = $request->company_id;
        $case->brand_id = $request->brand_id;
        $case->product_id = $request->product_id;

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filename = date('dmy') . '_document_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Case', $filename, 'public');
            $case->document = $path;
        }
        $case->update();

        if($request->action == 'Investigation'){
            return to_route('investigation.create')->with('success', 'Brand Added Successfully');
        }

        return to_route('case.index')->with('success', 'Case Updated Successfully');
    }



    public function caseDestroy($id)
    {
        // dd($id);
        $case = CaseManagement::find($id);
        $case->delete();
        return to_route('case.index')->with('success', 'Case Deleted Successfully');
    }


    public function getCaseData($id)
    {
        $case = CaseManagement::with('product', 'company', 'brand')->find($id);
        // dd($case);
        if ($case) {
            return response()->json([
                'case_type' => $case->case_type,
                'brand_id' => $case->brand,
                'product_id' => $case->product,
                'company_id' => $case->company,
            ]);
        } else {
            return response()->json([
                'case_type' => '',
                'brand_id' => '',
                'product_id' => '',
                'company_id' => '',
            ]);
        }
    }


    // public function sortCases(Request $request)
    // {
    //     $order = $request->get('order', 'asc');
    //     // dd($request->all());

    //     $cases = CaseManagement::with('product', 'company', 'brand')
    //                 ->orderBy('id', $order)
    //                 ->get();

    //     return view('admin.case.index', compact('cases'))->render();

    // }

    public function sortCases(Request $request)
    {
        // $sortFilter = $request->get('sortFilter', 'desc');
        // $search = $request->get('search', '');

        // $cases = CaseManagement::with('product', 'company', 'brand')
        //     ->when($search, function ($query) use ($search) {
        //         $query->where('case_name', 'LIKE', "%$search%")
        //             ->orWhere('case_type', 'LIKE', "%$search%")
        //             ->orWhere('case_priority', 'LIKE', "%$search%")
        //             ->orWhereHas('product', function ($q) use ($search) {
        //                 $q->where('product_name', 'LIKE', "%$search%");
        //             })
        //             ->orWhereHas('brand', function ($q) use ($search) {
        //                 $q->where('brand_name', 'LIKE', "%$search%");
        //             })
        //             ->orWhereHas('company', function ($q) use ($search) {
        //                 $q->where('company_name', 'LIKE', "%$search%");
        //             });
        //     })
        // ->orderBy('id', $sortFilter)
        // ->get();

        // return response()->json($cases);

        // Retrieve filter inputs
        $sortFilter = $request->get('sortFilter');
        // Query to filter tickets
        $cases = CaseManagement::with('product', 'company', 'brand')
            ->orderBy('id', $sortFilter)
            ->get();

        // Return JSON response to be handled by AJAX
        return response()->json($cases);
    }


    public function getCompanyBrands($companyId)
    {
        $brands = Brand::where('company_id', $companyId)->get(['id', 'brand_name']);
        return response()->json(['brands' => $brands]);
    }

    public function getBrandProducts($brandId)
    {
        $products = Product::where('brand_id', $brandId)->get(['id', 'product_name']);
        return response()->json(['products' => $products]);
    }

}
