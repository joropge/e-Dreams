<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Producto;

class Carrito extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pedido_id',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function productos()
    // {
    //     return $this->belongsToMany(Producto::class, 'producto_carrito');
    // }

    //relacion uno amuchos con pedido
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
