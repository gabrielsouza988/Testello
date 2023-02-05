<?php

namespace Tests\Feature;

use App\Http\Controllers\ShippingPricesController;
use App\Http\Requests\ShippingPricesRequest;
use App\Jobs\RegisterShippingTable;
use App\Models\Customer;
use App\Models\ShippingPrice;
use App\Services\CsvFileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShippingPricesControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    use DatabaseMigrations;

    public function test_register_with_valid_file_csv()
    {
        $this->runDatabaseMigrations();
        Storage::fake();

        $customer = Customer::factory()->create();
        $pathToFile = storage_path('app/public/price-table-teste.csv');
        $file = new UploadedFile($pathToFile, 'shipping_prices.csv', 'text/csv', null, true);

        $dataRequest = [
            'file_csv' => $file,
            'customer' => $customer->id
        ];

        $response = $this->post(route('register-tabela-frete'), $dataRequest);

        $response->assertRedirect(route('index'));
        $this->assertEquals(route('index'), $response->getTargetUrl());
        $this->assertEquals('Tabela de frete importada. Por favor, aguarde alguns instantes.', session('message'));
    }

    public function test_register_with_invalid_file_csv()
    {
        $this->runDatabaseMigrations();
        Storage::fake();

        $customer = Customer::factory()->create();
        $file = UploadedFile::fake()->create('file_csv.txt', 10);

        $dataRequest = [
            'file_csv' => $file,
            'customer' => $customer->id
        ];

        $response = $this->post(route('register-tabela-frete'), $dataRequest);

        $response->assertRedirect(route('index'));
        $this->assertEquals(route('index'), $response->getTargetUrl());
        $this->assertEquals('Arquivo inválido.', session('menssageError'));
    }
}

