<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            // new Middleware('permission:brand', only: ['brandIndex']),
            // new Middleware('permission:brand', only: ['brandCreate']),
            // new Middleware('permission:brand', only: ['brandDestroy']),
            // new Middleware('permission:brand', only: ['brandEdit']),

            new Middleware('permission:view brand', only: ['brandIndex']),
            new Middleware('permission:create brand', only: ['brandCreate']),
            new Middleware('permission:Edit brand', only: ['brandEdit']),
            new Middleware('permission:delete brand', only: ['brandDestroy']),
        ];
    }

    public function brandIndex(){
        // $brands = Brand::with('company', 'case')->orderBy('id', 'desc')->get();
        // dd($brands);
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

        return view('admin.brand.index', compact('brands'));
    }

    public function brandCreate(){
        $companies = Company::all();
        return view('admin.brand.create', compact('companies'));
    }


    public function brandStore(BrandRequest $request)
    {
        // dd($request->all());
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->start_date = $request->start_date;
        $brand->end_date = $request->end_date;
        $brand->detail = $request->detail;
        $brand->status = 'Active';
        // $brand->user_id = Auth::user()->id;
        $brand->company_id = $request->company_id;

        if ($request->hasFile('brand_logo')) {
            $file = $request->file('brand_logo');
            $filename = date('dmy') . '_logo_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Brand', $filename, 'public');
            $brand->brand_logo = $path;
        }

        if ($request->hasFile('brand_pdf')) {
            $file = $request->file('brand_pdf');
            $filename = date('dmy') . '_pdf_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Brand', $filename, 'public');
            $brand->brand_pdf = $path;
        }

        $brand->save();
        if($request->action == 'Product'){
            return to_route('product.create')->with('success', 'Brand Added Successfully');
        }
        return to_route('brand.index')->with('success', 'Brand Added Successfully');
    }


    public function brandEdit($id){
        $brand = Brand::find($id);
        $companies = Company::all();
        return view('admin.brand.edit', compact('companies', 'brand'));
    }


    public function brandUpdate(BrandRequest $request, $id)
    {
        // dd($request->all());
        $brand = Brand::find($id);
        $brand->brand_name = $request->brand_name;
        $brand->start_date = $request->start_date;
        $brand->end_date = $request->end_date;
        $brand->detail = $request->detail;
        // $brand->user_id = Auth::user()->id;
        $brand->company_id = $request->company_id;

        if ($request->hasFile('brand_logo')) {
            $file = $request->file('brand_logo');
            $filename = date('dmy') . '_logo_' . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Brand', $filename, 'public');
            $brand->brand_logo = $path;
        }

        if ($request->hasFile('brand_pdf')) {
            $file = $request->file('brand_pdf');
            $filename = date('dmy') . '_pdf_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('Brand', $filename, 'public');
            $brand->brand_pdf = $path;
        }

        $brand->update();
        if($request->action == 'Product'){
            return to_route('product.create')->with('success', 'Brand Added Successfully');
        }
        return to_route('brand.index')->with('success', 'Brand Updated successfully');
    }

    public function brandDestroy($id){
        $brand = Brand::find($id);
        $brand->delete();
        return to_route('brand.index')->with('success', 'Brand Deleted successfully');
    }

    public function updateBrandStatus(Request $request, $id)
    {
        $company = Brand::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $company->status = $newStatus;
        $company->save();

        return response()->json(['status' => $newStatus]);
    }


    public function sortBrand(Request $request)
    {

        // Retrieve filter inputs
        $sortFilter = $request->get('sortFilter');
        // Query to filter tickets
        $brand = Brand::withCount([
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
        ])->with('case')->orderBy('id', $sortFilter)->get();

        // Return JSON response to be handled by AJAX
        return response()->json($brand);
    }
}
