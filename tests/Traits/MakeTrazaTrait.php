<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Traza;
use App\Repositories\TrazaRepository;

trait MakeTrazaTrait
{
    /**
     * Create fake instance of Traza and save it in database
     *
     * @param array $trazaFields
     * @return Traza
     */
    public function makeTraza($trazaFields = [])
    {
        /** @var TrazaRepository $trazaRepo */
        $trazaRepo = \App::make(TrazaRepository::class);
        $theme = $this->fakeTrazaData($trazaFields);
        return $trazaRepo->create($theme);
    }

    /**
     * Get fake instance of Traza
     *
     * @param array $trazaFields
     * @return Traza
     */
    public function fakeTraza($trazaFields = [])
    {
        return new Traza($this->fakeTrazaData($trazaFields));
    }

    /**
     * Get fake data of Traza
     *
     * @param array $trazaFields
     * @return array
     */
    public function fakeTrazaData($trazaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'accion' => $fake->word,
            'ip' => $fake->word,
            'url' => $fake->word,
            'users_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $trazaFields);
    }
}
