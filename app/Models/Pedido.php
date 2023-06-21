<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'wish';
    protected $fillable = [
        'id', 'pizzas', 'client', 'note', 'edge','price'
    ];

    #um pedido tem varias pizzas
    #um cliente tem varios pedidos.

    public function pizzas(){

        return $this->hasMany(Pizzas::class, 'pizzas_id');

    }

    public function client(){

        return $this->belongsTo(Client::class, 'client_id');

    }





    use HasFactory;
}
