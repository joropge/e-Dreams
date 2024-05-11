<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pedido_id',
        'metodo_pago',
        'total',
        'numero_tarjeta',
        'nombre_tarjeta',
        'fecha_caducidad',
        'codigo_seguridad',
        'estado',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
