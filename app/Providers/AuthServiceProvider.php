<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Policies\EntidadPolicy;
use App\Policies\ProvinciaPolicy;
use App\Policies\UserPolicy;
use App\Policies\TrazaPolicy;
use App\Entidad;
use App\Provincia;
use App\User;
use App\Traza;

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
        'App\User' => 'App\Policies\UserPolicy',
        'App\Traza' => 'App\Policies\TrazaPolicy',
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
