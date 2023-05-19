<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pedido;
use App\Models\Pizzas;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pedido::all();
        //dd(Pedido::select('fineshed'));

        return view('actions.pedido',[
            'pedidos' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $client = Client::all();

        $lista = array();
        $ref = Pizzas::all();
        foreach($ref as $r){
            array_push($lista,$r->name);
        }
        sort($lista);
        return view('actions.createPedido',[
            'lista' => $lista,
            'client' => $client
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->only([
            'client',
            'note',
            'pizzas',
            'price',
            'borda',


        ]);

        $idClient = Client::where('name', $data['client'])->first();
        $idpizza = Pizzas::where('name', $data['pizzas'])->first();

        $pedido = new Pedido;
        $pedido->client = $idClient->id;
        ##AS PIZZAS FORAM COLOCADAS COMO INTEGER POR SEREM FK TENHO QUE ACHAR UM JEITO DE ELAS MSM SENDO ARRAY IREM DE FORMA A CONTINUAR SENDO CONTABILIZADAS E NO FUTURO IR PRO DASHBOARD
        $pedido->pizzas = implode(',',$data['pizzas']);
        $pedido->note = $data['note'];
        $pedido->price = $data['price'];

        if($data['borda'] === 'op2'){
            $pedido->edge = 1;
        }
        $pedido->save();

        return redirect()->route('pedido.index');
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
