<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingPricesRequest;
use App\Jobs\SendDataCsvToJobs;
use App\Models\Customer;
use App\Models\ShippingPrice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Support\Facades\{
    Crypt,
    DB
};
class CsvReadingController extends Controller
{
    public function index()
    {
        $data['customers'] = Customer::all();

        return view('shipping.register', $data);
    }

    public function detail(int $id)
    {
        $data['customer'] = Customer::find($id);
        dd(ShippingPrice::where('customer_id', $id)->get());
        $data['shippings'] = [];
        // $data['shippings'] = ShippingPrice::where('customer_id', $id)->get();

        // $data['shippings'] = Customer::find($id);

        return view('shipping.detail', $data);
    }

    public function reading(ShippingPricesRequest $request): RedirectResponse
    {
        $file = $request->file('file_csv');
        $customer = Customer::find($request->customer);

        if ($file->getClientOriginalExtension() != 'csv') {
            return redirect(route('index'))->with('errors', 'Arquivo invalido!');
        }

        if (!$customer) {
            return redirect(route('index'))->with('errors', 'cliente não existe!');
        }

        $filename = Hash::make($file->getClientOriginalName()).'.csv';
        Storage::disk('public')->putFileAs('csv', $file, $filename);

        $reader = Reader::createFromPath(storage_path().'/app/public/csv/'.$filename)
                                ->setDelimiter(';')
                                ->setHeaderOffset(0);
        
        $numberLines = count($reader);
        $offset = ($numberLines / 1000);
        for ($i=0; $i < $offset; $i++) {
            SendDataCsvToJobs::dispatch($customer->id, $filename, $i);
        }

        return redirect(route('index'))->with('message', 'Importada tabela de frete.');
    }
}
