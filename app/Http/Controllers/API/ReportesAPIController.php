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

    public function existenciaRefrigerante()
    {
        $datos =
        DB::table('provincias')
        ->join('entidads', 'provincias.id','=','entidads.provincias_id')
        ->join('central_electricas','entidads.id','=','central_electricas.entidads_id')
        ->join('baterias','baterias.central_electricas_id','=','central_electricas.id')
        ->join('grupos','baterias.id','=','grupos.baterias_id')
        ->join('proveedors','proveedors.id','=','grupos.proveedors_id')
        ->groupBy('provincias.nombre', 'proveedors.marca')
        ->selectRaw('provincias.nombre as Provincias, proveedors.marca as Marca, count(proveedors.marca) as Cantidad')
        ->get();

        return $this->sendResponse($datos, 'Reporte cargado satisfactoriamente');
    }

    public function disponibilidad()
    {
        $datos =
        DB::table('disponibilidads')
        ->join('entidads', 'disponibilidads.entidads_id','=','entidads.id')
        ->join('provincias', 'entidads.provincias_id','=','provincias.id')
        ->selectRaw('provincias.nombre as Provincias, disponibilidads.potInstaladaReal as `Potencia Instalada (MW)`,
        disponibilidads.potDisponibleReal as `Potencia Disponible (MW)`, round(potDisponibleReal*100/potInstaladaReal,2) as `Porciento Disponible`')
        ->get();

        return $this->sendResponse($datos, 'Reporte cargado satisfactoriamente');
    }
}
