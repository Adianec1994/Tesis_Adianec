<?php

use Illuminate\Support\Facades\DB;

/**
 * Verifica que el valor no se repita en el campo en la base de datos, sin tener en cuenta el elemento actual
 */
function unique($table, int $id, string $campo, string $valor)
{
    $consulta = DB::table($table)->where($campo, '=', $valor)->where('id', '!=', $id)->count();
    if ($consulta != 0) {
        return false;
    }
    return true;
}
