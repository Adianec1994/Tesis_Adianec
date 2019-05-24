<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Entidad;
use App\Repositories\EntidadRepository;

trait MakeEntidadTrait
{
    /**
     * Create fake instance of Entidad and save it in database
     *
     * @param array $entidadFields
     * @return Entidad
     */
    public function makeEntidad($entidadFields = [])
    {
        /** @var EntidadRepository $entidadRepo */
        $entidadRepo = \App::make(EntidadRepository::class);
        $theme = $this->fakeEntidadData($entidadFields);
        return $entidadRepo->create($theme);
    }

    /**
     * Get fake instance of Entidad
     *
     * @param array $entidadFields
     * @return Entidad
     */
    public function fakeEntidad($entidadFields = [])
    {
        return new Entidad($this->fakeEntidadData($entidadFields));
    }

    /**
     * Get fake data of Entidad
     *
     * @param array $entidadFields
     * @return array
     */
    public function fakeEntidadData($entidadFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'potInstalada' => $fake->randomDigitNotNull,
            'ip' => $fake->word,
            'provincias_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $entidadFields);
    }
}
