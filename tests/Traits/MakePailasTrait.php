<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Pailas;
use App\Repositories\PailasRepository;

trait MakePailasTrait
{
    /**
     * Create fake instance of Pailas and save it in database
     *
     * @param array $pailasFields
     * @return Pailas
     */
    public function makePailas($pailasFields = [])
    {
        /** @var PailasRepository $pailasRepo */
        $pailasRepo = \App::make(PailasRepository::class);
        $theme = $this->fakePailasData($pailasFields);
        return $pailasRepo->create($theme);
    }

    /**
     * Get fake instance of Pailas
     *
     * @param array $pailasFields
     * @return Pailas
     */
    public function fakePailas($pailasFields = [])
    {
        return new Pailas($this->fakePailasData($pailasFields));
    }

    /**
     * Get fake data of Pailas
     *
     * @param array $pailasFields
     * @return array
     */
    public function fakePailasData($pailasFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'fecha' => $fake->word,
            'hora' => $fake->word,
            'combustibleFactura' => $fake->randomDigitNotNull,
            'combustibleMedicion' => $fake->randomDigitNotNull,
            'acciones' => $fake->text,
            'central_electricas_id' => $fake->randomDigitNotNull,
            'operadors_id' => $fake->randomDigitNotNull,
            'chofer_id' => $fake->randomDigitNotNull,
            'acompanante_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $pailasFields);
    }
}
