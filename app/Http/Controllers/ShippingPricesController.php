<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShippingPricesRequest;
use App\Jobs\RegisterDataShippingTable;
use App\Jobs\UpdateDataShippingTable;
use App\Models\Customer;
use App\Models\ShippingPrice;
use App\Services\CsvFileService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ShippingPricesController extends Controller
{
    private $csvFileService;

    public function __construct(CsvFileService $csvFileService)
    {
        $this->csvFileService = $csvFileService;
    }

    public function index(): View
    {
        $data['customers'] = Customer::all();

        return view('shipping.register', $data);
    }

    public function detail(int $id): View
    {
        $data['customer'] = Customer::find($id);
        $data['shippings'] = ShippingPrice::where('customer_id', $id)
            ->orderBy('from_postcode', 'asc')
            ->paginate(15);

        return view('shipping.detail', $data);
    }

    public function register(ShippingPricesRequest $request): RedirectResponse
    {
        $file = $request->file('file_csv');
        $customer = Customer::find($request->customer);

        $validation = $this->validateFile($file, 'csv', $customer);
        if ($validation['error']) {
            return redirect(route('index'))
                ->with('errors', $validation['message']);
        }

        $fileData = $this->csvFileService->saveFile('csv', $file);
        for ($i=0; $i < $fileData['offset']; $i++) {
            RegisterDataShippingTable::dispatch($fileData['filename'], ShippingPrice::ALLOWED_FILE_TYPE, $customer->id, $i);
        }

        return redirect(route('index'))
            ->with('message', 'Importada tabela de frete.');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $file = $request->file('file_csv');
        $customer = Customer::find($id);

        $validation = $this->validateFile($file, ShippingPrice::ALLOWED_FILE_TYPE, $customer);
        if ($validation['error']) {
            return redirect(route('index'))
                ->with('errors', $validation['message']);
        }

        $fileData = $this->csvFileService->saveFile(ShippingPrice::ALLOWED_FILE_TYPE, $file);
        for ($i = 0; $i < $fileData['offset']; $i++) {
            UpdateDataShippingTable::dispatch($fileData['filename'], ShippingPrice::ALLOWED_FILE_TYPE, $customer->id, $i);
        }

        return redirect(route('detail', $id))
            ->with('message', 'Importada tabela de frete.');
    }

    private function validateFile(UploadedFile $file, string $fileAllowed, Customer $customer = null): array
    {
        if (!$customer) {
            return [
                'error' => true,
                'message' => 'Cliente não existe.'
            ];
        }

        if ($file->getClientOriginalExtension() != $fileAllowed) {
            return [
                'error' => true,
                'message' => 'Arquivo inválido.'
            ];
        }

        return ['error' => false];
    }
}
