<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzasPedido extends Model
{
    protected $table = 'pizzas_pedido';

    protected $fillable = [
        'id', 'pizzas_pedido_id','namePizzas'
    ];

    #um pedido tem varias pizzas.

    public function pedido(){

        return $this->belongsTo(Pizzas::class, 'pizzas_pedido_id');

    }
    use HasFactory;
}
