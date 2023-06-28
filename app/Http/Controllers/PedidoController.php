<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pedido;
use App\Models\Pizzas;
use App\Models\PizzasPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    protected $pizzas;
    protected $client;

    protected $pizzas_pedido;

    protected $pedido;

    public function __construct(Pizzas $pizzas, Client $client, PizzasPedido $pizzasPedido ,Pedido $pedido)
    {
        $this->pizzas = $pizzas;
        $this->client = $client;
        $this->pizzas_pedido = $pizzasPedido;
        $this->pedido = $pedido;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->pedido->all();
        $data2 = $this->client->all();
        $data3 = $this->pizzas_pedido->all();
        //dd(Pedido::select('fineshed'));
        return view('actions.pedido',[
            'pedidos' => $data,
            'cliente' => $data2,
            'pizzasPedido' => $data3
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


        $pizzasPedido = new PizzasPedido;
        $pizzasPedido->pizzas_pedido_id = implode(',',$data['pizzas']);
        $pizzasPedido->save();

        $pedido = new Pedido;
        $pedido->client_id = $data['client'];
        $pedido->pizzas_id = $pizzasPedido->id;
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
        $data = Pedido::find($id);

        $data->fineshed = 1;
        $data->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Pedido::find($id);
        $client = $this->client->all();
        $lista = array();
        $ref = $this->pizzas->all();
        foreach($ref as $r){
            array_push($lista,$r->name);
        }
        sort($lista);

        if($data){
            return view('actions.editPedido',[
                'pedido' => $data,
                'client' => $client,
                'lista' => $lista
            ]);
        }
        return redirect()->route('index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pedido = Pedido::find($id);

        if($pedido){
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
                return redirect()->route('pedido.edit')
                                ->withErrors($validator)
                                ->withInput();
            }
        }

        $pedido->client_id = $data['client'];
        $pedido->pizzas = implode(",",$data['pizzas']);
        $pedido->price = $data['price'];
        $pedido->note = $data['note'];
        if($data['borda'] === 'op2'){
            $pedido->edge = true;
        }
        else{
            $pedido->edge = false;
        }
        $pedido->update();

        return redirect()->route('pedido.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pedido::find($id);
        $data->delete();

        return redirect()->route('pedido.index');
    }
}
