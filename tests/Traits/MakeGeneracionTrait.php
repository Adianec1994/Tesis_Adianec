<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Generacion;
use App\Repositories\GeneracionRepository;

trait MakeGeneracionTrait
{
    /**
     * Create fake instance of Generacion and save it in database
     *
     * @param array $generacionFields
     * @return Generacion
     */
    public function makeGeneracion($generacionFields = [])
    {
        /** @var GeneracionRepository $generacionRepo */
        $generacionRepo = \App::make(GeneracionRepository::class);
        $theme = $this->fakeGeneracionData($generacionFields);
        return $generacionRepo->create($theme);
    }

    /**
     * Get fake instance of Generacion
     *
     * @param array $generacionFields
     * @return Generacion
     */
    public function fakeGeneracion($generacionFields = [])
    {
        return new Generacion($this->fakeGeneracionData($generacionFields));
    }

    /**
     * Get fake data of Generacion
     *
     * @param array $generacionFields
     * @return array
     */
    public function fakeGeneracionData($generacionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'fecha' => $fake->word,
            'horaEntrada' => $fake->word,
            'horaSalida' => $fake->word,
            'reportadoPor' => $fake->text,
            'tiempoOperacion' => $fake->word,
            'grupos_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $generacionFields);
    }
}
