<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'pizzas';
    protected $fillable = [
        'id', 'name', 'address', 'phoneNumber', 'numberOfOrders'
    ];
    public $timestamps = false;
    use HasFactory;
}
