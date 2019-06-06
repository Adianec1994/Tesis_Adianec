<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Info;
use App\Repositories\InfoRepository;

trait MakeInfoTrait
{
    /**
     * Create fake instance of Info and save it in database
     *
     * @param array $infoFields
     * @return Info
     */
    public function makeInfo($infoFields = [])
    {
        /** @var InfoRepository $infoRepo */
        $infoRepo = \App::make(InfoRepository::class);
        $theme = $this->fakeInfoData($infoFields);
        return $infoRepo->create($theme);
    }

    /**
     * Get fake instance of Info
     *
     * @param array $infoFields
     * @return Info
     */
    public function fakeInfo($infoFields = [])
    {
        return new Info($this->fakeInfoData($infoFields));
    }

    /**
     * Get fake data of Info
     *
     * @param array $infoFields
     * @return array
     */
    public function fakeInfoData($infoFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'papellido' => $fake->word,
            'sapellido' => $fake->word,
            'nombre' => $fake->word,
            'ci' => $fake->word,
            'solapin' => $fake->word,
            'area' => $fake->word,
            'calle' => $fake->word,
            'entrecalles' => $fake->word,
            'numcasa' => $fake->randomDigitNotNull,
            'apto' => $fake->randomDigitNotNull,
            'telefono' => $fake->word,
            'mcpio' => $fake->word,
            'provincia' => $fake->word,
            'tipopersonal' => $fake->word,
            'interno' => $fake->word,
            'user_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $infoFields);
    }
}
