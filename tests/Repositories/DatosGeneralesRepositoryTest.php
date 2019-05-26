<?php namespace Tests\Repositories;

use App\Models\DatosGenerales;
use App\Repositories\DatosGeneralesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDatosGeneralesTrait;
use Tests\ApiTestTrait;

class DatosGeneralesRepositoryTest extends TestCase
{
    use MakeDatosGeneralesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DatosGeneralesRepository
     */
    protected $datosGeneralesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->datosGeneralesRepo = \App::make(DatosGeneralesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_datos_generales()
    {
        $datosGenerales = $this->fakeDatosGeneralesData();
        $createdDatosGenerales = $this->datosGeneralesRepo->create($datosGenerales);
        $createdDatosGenerales = $createdDatosGenerales->toArray();
        $this->assertArrayHasKey('id', $createdDatosGenerales);
        $this->assertNotNull($createdDatosGenerales['id'], 'Created DatosGenerales must have id specified');
        $this->assertNotNull(DatosGenerales::find($createdDatosGenerales['id']), 'DatosGenerales with given id must be in DB');
        $this->assertModelData($datosGenerales, $createdDatosGenerales);
    }

    /**
     * @test read
     */
    public function test_read_datos_generales()
    {
        $datosGenerales = $this->makeDatosGenerales();
        $dbDatosGenerales = $this->datosGeneralesRepo->find($datosGenerales->id);
        $dbDatosGenerales = $dbDatosGenerales->toArray();
        $this->assertModelData($datosGenerales->toArray(), $dbDatosGenerales);
    }

    /**
     * @test update
     */
    public function test_update_datos_generales()
    {
        $datosGenerales = $this->makeDatosGenerales();
        $fakeDatosGenerales = $this->fakeDatosGeneralesData();
        $updatedDatosGenerales = $this->datosGeneralesRepo->update($fakeDatosGenerales, $datosGenerales->id);
        $this->assertModelData($fakeDatosGenerales, $updatedDatosGenerales->toArray());
        $dbDatosGenerales = $this->datosGeneralesRepo->find($datosGenerales->id);
        $this->assertModelData($fakeDatosGenerales, $dbDatosGenerales->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_datos_generales()
    {
        $datosGenerales = $this->makeDatosGenerales();
        $resp = $this->datosGeneralesRepo->delete($datosGenerales->id);
        $this->assertTrue($resp);
        $this->assertNull(DatosGenerales::find($datosGenerales->id), 'DatosGenerales should not exist in DB');
    }
}
