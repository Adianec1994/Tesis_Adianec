<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\MantenedorExterno;
use App\Repositories\MantenedorExternoRepository;

trait MakeMantenedorExternoTrait
{
    /**
     * Create fake instance of MantenedorExterno and save it in database
     *
     * @param array $mantenedorExternoFields
     * @return MantenedorExterno
     */
    public function makeMantenedorExterno($mantenedorExternoFields = [])
    {
        /** @var MantenedorExternoRepository $mantenedorExternoRepo */
        $mantenedorExternoRepo = \App::make(MantenedorExternoRepository::class);
        $theme = $this->fakeMantenedorExternoData($mantenedorExternoFields);
        return $mantenedorExternoRepo->create($theme);
    }

    /**
     * Get fake instance of MantenedorExterno
     *
     * @param array $mantenedorExternoFields
     * @return MantenedorExterno
     */
    public function fakeMantenedorExterno($mantenedorExternoFields = [])
    {
        return new MantenedorExterno($this->fakeMantenedorExternoData($mantenedorExternoFields));
    }

    /**
     * Get fake data of MantenedorExterno
     *
     * @param array $mantenedorExternoFields
     * @return array
     */
    public function fakeMantenedorExternoData($mantenedorExternoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'numeroContrato' => $fake->randomDigitNotNull,
            'fechaInicio' => $fake->word,
            'fechaFin' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $mantenedorExternoFields);
    }
}
