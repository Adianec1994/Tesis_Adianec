<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Medio;
use App\Repositories\MedioRepository;

trait MakeMedioTrait
{
    /**
     * Create fake instance of Medio and save it in database
     *
     * @param array $medioFields
     * @return Medio
     */
    public function makeMedio($medioFields = [])
    {
        /** @var MedioRepository $medioRepo */
        $medioRepo = \App::make(MedioRepository::class);
        $theme = $this->fakeMedioData($medioFields);
        return $medioRepo->create($theme);
    }

    /**
     * Get fake instance of Medio
     *
     * @param array $medioFields
     * @return Medio
     */
    public function fakeMedio($medioFields = [])
    {
        return new Medio($this->fakeMedioData($medioFields));
    }

    /**
     * Get fake data of Medio
     *
     * @param array $medioFields
     * @return array
     */
    public function fakeMedioData($medioFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'medio' => $fake->word,
            'marca' => $fake->word,
            'modelo' => $fake->word,
            'serie' => $fake->word,
            'mac' => $fake->word,
            'info_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $medioFields);
    }
}
