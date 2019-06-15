<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use Spatie\Permission\Models\Role;
use App\Repositories\RolRepository;

trait MakeRolTrait
{
    /**
     * Create fake instance of Rol and save it in database
     *
     * @param array $rolFields
     * @return Rol
     */
    public function makeRol($rolFields = [])
    {
        /** @var RolRepository $rolRepo */
        $rolRepo = \App::make(RolRepository::class);
        $theme = $this->fakeRolData($rolFields);
        return $rolRepo->create($theme);
    }

    /**
     * Get fake instance of Rol
     *
     * @param array $rolFields
     * @return Rol
     */
    public function fakeRol($rolFields = [])
    {
        return new Rol($this->fakeRolData($rolFields));
    }

    /**
     * Get fake data of Rol
     *
     * @param array $rolFields
     * @return array
     */
    public function fakeRolData($rolFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'guard_name' => $fake->word,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s')
        ], $rolFields);
    }
}
