<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizzas extends Model
{
    protected $table = 'menu';
    protected $fillable = [
        'id', 'name', 'description','price'
    ];

    #um pedido tem varias pizzas.

    public function pedido(){

        return $this->belongsTo(Pizzas::class, 'pizzas_id');

    }

    public $timestamps = false;
    use HasFactory;
}
