<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Pedido;
use App\Models\Direccion;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        // User::deleting(function ($user) {
            
        //     Pedido::where('user_id', $user->id)->delete();
            
        //     Direccion::where('user_id', $user->id)->delete();
        // });
    }
}
