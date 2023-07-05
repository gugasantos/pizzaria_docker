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
        $pizzascount = PizzasPedido::all()->where('created_at','>=',$datelimit);

        foreach($pizzascount as $pizzacount){
            $p = ($pizzacount->namePizzas);

            if(strlen($p) == 1){
                array_push($pagePie,$pizzacount['namePizzas']);
            }
            else{
                $pizzasc = explode(',',$pizzacount['namePizzas']);
                foreach($pizzasc as $c){
                    array_push($pagePie,$c);
                }
            }
        };

        $pagePie = array_count_values($pagePie);


        $pageLabels = json_encode( array_keys($pagePie));
        $pageValues = json_encode( array_values($pagePie));


        $pageBar = [];
        $clientesCount = Client::orderBy('numberOfOrders','desc')->limit(5)->get();

        foreach($clientesCount as $c){
            $pageBar[$c->name] = $c->numberOfOrders;
        };

        $pageBarLabels = json_encode( array_keys($pageBar));
        $pageBarValues = json_encode( array_values($pageBar));

        return view('actions.home',[
            'pizzas' => $pizza->count(),
            'clientes' => $cliente->count(),
            'pedidos' => $pedido->where('created_at','>=',$datelimit)->count(),
            'price' => array_sum($price),
            'pageLabels' =>  $pageLabels,
            'pageValues' =>  $pageValues,
            'pageBarLabels'=> $pageBarLabels,
            'pageBarValues'=> $pageBarValues,
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
