<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\HechosExtraordinarios;
use App\Repositories\HechosExtraordinariosRepository;

trait MakeHechosExtraordinariosTrait
{
    /**
     * Create fake instance of HechosExtraordinarios and save it in database
     *
     * @param array $hechosExtraordinariosFields
     * @return HechosExtraordinarios
     */
    public function makeHechosExtraordinarios($hechosExtraordinariosFields = [])
    {
        /** @var HechosExtraordinariosRepository $hechosExtraordinariosRepo */
        $hechosExtraordinariosRepo = \App::make(HechosExtraordinariosRepository::class);
        $theme = $this->fakeHechosExtraordinariosData($hechosExtraordinariosFields);
        return $hechosExtraordinariosRepo->create($theme);
    }

    /**
     * Get fake instance of HechosExtraordinarios
     *
     * @param array $hechosExtraordinariosFields
     * @return HechosExtraordinarios
     */
    public function fakeHechosExtraordinarios($hechosExtraordinariosFields = [])
    {
        return new HechosExtraordinarios($this->fakeHechosExtraordinariosData($hechosExtraordinariosFields));
    }

    /**
     * Get fake data of HechosExtraordinarios
     *
     * @param array $hechosExtraordinariosFields
     * @return array
     */
    public function fakeHechosExtraordinariosData($hechosExtraordinariosFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'tipo' => $fake->word,
            'fecha' => $fake->word,
            'hora' => $fake->word,
            'descripcion' => $fake->text,
            'medidas' => $fake->text,
            'nombreImplicado' => $fake->word,
            'nombreInforma' => $fake->word,
            'entidads_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $hechosExtraordinariosFields);
    }
}
