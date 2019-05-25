<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Baterias;
use App\Repositories\BateriasRepository;

trait MakeBateriasTrait
{
    /**
     * Create fake instance of Baterias and save it in database
     *
     * @param array $bateriasFields
     * @return Baterias
     */
    public function makeBaterias($bateriasFields = [])
    {
        /** @var BateriasRepository $bateriasRepo */
        $bateriasRepo = \App::make(BateriasRepository::class);
        $theme = $this->fakeBateriasData($bateriasFields);
        return $bateriasRepo->create($theme);
    }

    /**
     * Get fake instance of Baterias
     *
     * @param array $bateriasFields
     * @return Baterias
     */
    public function fakeBaterias($bateriasFields = [])
    {
        return new Baterias($this->fakeBateriasData($bateriasFields));
    }

    /**
     * Get fake data of Baterias
     *
     * @param array $bateriasFields
     * @return array
     */
    public function fakeBateriasData($bateriasFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'numero' => $fake->randomDigitNotNull,
            'potInstalada' => $fake->randomDigitNotNull,
            'central_electricas_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $bateriasFields);
    }
}
