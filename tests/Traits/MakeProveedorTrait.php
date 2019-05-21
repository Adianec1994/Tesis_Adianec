<?php namespace Tests\Traits;

use Faker\Factory as Faker;
use App\Models\Proveedor;
use App\Repositories\ProveedorRepository;

trait MakeProveedorTrait
{
    /**
     * Create fake instance of Proveedor and save it in database
     *
     * @param array $proveedorFields
     * @return Proveedor
     */
    public function makeProveedor($proveedorFields = [])
    {
        /** @var ProveedorRepository $proveedorRepo */
        $proveedorRepo = \App::make(ProveedorRepository::class);
        $theme = $this->fakeProveedorData($proveedorFields);
        return $proveedorRepo->create($theme);
    }

    /**
     * Get fake instance of Proveedor
     *
     * @param array $proveedorFields
     * @return Proveedor
     */
    public function fakeProveedor($proveedorFields = [])
    {
        return new Proveedor($this->fakeProveedorData($proveedorFields));
    }

    /**
     * Get fake data of Proveedor
     *
     * @param array $proveedorFields
     * @return array
     */
    public function fakeProveedorData($proveedorFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'marca' => $fake->word,
            'serie' => $fake->randomDigitNotNull,
            'pais' => $fake->word
        ], $proveedorFields);
    }
}
