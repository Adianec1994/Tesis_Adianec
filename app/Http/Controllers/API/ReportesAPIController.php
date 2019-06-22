<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use DB;

class ReportesAPIController extends AppBaseController
{
    public function existenciaLubricante()
    {
        $datos =
        DB::table('datos_generales')
        ->join('central_electricas','datos_generales.central_electricas_id','=','central_electricas.id')
        ->join('entidads','central_electricas.entidads_id','=','entidads.id')
        ->join('provincias','entidads.provincias_id','=','provincias.id')
        ->groupBy('provincias.nombre')
        ->selectRaw('provincias.nombre as Provincias, sum(datos_generales.existencia) as Existencia, sum(datos_generales.cobertura) as Horas')
        ->get();

        return $this->sendResponse($datos, 'Reporte cargado satisfactoriamente');
    }
}
