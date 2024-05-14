<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Direccion extends Model
{
    public $table = 'direcciones';
    use HasFactory;

    protected $fillable = [
        'user_id',
        'calle',
        'numero',
        'piso',
        'puerta',
        'codigo_postal',
        'ciudad',
        'provincia',
        'pais',
    ];

    public function User ()
    {
        return $this->belongsTo(User::class);
    }

    public function Pedido ()
    {
        return $this->hasMany(Pedido::class);
    }

}
