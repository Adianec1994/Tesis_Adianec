<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Policies\EntidadPolicy;
use App\Policies\ProvinciaPolicy;
use App\Entidad;
use App\Provincia;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        // Entidad::class => EntidadPolicy::class,
        'App\Entidad' => 'App\Policies\EntidadPolicy',
        'App\Provincia' => 'App\Policies\ProvinciaPolicy',
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
