<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Policies\EntidadPolicy;
use App\Policies\ProvinciaPolicy;
use App\Policies\UserPolicy;
use App\Policies\TrazaPolicy;
use App\Policies\BateriaPolicy;
use App\Policies\CentralElectricaPolicy;
use App\Policies\CoberturaCombustiblePolicy;
use App\Policies\DatosGeneralesPolicy;
use App\Policies\DisponibilidadPolicy;
use App\Policies\EventoDiarioPolicy;
use App\Policies\GeneracionPolicy;
use App\Policies\GruposPolicy;
use App\Policies\HechosExtraordinariosPolicy;
use App\Policies\MantenedorExternoPolicy;
use App\Policies\OperadorPolicy;
use App\Policies\PailasPolicy;
use App\Policies\PlanesPolicy;
use App\Policies\ProveedorPolicy;
use App\Policies\MantenimientoPolicy;
use App\Policies\BrigadaPolicy;
use App\Entidad;
use App\Provincia;
use App\User;
use App\Traza;
use App\Baterias;
use App\CentralElectrica;
use App\CoberturaCombustible;
use App\DatosGenerales;
use App\Disponibilidad;
use App\EventoDiario;
use App\Generacion;
use App\Grupos;
use App\HechosExtraordinarios;
use App\MantenedorExterno;
use App\Operador;
use App\Pailas;
use App\Planes;
use App\Proveedor;
use App\Mantenimiento;
use App\Brigada;

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
        'App\Baterias' => 'App\Policies\BateriaPolicy',
        'App\CentralElectrica' => 'App\Policies\CentralElectricaPolicy',
        'App\CoberturaCombustible' => 'App\Policies\CoberturaCombustiblePolicy',
        'App\DatosGenerales' => 'App\Policies\DatosGeneralesPolicy',
        'App\Disponibilidad' => 'App\Policies\DisponibilidadPolicy',
        'App\EventoDiario' => 'App\Policies\EventoDiarioPolicy',
        'App\Generacion' => 'App\Policies\GeneracionPolicy',
        'App\Grupos' => 'App\Policies\GruposPolicy',
        'App\HechosExtraordinarios' => 'App\Policies\HechosExtraordinariosPolicy',
        'App\MantenedorExterno' => 'App\Policies\MantenedorExternoPolicy',
        'App\Operador' => 'App\Policies\OperadorPolicy',
        'App\Pailas' => 'App\Policies\PailasPolicy',
        'App\Planes' => 'App\Policies\PlanesPolicy',
        'App\Proveedor' => 'App\Policies\ProveedorPolicy',
        'App\Mantenimiento' => 'App\Policies\MantenimientoPolicy',
        'App\Brigada' => 'App\Policies\BrigadaPolicy',
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
