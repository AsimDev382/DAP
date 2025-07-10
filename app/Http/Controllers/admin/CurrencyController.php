<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;


class CurrencyController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view currency', only: ['currencyIndex']),
            new Middleware('permission:create currency', only: ['currencyCreate']),
            new Middleware('permission:edit currency', only: ['currencyEdit']),
            new Middleware('permission:delete currency', only: ['currencyDestroy']),
        ];
    }

    public function currencyIndex(){
        $currencies = Currency::orderBy('id', 'desc')->get();

        return view('admin.currency.index', compact('currencies'));
    }


    public function currencyCreate()
    {
        $countries = json_decode(file_get_contents(storage_path('app/countries.json')), true);
        $currencies = json_decode(file_get_contents(storage_path('app/currencies.json')), true);


        return view('admin.currency.create', compact('countries', 'currencies'));
    }


    public function currencyStore(CurrencyRequest $request)
    {
        $currency = $request->only((new Currency)->getFillable());
        // dd($currency);
            if ($request->hasFile('symbol')) {
                $image = $request->file('symbol');
                $filename = date('dmy') . '_symbol_' . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('CurrencySymbol', $filename, 'public');
                $currency['symbol'] = $path;
            }
            Currency::create($currency);

        return to_route('currency.index')->with('success', 'Currency Added Successfully');
    }


    public function currencyEdit($id)
    {
        $currn = Currency::where('id', $id)->first();

        $countries = json_decode(file_get_contents(storage_path('app/countries.json')), true);
        $currencies = json_decode(file_get_contents(storage_path('app/currencies.json')), true);
        // dd($currency->symbol);

        return view('admin.currency.edit', compact('currn', 'currencies', 'countries'));
    }


    public function currencyUpdate(CurrencyRequest $request, $id)
    {
        $currency = $request->only((new Currency)->getFillable());
        // dd($currency);
            if ($request->hasFile('symbol')) {
                $image = $request->file('symbol');
                $filename = date('dmy') . '_symbol_' . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('CurrencySymbol', $filename, 'public');
                $currency['symbol'] = $path;
            }
            Currency::where('id', $id)->update($currency);

        return to_route('currency.index')->with('success', 'Currency Updated Successfully');
    }



    public function currencyDestroy($id)
    {
        $raid = Currency::find($id);
        $raid->delete();
        return to_route('currency.index')->with('success', 'Currency Deleted Successfully');
    }



    public function sortCurrency(Request $request)
    {
        $sortFilter = $request->get('sortFilter');
        $currency = Currency::orderBy('id', $sortFilter)->get();

        return response()->json($currency);
    }

    public function updateStatus(Request $request, $id)
    {
        $company = Currency::findOrFail($id);

        $newStatus = $request->status === 'Active' ? 'Inactive' : 'Active';
        $company->status = $newStatus;
        $company->save();

        return response()->json(['status' => $newStatus]);
    }
}
