<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Operador;
use App\Repositories\OperadorRepository;

trait MakeOperadorTrait
{
    /**
     * Create fake instance of Operador and save it in database
     *
     * @param array $operadorFields
     * @return Operador
     */
    public function makeOperador($operadorFields = [])
    {
        /** @var OperadorRepository $operadorRepo */
        $operadorRepo = \App::make(OperadorRepository::class);
        $theme = $this->fakeOperadorData($operadorFields);
        return $operadorRepo->create($theme);
    }

    /**
     * Get fake instance of Operador
     *
     * @param array $operadorFields
     * @return Operador
     */
    public function fakeOperador($operadorFields = [])
    {
        return new Operador($this->fakeOperadorData($operadorFields));
    }

    /**
     * Get fake data of Operador
     *
     * @param array $operadorFields
     * @return array
     */
    public function fakeOperadorData($operadorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'nombre' => $fake->word,
            'cidentidad' => $fake->word,
            'ocupacion' => $fake->word,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $operadorFields);
    }
}
