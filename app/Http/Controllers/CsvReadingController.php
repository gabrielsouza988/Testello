<?php

namespace App\Http\Controllers;

// use App\Models\Customer;
use Illuminate\Http\Request;

class CsvReadingController extends Controller
{
    public function reading(Request $request)
    {
        return view('Freight.register');
        // $file = $request->file('file_csv');
        // $customer = Customer::find($request->customerId);

        // if ($customer) {
            $file = fopen('C:\xampp\htdocs\Testello\public\storage\price-table.csv', "r");
        // $file = fopen(asset("/storage/price-table.csv"), "r");

            $row = 0;
            $freight = [];
            while ($line = fgetcsv($file, 1000, ";")) {
                if ($row++ == 0) {
                    continue;
                }

                $freight[] = [
                    'from_postcode' => $line[0],
                    'to_postcode' => $line[1],
                    'from_weight' => $line[2],
                    'to_weight' => $line[3],
                    'cost' => $line[4]
                ];
            }
            dd($freight[0]);
            fclose($file);
            // dd(fgetcsv($handle, 1000000, ";"));
        // }
    }
}
