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
        //dd(Pedido::select('finalizado'));
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
        $pizzas = $this->pizzas->all();


        $lista = $this->pizzas->all();

        return view('actions.createPedido',[
            'lista' => $lista,
            'client' => $client,
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
            'borda',
        ]);


        $validator = Validator::make($data,[
            'client' => ['required', 'string', 'max:100'],
            'pizzas' => ['required'],
         ]);

         if($validator->fails()){
            return redirect()->route('pedido.create')
                            ->withErrors($validator)
                            ->withInput();
        }

        $pizzas = new Pizzas;
        $pizzasPedido = new PizzasPedido;

        #inclui os id das pizzas na tabela pizzas_pedido coluna pizzas_pedido_id
        $pizzasPedido->pizzas_pedido_id = implode(',',$data['pizzas']);


        $namePizza = array();
        $valuePizza = array();


        foreach ($data['pizzas'] as $p){
            array_push($namePizza, $pizzas->find($p)->name);
            array_push($valuePizza, $pizzas->find($p)->price);
        };

        #inclui os nomes das pizzas na tabela pizzas_pedido coluna namePizzas
        $pizzasPedido->namePizzas = implode(',',$namePizza);

        $pizzasPedido->save();


        $pedido = new Pedido;
        $pedido->client_id = $data['client'];
        #inclui o id da tabela pizza_pedido na tabela wish na coluna pizzas_id
        $pedido->pizzas_id = $pizzasPedido->id;
        $pedido->note = $data['note'];


        if($data['borda'] === 'op2'){
            $pedido->edge = true;

            #valor da borda
            array_push($valuePizza, '2');
        }
        else{
            $pedido->edge = false;
        }

        $pedido->price = array_sum($valuePizza);
        $pedido->finalizado = true;

        $cliente = Client::find($data['client']);

        $cliente->increment('numberOfOrders');

        $pedido->save();


        return redirect()->route('pedido.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Pedido::find($id);

        $data->finalizado = false;

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

        $lista = $this->pizzas->all();

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
                ]);
            if($validator->fails()){
                return redirect()->route('pedido.edit')
                                ->withErrors($validator)
                                ->withInput();
            }
        }


        $pizzas = new Pizzas;
        $pizzasPedido = PizzasPedido::find($pedido->pizzas_id);

        #inclui os id das pizzas na tabela pizzas_pedido coluna pizzas_pedido_id
        $pizzasPedido->pizzas_pedido_id = implode(',',$data['pizzas']);


        $namePizza = array();
        $valuePizza = array();


        foreach ($data['pizzas'] as $p){
            array_push($namePizza, $pizzas->find($p)->name);
            array_push($valuePizza, $pizzas->find($p)->price);
        };

        #inclui os nomes das pizzas na tabela pizzas_pedido coluna namePizzas
        $pizzasPedido->namePizzas = implode(',',$namePizza);
        $pizzasPedido->update();


        $pedido->client_id = $data['client'];
        #inclui o id da tabela pizza_pedido na tabela wish na coluna pizzas_id
        $pedido->pizzas_id = $pizzasPedido->id;
        $pedido->note = $data['note'];

        if($data['borda'] === 'op2'){
            $pedido->edge = true;

            #valor da borda
            array_push($valuePizza, "2");
        }
        else{
            $pedido->edge = false;
        }

        $pedido->price = array_sum($valuePizza);

        $pedido->update();


        return redirect()->route('pedido.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Pedido::find($id);
        $data2 = PizzasPedido::find($data->pizzas_id);

        $data->delete();
        $data2->delete();

        return redirect()->route('pedido.index');
    }
}
