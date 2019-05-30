<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\EventoDiario;
use App\Repositories\EventoDiarioRepository;

trait MakeEventoDiarioTrait
{
    /**
     * Create fake instance of EventoDiario and save it in database
     *
     * @param array $eventoDiarioFields
     * @return EventoDiario
     */
    public function makeEventoDiario($eventoDiarioFields = [])
    {
        /** @var EventoDiarioRepository $eventoDiarioRepo */
        $eventoDiarioRepo = \App::make(EventoDiarioRepository::class);
        $theme = $this->fakeEventoDiarioData($eventoDiarioFields);
        return $eventoDiarioRepo->create($theme);
    }

    /**
     * Get fake instance of EventoDiario
     *
     * @param array $eventoDiarioFields
     * @return EventoDiario
     */
    public function fakeEventoDiario($eventoDiarioFields = [])
    {
        return new EventoDiario($this->fakeEventoDiarioData($eventoDiarioFields));
    }

    /**
     * Get fake data of EventoDiario
     *
     * @param array $eventoDiarioFields
     * @return array
     */
    public function fakeEventoDiarioData($eventoDiarioFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'estado' => $fake->word,
            'fechaEvento' => $fake->date('Y-m-d H:i:s'),
            'fechaPosibleSolucion' => $fake->date('Y-m-d H:i:s'),
            'fechaReporte' => $fake->date('Y-m-d H:i:s'),
            'fechaDiagnostico' => $fake->date('Y-m-d H:i:s'),
            'fechaSolucion' => $fake->date('Y-m-d H:i:s'),
            'horas' => $fake->randomDigitNotNull,
            'sistema' => $fake->text,
            'subSistema' => $fake->text,
            'parte' => $fake->text,
            'fallo' => $fake->text,
            'diagnosticoPreliminar' => $fake->text,
            'diagnostico' => $fake->text,
            'responsable' => $fake->word,
            'insertadoPor' => $fake->word,
            'grupos_id' => $fake->randomDigitNotNull,
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $eventoDiarioFields);
    }
}
