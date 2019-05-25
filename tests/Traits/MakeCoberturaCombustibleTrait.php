<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\CoberturaCombustible;
use App\Repositories\CoberturaCombustibleRepository;

trait MakeCoberturaCombustibleTrait
{
    /**
     * Create fake instance of CoberturaCombustible and save it in database
     *
     * @param array $coberturaCombustibleFields
     * @return CoberturaCombustible
     */
    public function makeCoberturaCombustible($coberturaCombustibleFields = [])
    {
        /** @var CoberturaCombustibleRepository $coberturaCombustibleRepo */
        $coberturaCombustibleRepo = \App::make(CoberturaCombustibleRepository::class);
        $theme = $this->fakeCoberturaCombustibleData($coberturaCombustibleFields);
        return $coberturaCombustibleRepo->create($theme);
    }

    /**
     * Get fake instance of CoberturaCombustible
     *
     * @param array $coberturaCombustibleFields
     * @return CoberturaCombustible
     */
    public function fakeCoberturaCombustible($coberturaCombustibleFields = [])
    {
        return new CoberturaCombustible($this->fakeCoberturaCombustibleData($coberturaCombustibleFields));
    }

    /**
     * Get fake data of CoberturaCombustible
     *
     * @param array $coberturaCombustibleFields
     * @return array
     */
    public function fakeCoberturaCombustibleData($coberturaCombustibleFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'planReserva' => $fake->randomDigitNotNull,
            'fondaje' => $fake->randomDigitNotNull,
            'existOperativa' => $fake->randomDigitNotNull,
            'coberturaHoras' => $fake->word,
            'consumo' => $fake->randomDigitNotNull,
            'suminCupet' => $fake->randomDigitNotNull,
            'capacTotalAlmac' => $fake->randomDigitNotNull,
            'capacVacio' => $fake->randomDigitNotNull,
            'existTotalDiaAnterior' => $fake->randomDigitNotNull,
            'central_electricas_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $coberturaCombustibleFields);
    }
}
