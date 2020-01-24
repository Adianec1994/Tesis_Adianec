<?php

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\Entidad;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api', 'trazas']], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::get('permissions', 'API\SendPermissions');
    Route::get('nav', 'NavMenu');

    Route::patch('settings/profile', 'Settings\UpdateProfile');
    Route::patch('settings/password', 'Settings\UpdatePassword');

    Route::get('permisos', 'API\RolAPIController@indexPermissions');

    Route::apiResources([
        'proveedores' => 'API\ProveedorAPIController',
        'provincias' => 'API\ProvinciaAPIController',
        'disponibilidades' => 'API\DisponibilidadAPIController',
        'entidades' => 'API\EntidadAPIController',
        'hechos_extraordinarios' => 'API\HechosExtraordinariosAPIController',
        'planes' => 'API\PlanesAPIController',
        'centrales_electricas' => 'API\CentralElectricaAPIController',
        'baterias' => 'API\BateriasAPIController',
        'coberturas_combustibles' => 'API\CoberturaCombustibleAPIController',
        'datos_generales' => 'API\DatosGeneralesAPIController',
        'operadores' => 'API\OperadorAPIController',
        'pailas' => 'API\PailasAPIController',
        'grupos' => 'API\GruposAPIController',
        'eventos_diarios' => 'API\EventoDiarioAPIController',
        'generaciones' => 'API\GeneracionAPIController',
        'mantenedores_externos' => 'API\MantenedorExternoAPIController',
        'usuarios' => 'API\UserAPIController',
        'roles' => 'API\RolAPIController',
        'trazas' => 'API\TrazaAPIController',
        'mantenimientos' => 'API\MantenimientosAPIController',
        'brigadas' => 'API\BrigadasAPIController'
    ]);
    Route::get('snapshots', 'API\SnapshotsAPIController@view');
    Route::post('snapshots/{name}', 'API\SnapshotsAPIController@restore');
    Route::post('snapshots', 'API\SnapshotsAPIController@create');
    Route::delete('snapshots/{name}', 'API\SnapshotsAPIController@destroy');
    // Route::get('reportes/5', 'API\ReportesAPIController@disponibilidad');
    // Route::get('reportes/8', 'API\ReportesAPIController@existenciaLubricante');
    // Route::get('reportes/9', 'API\ReportesAPIController@existenciaRefrigerante');

    Route::prefix('reportes')->group(function () {
        Route::get('{reporte}', 'API\ReportesAPIController@render')->name('reporte.render');
        Route::get('{reporte}/download', 'API\ReportesAPIController@exportExcel')->name('reporte.export');
        Route::get('{reporte}/downloadPDF', 'API\ReportesAPIController@exportPDF')->name('reporte.export');
    });
});


Route::group(['middleware' => ['guest:api', 'trazas']], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('rol', function () {
        return Role::select('id', 'name')->get();
    });
    Route::get('entidad', function () {
        return Entidad::select('id', 'nombre')->get();
    });
});
