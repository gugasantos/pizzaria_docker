<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Pedido;
use App\Models\Pizzas;
use App\Models\PizzasPedido;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class gerapdfController extends Controller
{
    public function __invoke(Request $request, string $id)
    {
        $data = Pedido::find($id);
        $data2 = Client::find($data->client_id);
        $data3 = pizzasPedido::find($data->pizzas_pedido_id);

        $pizzaname = ( str_replace(',',' ', $data3->namePizzas ));

        $pdf = Pdf::loadView('actions.pdf',[
                'pedido' => $data,
                'cliente' => $data2,
                'pizzasPedido' => $pizzaname,
            ]);

        return $pdf->setPaper('a7')->stream('PedidoDoCliente');
    }
}
