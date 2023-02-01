<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CsvReadingController extends Controller
{
    public function reading(Request $request)
    {
        $file = $request->file('file_csv');
        // $customer = Customer::find($request->customerId);

        // if ($customer) {
            $handle = fopen(asset("storage/price-table.csv"), "r");
            // $handle = fopen(asset("/storage/price-table.csv"), "r");

            dd(fgetcsv($handle, 1000, ","));
        // }
    }
}
