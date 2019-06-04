<?php namespace Tests\Repositories;

use App\Models\Generacion;
use App\Repositories\GeneracionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGeneracionTrait;
use Tests\ApiTestTrait;

class GeneracionRepositoryTest extends TestCase
{
    use MakeGeneracionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var GeneracionRepository
     */
    protected $generacionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->generacionRepo = \App::make(GeneracionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_generacion()
    {
        $generacion = $this->fakeGeneracionData();
        $createdGeneracion = $this->generacionRepo->create($generacion);
        $createdGeneracion = $createdGeneracion->toArray();
        $this->assertArrayHasKey('id', $createdGeneracion);
        $this->assertNotNull($createdGeneracion['id'], 'Created Generacion must have id specified');
        $this->assertNotNull(Generacion::find($createdGeneracion['id']), 'Generacion with given id must be in DB');
        $this->assertModelData($generacion, $createdGeneracion);
    }

    /**
     * @test read
     */
    public function test_read_generacion()
    {
        $generacion = $this->makeGeneracion();
        $dbGeneracion = $this->generacionRepo->find($generacion->id);
        $dbGeneracion = $dbGeneracion->toArray();
        $this->assertModelData($generacion->toArray(), $dbGeneracion);
    }

    /**
     * @test update
     */
    public function test_update_generacion()
    {
        $generacion = $this->makeGeneracion();
        $fakeGeneracion = $this->fakeGeneracionData();
        $updatedGeneracion = $this->generacionRepo->update($fakeGeneracion, $generacion->id);
        $this->assertModelData($fakeGeneracion, $updatedGeneracion->toArray());
        $dbGeneracion = $this->generacionRepo->find($generacion->id);
        $this->assertModelData($fakeGeneracion, $dbGeneracion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_generacion()
    {
        $generacion = $this->makeGeneracion();
        $resp = $this->generacionRepo->delete($generacion->id);
        $this->assertTrue($resp);
        $this->assertNull(Generacion::find($generacion->id), 'Generacion should not exist in DB');
    }
}
