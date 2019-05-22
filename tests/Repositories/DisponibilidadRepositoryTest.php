<?php namespace Tests\Repositories;

use App\Models\Disponibilidad;
use App\Repositories\DisponibilidadRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDisponibilidadTrait;
use Tests\ApiTestTrait;

class DisponibilidadRepositoryTest extends TestCase
{
    use MakeDisponibilidadTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DisponibilidadRepository
     */
    protected $disponibilidadRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->disponibilidadRepo = \App::make(DisponibilidadRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_disponibilidad()
    {
        $disponibilidad = $this->fakeDisponibilidadData();
        $createdDisponibilidad = $this->disponibilidadRepo->create($disponibilidad);
        $createdDisponibilidad = $createdDisponibilidad->toArray();
        $this->assertArrayHasKey('id', $createdDisponibilidad);
        $this->assertNotNull($createdDisponibilidad['id'], 'Created Disponibilidad must have id specified');
        $this->assertNotNull(Disponibilidad::find($createdDisponibilidad['id']), 'Disponibilidad with given id must be in DB');
        $this->assertModelData($disponibilidad, $createdDisponibilidad);
    }

    /**
     * @test read
     */
    public function test_read_disponibilidad()
    {
        $disponibilidad = $this->makeDisponibilidad();
        $dbDisponibilidad = $this->disponibilidadRepo->find($disponibilidad->id);
        $dbDisponibilidad = $dbDisponibilidad->toArray();
        $this->assertModelData($disponibilidad->toArray(), $dbDisponibilidad);
    }

    /**
     * @test update
     */
    public function test_update_disponibilidad()
    {
        $disponibilidad = $this->makeDisponibilidad();
        $fakeDisponibilidad = $this->fakeDisponibilidadData();
        $updatedDisponibilidad = $this->disponibilidadRepo->update($fakeDisponibilidad, $disponibilidad->id);
        $this->assertModelData($fakeDisponibilidad, $updatedDisponibilidad->toArray());
        $dbDisponibilidad = $this->disponibilidadRepo->find($disponibilidad->id);
        $this->assertModelData($fakeDisponibilidad, $dbDisponibilidad->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_disponibilidad()
    {
        $disponibilidad = $this->makeDisponibilidad();
        $resp = $this->disponibilidadRepo->delete($disponibilidad->id);
        $this->assertTrue($resp);
        $this->assertNull(Disponibilidad::find($disponibilidad->id), 'Disponibilidad should not exist in DB');
    }
}
