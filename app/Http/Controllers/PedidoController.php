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


        ]);
        $validator = Validator::make($data,[
            'client' => ['required', 'string', 'max:100'],
            'note' => ['required', 'string', 'max:100'],
            'pizzas' => ['required', 'string', 'max:100'],
            'price' => ['required', 'string'],
         ]);


        if($validator->fails()){
            return redirect()->route('pedido.create')
                            ->withErrors($validator)
                            ->withInput();
        }

        $pedido = new Pedido;
        $pedido->name = $data['client'];
        $pedido->pizza = $data['pizzas'];
        $pedido->description = $data['note'];
        $pedido->price = $data['price'];

        if($data['borda'] === 'op2'){
            $pedido->borda = 1;
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
