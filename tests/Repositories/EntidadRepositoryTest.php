<?php namespace Tests\Repositories;

use App\Models\Entidad;
use App\Repositories\EntidadRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeEntidadTrait;
use Tests\ApiTestTrait;

class EntidadRepositoryTest extends TestCase
{
    use MakeEntidadTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EntidadRepository
     */
    protected $entidadRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->entidadRepo = \App::make(EntidadRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_entidad()
    {
        $entidad = $this->fakeEntidadData();
        $createdEntidad = $this->entidadRepo->create($entidad);
        $createdEntidad = $createdEntidad->toArray();
        $this->assertArrayHasKey('id', $createdEntidad);
        $this->assertNotNull($createdEntidad['id'], 'Created Entidad must have id specified');
        $this->assertNotNull(Entidad::find($createdEntidad['id']), 'Entidad with given id must be in DB');
        $this->assertModelData($entidad, $createdEntidad);
    }

    /**
     * @test read
     */
    public function test_read_entidad()
    {
        $entidad = $this->makeEntidad();
        $dbEntidad = $this->entidadRepo->find($entidad->id);
        $dbEntidad = $dbEntidad->toArray();
        $this->assertModelData($entidad->toArray(), $dbEntidad);
    }

    /**
     * @test update
     */
    public function test_update_entidad()
    {
        $entidad = $this->makeEntidad();
        $fakeEntidad = $this->fakeEntidadData();
        $updatedEntidad = $this->entidadRepo->update($fakeEntidad, $entidad->id);
        $this->assertModelData($fakeEntidad, $updatedEntidad->toArray());
        $dbEntidad = $this->entidadRepo->find($entidad->id);
        $this->assertModelData($fakeEntidad, $dbEntidad->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_entidad()
    {
        $entidad = $this->makeEntidad();
        $resp = $this->entidadRepo->delete($entidad->id);
        $this->assertTrue($resp);
        $this->assertNull(Entidad::find($entidad->id), 'Entidad should not exist in DB');
    }
}
