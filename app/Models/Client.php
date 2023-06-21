<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client';
    protected $fillable = [
        'id', 'name', 'address', 'phoneNumber', 'numberOfOrders'
    ];

    #um cliente tem varios pedidos.

    public function Pedidos(){

        return $this->hasMany(Pedido::class, 'client_id');

    }
    public $timestamps = false;
    use HasFactory;
}
