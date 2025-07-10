<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view product', only: ['productIndex']),
            new Middleware('permission:create product', only: ['productCreate']),
            new Middleware('permission:edit product', only: ['productEdit']),
            new Middleware('permission:delete product', only: ['productDestroy']),
        ];
    }



    public function productIndex()
    {
        // $products = Product::with('brand', 'company')->orderBy('id', 'desc')->get();
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

        return view('admin.product.index', compact('products'));
    }



    public function productCreate()
    {
        $companies = Company::all();
        $brands = Brand::all();
        return view('admin.product.create', compact('companies', 'brands'));
    }


    public function productStore(ProductRequest $request)
    {
        $product = new Product();
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->brand_id = $request->brand_id;
        $product->product_category = $request->product_category;
        $product->trademark_date = $request->trademark_date;
        $product->patient_date = $request->patient_date;
        $product->copyright_date = $request->copyright_date;
        $product->product_detail = $request->product_detail;
        $product->save();

        if ($request->hasFile('product_img')) {
            foreach ($request->file('product_img') as $index => $file) {
                $filename = date('dmy_His') . "_{$index}_" . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('Product', $filename, 'public');

                // Example 1: Store in a related table (recommended)
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        if($request->action == 'Case'){
            return to_route('case.create')->with('success', 'Product Added Successfully');
        }

        return to_route('product.index')->with('success', 'Product Added Successfully');
    }


    public function productEdit($id)
    {
        $product = Product::find($id);
        $companies = Company::all();
        $brands = Brand::all();
        return view('admin.product.edit', compact('companies', 'brands', 'product'));
    }


    public function productUpdate(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->company_id = $request->company_id;
        $product->brand_id = $request->brand_id;
        $product->product_category = $request->product_category;
        $product->trademark_date = $request->trademark_date;
        $product->patient_date = $request->patient_date;
        $product->copyright_date = $request->copyright_date;
        $product->product_detail = $request->product_detail;

        $product->update();

        if ($request->hasFile('product_img')) {
            foreach ($request->file('product_img') as $index => $file) {
                $filename = date('dmy_His') . "_{$index}_" . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('Product', $filename, 'public');

                // Example 1: Store in a related table (recommended)
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        if($request->action == 'Case'){
            return to_route('case.create')->with('success', 'Brand Added Successfully');
        }

        return to_route('product.index')->with('success', 'Product Updated Successfully');
    }



    public function productDestroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return to_route('product.index')->with('success', 'Product Deleted Successfully');
    }

    public function updateProductStatus(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $product->status = $newStatus;
        $product->save();

        return response()->json(['status' => $newStatus]);
    }

    // brand profile
    public function productBrandProfile(Request $request, $id)
    {
        $brand = Brand::with('company')->find($id);
        // dd($brand);

        return view('admin.product.brand_profile', compact('brand'));
    }
    // Product profile
    public function productProfile(Request $request, $id)
    {
        $product = Product::with('company')->find($id);

        return view('admin.product.product_profile', compact('product'));
    }



    public function sortProduct(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $product = Product::withCount([
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
        ])->with('case', 'brand', 'company')->orderBy('id', $sortFilter)->get();

        return response()->json($product);
    }
}
