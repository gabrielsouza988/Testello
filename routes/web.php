<?php

use App\Http\Controllers\CsvReadingController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [CsvReadingController::class, 'index'])->name('index');
Route::get('/detalhes/{id}', [CsvReadingController::class, 'detail'])->name('detail');
Route::post('/cadastrar-tabela-frete', [CsvReadingController::class, 'reading'])->name('register-tabela-frete');