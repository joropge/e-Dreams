<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Direccion;
use App\Models\Producto;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'direccion_id',
        'producto_id',
        // 'pedido_id',
        'estado',
        'total',
    ];

    public function User ()
    {
        return $this->belongsTo(User::class);
    }

    public function Direccion ()
    {
        return $this->belongsTo(Direccion::class);
    }

    public function Producto ()
    {
        return $this->belongsToMany(Producto::class, 'producto_pedido');
    }

    //relacion con carrito de compras
    // public function Pedido ()
    // {
    //     return $this->belongsTo(Pedido::class);
    // }
}
