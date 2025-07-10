<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequest;
use App\Models\Brand;
use App\Models\CaseManagement;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Expenses;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;

class ExpensesController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view profit & expences', only: ['expencesIndex']),
            new Middleware('permission:create profit & expences', only: ['expencesCreate']),
            new Middleware('permission:edit profit & expences', only: ['expencesEdit']),
            new Middleware('permission:delete profit & expences', only: ['expencesDestroy']),
        ];
    }

    public function expensesIndex(){
        $expenses = Expenses::with('cases', 'company', 'brand', 'product')->orderBy('id', 'desc')->get();
        // dd($expenses);

        return view('admin.expenses.index', compact('expenses'));
    }


    public function expensesCreate()
    {
        $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $cases = CaseManagement::all();
        $currencies = Currency::all();


        return view('admin.expenses.create', compact('companies', 'brands', 'products', 'cases', 'currencies'));
    }


    public function expensesStore(ExpensesRequest $request)
    {
        $data = $request->validated();
        Expenses::create($data);

        return to_route('expenses.index')->with('success', 'Expenses Added Successfully');
    }


    public function expensesEdit($id)
    {
        $expense = Expenses::where('id', $id)->first();

       $companies = Company::all();
        // $brands = Brand::all();
        // $products = Product::all();
        $cases = CaseManagement::all();
        $currencies = Currency::all();

        $brands = Brand::where('company_id', $expense->company_id)->get();
        $products = Product::where('company_id', $expense->company_id)->get();

        return view('admin.expenses.edit', compact('expense', 'companies', 'brands', 'products', 'cases', 'currencies'));
    }


    public function expensesShow($id)
    {
        // $expense = Expenses::where('id', $id)->first();
        $expense = Expenses::with('cases', 'company', 'brand', 'product', 'user')->where('id', $id)->first();
            // dd($expense->company->user->name);
       $companies = Company::all();
        $brands = Brand::all();
        $products = Product::all();
        $cases = CaseManagement::all();
        $currencies = Currency::all();

        return view('admin.expenses.view', compact('expense', 'companies', 'brands', 'products', 'cases', 'currencies'));
    }


    public function expensesUpdate(ExpensesRequest $request, $id)
    {
        $expenses = $request->validated();
        Expenses::where('id', $id)->update($expenses);

        return to_route('expenses.index')->with('success', 'Expenses Updated Successfully');
    }



    public function expensesDestroy($id)
    {
        $expenses = Expenses::find($id);
        $expenses->delete();
        return to_route('expenses.index')->with('success', 'Expenses Deleted Successfully');
    }



    public function sortExpenses(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $expenses = Expenses::with('cases', 'company', 'brand', 'product')->orderBy('id', $sortFilter)->get();

        return response()->json($expenses);
    }

    public function updateStatus(Request $request, $id)
    {
        $expenses = Expenses::findOrFail($id);

        $newStatus = $request->desbursement === 'Active' ? 'Inactive' : 'Active';
        $expenses->desbursement = $newStatus;
        $expenses->save();

        return response()->json(['desbursement' => $newStatus]);
    }
}
