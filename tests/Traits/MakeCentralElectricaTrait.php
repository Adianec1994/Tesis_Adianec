<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\CentralElectrica;
use App\Repositories\CentralElectricaRepository;

trait MakeCentralElectricaTrait
{
    /**
     * Create fake instance of CentralElectrica and save it in database
     *
     * @param array $centralElectricaFields
     * @return CentralElectrica
     */
    public function makeCentralElectrica($centralElectricaFields = [])
    {
        /** @var CentralElectricaRepository $centralElectricaRepo */
        $centralElectricaRepo = \App::make(CentralElectricaRepository::class);
        $theme = $this->fakeCentralElectricaData($centralElectricaFields);
        return $centralElectricaRepo->create($theme);
    }

    /**
     * Get fake instance of CentralElectrica
     *
     * @param array $centralElectricaFields
     * @return CentralElectrica
     */
    public function fakeCentralElectrica($centralElectricaFields = [])
    {
        return new CentralElectrica($this->fakeCentralElectricaData($centralElectricaFields));
    }

    /**
     * Get fake data of CentralElectrica
     *
     * @param array $centralElectricaFields
     * @return array
     */
    public function fakeCentralElectricaData($centralElectricaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'potInstalada' => $fake->randomDigitNotNull,
            'entidads_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $centralElectricaFields);
    }
}
