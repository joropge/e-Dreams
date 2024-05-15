<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnregisteredController extends Controller
{
    public function unregistered()
    {
        // Aquí puedes agregar cualquier lógica necesaria antes de redirigir al dashboard
        // Por ejemplo, si necesitas crear un usuario temporal, hacer alguna acción especial, etc.

        // Redirige al dashboard
        return redirect('/dashboard');
    }
}
