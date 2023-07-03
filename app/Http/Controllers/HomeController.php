<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pedido;
use App\Models\Pizzas;
use App\Models\PizzasPedido;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $day = $request->interval ? $request->interval:30;
        $interval = intval($request->input('interval',30));
        $datelimit = date('Y-m-d H:i:s', strtotime('-'.$interval. 'days'));

        $pizza = Pizzas::all();
        $cliente = Client::all();
        $pedido = Pedido::all();

        $price = array();

        $lucrocount = (pedido::all()->where('created_at','>=',$datelimit));
        foreach($lucrocount as $p){
            array_push($price, $p->price);
        }

        $pagePie = [];
        $pizzascount = PizzasPedido::selectRaw('pizzas_pedido_id, count(pizzas_pedido_id) as p')->groupBy('pizzas_pedido_id')->get();
        foreach($pizzascount as $pizzacount){
            $pagePie[ $pizzacount['pizzas_pedido_id']] = intval($pizzacount['p']);

        };

        $pageLabels = json_encode( array_keys($pagePie));
        $pageValues = json_encode( array_values($pagePie));

        return view('actions.home',[
            'pizzas' => $pizza->count(),
            'clientes' => $cliente->count(),
            'pedidos' => $pedido->where('created_at','>=',$datelimit)->count(),
            'price' => array_sum($price),
            'pageLabels' =>  $pageLabels,
            'pageValues' =>  $pageValues,
            'dataInterval' => $interval,
            'days' => $day

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
