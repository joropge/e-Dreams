<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Direccion;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'calle' => ['required', 'string', 'max:255'],
            'numero' => ['required', 'string', 'max:255'],
            'piso' => ['nullable', 'string', 'max:255'],
            'puerta' => ['nullable', 'string', 'max:255'],
            'codigo_postal' => ['required', 'string', 'max:255'],
            'ciudad' => ['required', 'string', 'max:255'],
            'provincia' => ['required', 'string', 'max:255'],
            'pais' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'apellidos' => $request->apellidos,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Direccion::create([
            'user_id' => $user->id,
            'calle' => $request->calle,
            'numero' => $request->numero,
            'piso' => $request->piso,
            'puerta' => $request->puerta,
            'codigo_postal' => $request->codigo_postal,
            'ciudad' => $request->ciudad,
            'provincia' => $request->provincia,
            'pais' => $request->pais,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
