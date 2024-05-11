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
        return $this->belongsTo(Categoria::class);
    }

    public function carritos()
    {
        return $this->belongsToMany(Carrito::class);
    }
}
