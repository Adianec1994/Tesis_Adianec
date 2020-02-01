<?php

namespace App\Http\Services;

use DateInterval;
use App\Repositories\ProvinciaRepository;
use App\Repositories\CoberturaCombustibleRepository;
use App\Repositories\DisponibilidadRepository;
use Illuminate\Support\Facades\DB;
use CpChart\Image;
use CpChart\Data;
use Illuminate\Support\Facades\Storage;

class ReportesServices
{
    private $provinciaRepository;
    private $coberturaCombustibleRepository;
    private $disponibilidadRepository;

    public function __construct(
        ProvinciaRepository $provinciaRepository,
        CoberturaCombustibleRepository $coberturaCombustibleRepository,
        DisponibilidadRepository $disponibilidadRepository
    ) {
        $this->provinciaRepository = $provinciaRepository;
        $this->coberturaCombustibleRepository = $coberturaCombustibleRepository;
        $this->disponibilidadRepository = $disponibilidadRepository;
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

    public function reporte5()
    {
        $disponibilidades['disponibilidades'] = DB::table('disponibilidads')
            ->join('entidads', 'disponibilidads.entidads_id', '=', 'entidads.id')
            ->join('provincias', 'entidads.provincias_id', '=', 'provincias.id')
            ->selectRaw('provincias.nombre as provincia, disponibilidads.potInstaladaReal as instalada,
        disponibilidads.potDisponibleReal as disponible, round(potDisponibleReal*100/potInstaladaReal,2) as porciento')
            ->get();
        // dd($disponibilidades);
        $disponibilidades['chart'] = $this->makeDisponibilidadChart($disponibilidades['disponibilidades']);
        return $disponibilidades;
    }

    private function makeDisponibilidadChart($disponibilidades)
    {
        $labels = [];
        $dataInstalada = [];
        $dataDisponible = [];
        $dataPorciento = [];
        foreach ($disponibilidades as $disponibilidad) {
            $labels[] = $disponibilidad->provincia;
            $dataInstalada[] = $disponibilidad->instalada;
            $dataDisponible[] = $disponibilidad->disponible;
            $dataPorciento[] = $disponibilidad->porciento;
        }

        /* Create and populate the Data object */
        $data = new Data();
        $data->addPoints($dataPorciento, "Porciento");
        $data->addPoints($dataDisponible, "Disponible");
        $data->addPoints($dataInstalada, "Instalada");
        $data->addPoints($labels, "Provincias");
        $data->setSerieDescription("Porciento", "Porciento Disponible (%)");
        $data->setSerieDescription("Disponible", "Potencia Disponible (MW)");
        $data->setSerieDescription("Instalada", "Potencia Instalada (MW)");
        $data->setAbscissa("Provincias");

        /* Create the Image object */
        $image = new Image(500, 500, $data);
        $image->drawGradientArea(0, 0, 500, 500, DIRECTION_VERTICAL, [
            "StartR" => 240,
            "StartG" => 240,
            "StartB" => 240,
            "EndR" => 180,
            "EndG" => 180,
            "EndB" => 180,
            "Alpha" => 100
        ]);
        $image->drawGradientArea(0, 0, 500, 500, DIRECTION_HORIZONTAL, [
            "StartR" => 240,
            "StartG" => 240,
            "StartB" => 240,
            "EndR" => 180,
            "EndG" => 180,
            "EndB" => 180,
            "Alpha" => 20
        ]);
        $image->setFontProperties(["FontName" => "verdana.ttf", "FontSize" => 9]);

        /* Draw the chart scale */
        $image->setGraphArea(100, 80, 480, 480);
        $image->drawScale([
            "CycleBackground" => true,
            "DrawSubTicks" => true,
            "GridR" => 0,
            "GridG" => 0,
            "GridB" => 0,
            "GridAlpha" => 10,
            "Pos" => SCALE_POS_TOPBOTTOM
        ]);

        /* Turn on shadow computing */
        $image->setShadow(true, ["X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10]);

        /* Draw the chart */
        $image->drawBarChart(["DisplayPos" => LABEL_POS_INSIDE, "DisplayValues" => true, "Rounded" => true, "Surrounding" => 30]);

        /* Write the legend */
        $image->drawLegend(200, 20, ["Style" => LEGEND_NOBORDER, "Mode" => LEGEND_VERTICAL]);

        /* Render the picture (choose the best way) */
        $image->Render("reporte_disponibilidades.png");

        $Base64Data = base64_encode(Storage::get('example.png'));
        $image = 'data:image/png;base64,' . $Base64Data;
        // dd($image);

        return $image;
    }
}
