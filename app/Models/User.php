<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // public function Pagos ()
    // {
    //     return $this->hasMany(Pago::class);
    // }

    public function Carritos ()
    {
        //relacion uno a uno
        return $this->hasOne(Carrito::class);
    }

    public function Direcciones ()
    {
        //
        return $this->hasOne(Direccion::class);
    }

    public function Pedidos ()
    {
        //relacion uno a muchos
        return $this->hasMany(Pedido::class);
    }

}
