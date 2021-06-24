<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Producto' => 'App\Policies\ProductoPolicy',
        'App\Models\Usuario' => 'App\Policies\UsuariosPolicy',
        'App\Models\Categoria' => 'App\Policies\CategoriaPolicy',
        'App\Models\Compra' => 'App\Policies\ComprasPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
