<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Planes;
use App\Repositories\PlanesRepository;

trait MakePlanesTrait
{
    /**
     * Create fake instance of Planes and save it in database
     *
     * @param array $planesFields
     * @return Planes
     */
    public function makePlanes($planesFields = [])
    {
        /** @var PlanesRepository $planesRepo */
        $planesRepo = \App::make(PlanesRepository::class);
        $theme = $this->fakePlanesData($planesFields);
        return $planesRepo->create($theme);
    }

    /**
     * Get fake instance of Planes
     *
     * @param array $planesFields
     * @return Planes
     */
    public function fakePlanes($planesFields = [])
    {
        return new Planes($this->fakePlanesData($planesFields));
    }

    /**
     * Get fake data of Planes
     *
     * @param array $planesFields
     * @return array
     */
    public function fakePlanesData($planesFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'mes' => $fake->word,
            'generacion' => $fake->word,
            'indiceConsumoCombustible' => $fake->word,
            'compromiso' => $fake->word,
            'entidads_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $planesFields);
    }
}
