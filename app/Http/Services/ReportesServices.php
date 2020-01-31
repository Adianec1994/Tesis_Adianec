<?php

namespace App\Http\Services;

use DateInterval;
use App\Repositories\ProvinciaRepository;
use App\Repositories\CoberturaCombustibleRepository;

class ReportesServices
{
    private $provinciaRepository;
    private $coberturaCombustibleRepository;

    public function __construct(
        ProvinciaRepository $provinciaRepository,
        CoberturaCombustibleRepository $coberturaCombustibleRepository
    ) {
        $this->provinciaRepository = $provinciaRepository;
        $this->coberturaCombustibleRepository = $coberturaCombustibleRepository;
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

    public function reporte4($filters)
    {
        // $filters['fecha'] = '2020-01-30';
        $fecha = (!empty($filters['fecha'])) ? $filters['fecha'] : '';
        $coberturas['coberturas'] = $this->coberturaCombustibleRepository
            ->with(['centralElectricas.entidads.provincias'])
            ->findWhere(['fechaCobertura' => $fecha])
            ->sortBy('hora')
            ->toArray();
        return $coberturas;
    }
}
