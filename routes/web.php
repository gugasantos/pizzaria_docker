<?php

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\pedidoController;
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

##Route::get('/', function () {
##  return redirect()->route('pedido');
##});

Route::resource('cardapio',CardapioController::class);
Route::resource('client',ClientController::class);


