<?php

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\gerapdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return redirect()->route('pedido.index');
});

Route::resource('cardapio',CardapioController::class);
Route::resource('client',ClientController::class);
Route::resource('pedido',PedidoController::class);
Route::resource('dashboard',HomeController::class);
Route::get('gerapdf/{id}',gerapdfController::class)->name('gerapdf');



