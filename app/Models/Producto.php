<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria_id',
        'imagen',
        'imagen2',
        'imagen3',
        'imagen4',
        'imagen5',
        'talla',
        'color',
    ];

    public function categoria()
    {
        //relacion uno a uno
        return $this->belongsTo(Categoria::class);
    }

    public function pedidos()
    {
        //relacion muchos a muchos
        return $this->belongsToMany(Pedido::class);
    }
}