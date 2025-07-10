<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Brand;
use App\Models\CaseManagement;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class InvoiceController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view invoices', only: ['invoiceIndex']),
            new Middleware('permission:create invoices', only: ['invoiceCreate']),
            new Middleware('permission:edit invoices', only: ['invoiceEdit']),
            new Middleware('permission:delete invoices', only: ['invoiceDestroy']),
        ];
    }

    public function invoiceIndex(){
        $invoices = Invoice::with('cases', 'company', 'brand', 'product')->orderBy('id', 'desc')->get();
        // dd($expenses);

        return view('admin.invoice.index', compact('invoices'));
    }


    public function invoiceCreate()
    {
        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $cases = CaseManagement::all();
        $currencies = Currency::all();


        return view('admin.invoice.create', compact('companies', 'brands', 'products', 'cases', 'currencies'));
    }


    public function invoiceStore(InvoiceRequest $request)
    {
        // dd('ok');
        $data = $request->validated();
        Invoice::create($data);

        return to_route('invoice.index')->with('success', 'Invoice Added Successfully');
    }


    public function invoiceEdit($id)
    {
        $invoice = Invoice::where('id', $id)->first();

       $companies = Company::all();
        // $brands = Brand::all();
        // $products = Product::all();
        $cases = CaseManagement::all();
        $currencies = Currency::all();

        $brands = Brand::where('company_id', $invoice->company_id)->get();
        // dd($invoice);
        $products = Product::where('company_id', $invoice->company_id)->get();

        return view('admin.invoice.edit', compact('invoice', 'companies', 'brands', 'products', 'cases', 'currencies'));
    }


    public function invoiceShow($id)
    {
        // $expense = Expenses::where('id', $id)->first();
        $invoice = Invoice::with('cases', 'company', 'brand', 'product', 'user')->where('id', $id)->first();


       $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $cases = CaseManagement::all();
        $currencies = Currency::all();

        return view('admin.invoice.view', compact('invoice', 'companies', 'brands', 'products', 'cases', 'currencies'));
    }


    public function invoiceUpdate(InvoiceRequest $request, $id)
    {
        $invoices = $request->validated();
        Invoice::where('id', $id)->update($invoices);

        return to_route('invoice.index')->with('success', 'Invoice Updated Successfully');
    }



    public function invoiceDestroy($id)
    {
        $invoice = Invoice::find($id);
        $invoice->delete();
        return to_route('invoice.index')->with('success', 'Invoice Deleted Successfully');
    }



    public function sortInvoice(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $invoices = Invoice::with('cases', 'company', 'brand', 'product')->orderBy('id', $sortFilter)->get();

        return response()->json($invoices);
    }


    public function getAutoIdData($id)
    {
        $company = Company::find($id);
        // dd($user);
        if ($company) {
            return response()->json([
                'auto_id' => $company->auto_id,
            ]);
        } else {
            return response()->json([
                'auto_id' => '',
            ]);
        }
    }
}
