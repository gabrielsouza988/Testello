<?php

use App\Http\Controllers\ShippingPricesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [ShippingPricesController::class, 'index'])->name('index');
Route::get('/detalhes/{id}', [ShippingPricesController::class, 'detail'])->name('detail');
Route::post('/cadastrar-tabela-frete', [ShippingPricesController::class, 'register'])->name('register-tabela-frete');
Route::patch('/atualizar-tabela-frete/{id}', [ShippingPricesController::class, 'update'])->name('update-tabela-frete');
