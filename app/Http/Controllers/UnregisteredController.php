<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnregisteredController extends Controller
{
    public function unregistered()
    {
        return redirect('/dashboard');
    }
}
