<?php

namespace App\Http\Services;

use DateInterval;
use App\Repositories\ProvinciaRepository;

class ReportesServices
{
    private $provinciaRepository;

    public function __construct(
        ProvinciaRepository $provinciaRepository
    ) {
        $this->provinciaRepository = $provinciaRepository;
    }

    public function reporte3()
    {
        $provincias = $this->provinciaRepository
            ->with(['entidads.centralElectricas.pailas.chofer', 'entidads.centralElectricas.pailas.acompanante', 'entidads.centralElectricas.pailas.operadors'])
            // ->orderBy('entidads.centralElectricas.pailas.fecha')
            ->get();

        $provinciasResult = [];
        foreach ($provincias as $provincia) {
            $pailas = [];
            foreach ($provincia->entidads as $entidad) {
                foreach ($entidad->centralElectricas as $central) {
                    foreach ($central->pailas as $paila) {
                        $pailas[] = [
                            'central' => $central->nombre,
                            'paila' => $paila
                        ];
                    }
                }
            }
            $provinciasResult['provincias'][] = [
                'provincia' => $provincia->nombre,
                'pailas' => $pailas
            ];
            $pailas = [];
        }
        // dd(json_encode($provinciasResult, JSON_PRETTY_PRINT));
        return $provinciasResult;
    }
}
