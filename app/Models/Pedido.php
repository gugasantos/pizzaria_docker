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

    
    use HasFactory;
}
