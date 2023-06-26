<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pedido;
use App\Models\Pizzas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    protected $pizzas;
    protected $client;

    protected $pedido;

    public function __construct(Pizzas $pizzas, Client $client, Pedido $pedido)
    {
        $this->pizzas = $pizzas;
        $this->client = $client;
        $this->pedido = $pedido;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->pedido->all();
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
        $client = $this->client->all();


        $lista = array();
        $ref = $this->pizzas->all();
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


        $validator = Validator::make($data,[
            'client' => ['required', 'string', 'max:100'],
            'pizzas' => ['required'],
            'price' => ['required', 'string'],
         ]);

         if($validator->fails()){
            return redirect()->route('pedido.create')
                            ->withErrors($validator)
                            ->withInput();
        }


        $pedido = new Pedido;
        $pedido->client_id = $data['client'];
        $pedido->pizzas = implode($data['pizzas']);
        $pedido->price = $data['price'];
        $pedido->note = $data['note'];
        if($data['borda'] === 'op2'){
            $pedido->edge = true;
        }
        else{
            $pedido->edge = false;
        }
        $pedido->save();
        ##dd(json_encode($a));

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
