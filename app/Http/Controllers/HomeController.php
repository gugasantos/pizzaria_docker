<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pedido;
use App\Models\Pizzas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizza = Pizzas::all();
        $cliente = Client::all();
        $pedido = Pedido::all();

        $price = array();
        foreach($pedido as $p){
            array_push($price, $p->price);
        }

        return view('actions.home',[
            'pizzas' => $pizza->count(),
            'clientes' => $cliente->count(),
            'pedidos' => $pedido->count(),
            'price' => array_sum($price)

        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
