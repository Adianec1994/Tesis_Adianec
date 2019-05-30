<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Grupos;
use App\Repositories\GruposRepository;

trait MakeGruposTrait
{
    /**
     * Create fake instance of Grupos and save it in database
     *
     * @param array $gruposFields
     * @return Grupos
     */
    public function makeGrupos($gruposFields = [])
    {
        /** @var GruposRepository $gruposRepo */
        $gruposRepo = \App::make(GruposRepository::class);
        $theme = $this->fakeGruposData($gruposFields);
        return $gruposRepo->create($theme);
    }

    /**
     * Get fake instance of Grupos
     *
     * @param array $gruposFields
     * @return Grupos
     */
    public function fakeGrupos($gruposFields = [])
    {
        return new Grupos($this->fakeGruposData($gruposFields));
    }

    /**
     * Get fake data of Grupos
     *
     * @param array $gruposFields
     * @return array
     */
    public function fakeGruposData($gruposFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'numero' => $fake->randomDigitNotNull,
            'potInstalada' => $fake->randomDigitNotNull,
            'baterias_id' => $fake->randomDigitNotNull,
            'proveedors_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $gruposFields);
    }
}
