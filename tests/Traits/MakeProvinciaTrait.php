<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Provincia;
use App\Repositories\ProvinciaRepository;

trait MakeProvinciaTrait
{
    /**
     * Create fake instance of Provincia and save it in database
     *
     * @param array $provinciaFields
     * @return Provincia
     */
    public function makeProvincia($provinciaFields = [])
    {
        /** @var ProvinciaRepository $provinciaRepo */
        $provinciaRepo = \App::make(ProvinciaRepository::class);
        $theme = $this->fakeProvinciaData($provinciaFields);
        return $provinciaRepo->create($theme);
    }

    /**
     * Get fake instance of Provincia
     *
     * @param array $provinciaFields
     * @return Provincia
     */
    public function fakeProvincia($provinciaFields = [])
    {
        return new Provincia($this->fakeProvinciaData($provinciaFields));
    }

    /**
     * Get fake data of Provincia
     *
     * @param array $provinciaFields
     * @return array
     */
    public function fakeProvinciaData($provinciaFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word
        ], $provinciaFields);
    }
}
