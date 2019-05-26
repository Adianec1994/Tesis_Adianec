<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\DatosGenerales;
use App\Repositories\DatosGeneralesRepository;

trait MakeDatosGeneralesTrait
{
    /**
     * Create fake instance of DatosGenerales and save it in database
     *
     * @param array $datosGeneralesFields
     * @return DatosGenerales
     */
    public function makeDatosGenerales($datosGeneralesFields = [])
    {
        /** @var DatosGeneralesRepository $datosGeneralesRepo */
        $datosGeneralesRepo = \App::make(DatosGeneralesRepository::class);
        $theme = $this->fakeDatosGeneralesData($datosGeneralesFields);
        return $datosGeneralesRepo->create($theme);
    }

    /**
     * Get fake instance of DatosGenerales
     *
     * @param array $datosGeneralesFields
     * @return DatosGenerales
     */
    public function fakeDatosGenerales($datosGeneralesFields = [])
    {
        return new DatosGenerales($this->fakeDatosGeneralesData($datosGeneralesFields));
    }

    /**
     * Get fake data of DatosGenerales
     *
     * @param array $datosGeneralesFields
     * @return array
     */
    public function fakeDatosGeneralesData($datosGeneralesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'genBruta' => $fake->randomDigitNotNull,
            'insumos' => $fake->randomDigitNotNull,
            'recibido' => $fake->randomDigitNotNull,
            'volumenRecibido' => $fake->randomDigitNotNull,
            'consumoGeneracion' => $fake->randomDigitNotNull,
            'densidadPonderada' => $fake->randomDigitNotNull,
            'temperatura' => $fake->randomDigitNotNull,
            'densidadCorreccion' => $fake->randomDigitNotNull,
            'valorCalorico' => $fake->randomDigitNotNull,
            'existencia' => $fake->randomDigitNotNull,
            'cobertura' => $fake->randomDigitNotNull,
            'indiceConsumo' => $fake->randomDigitNotNull,
            'lubricteRecibido' => $fake->randomDigitNotNull,
            'lubricteCsmoReposicion' => $fake->randomDigitNotNull,
            'lubricteCsmoCambio' => $fake->randomDigitNotNull,
            'lubricteCsmoTotal' => $fake->randomDigitNotNull,
            'lubricteExistencia' => $fake->randomDigitNotNull,
            'lubricteCobertura' => $fake->randomDigitNotNull,
            'lubricteIndiceCsmo' => $fake->randomDigitNotNull,
            'refrigteRecibido' => $fake->randomDigitNotNull,
            'refrigteConsumo' => $fake->randomDigitNotNull,
            'refrigteExistencia' => $fake->randomDigitNotNull,
            'central_electricas_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $datosGeneralesFields);
    }
}
