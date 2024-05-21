<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;


class FrontController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        // return view('productos.front.index', compact('productos'));
        return view('dashboard', compact('productos'));
    }
}
