<?php namespace Tests\Repositories;

use App\Models\MantenedorExterno;
use App\Repositories\MantenedorExternoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMantenedorExternoTrait;
use Tests\ApiTestTrait;

class MantenedorExternoRepositoryTest extends TestCase
{
    use MakeMantenedorExternoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MantenedorExternoRepository
     */
    protected $mantenedorExternoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->mantenedorExternoRepo = \App::make(MantenedorExternoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_mantenedor_externo()
    {
        $mantenedorExterno = $this->fakeMantenedorExternoData();
        $createdMantenedorExterno = $this->mantenedorExternoRepo->create($mantenedorExterno);
        $createdMantenedorExterno = $createdMantenedorExterno->toArray();
        $this->assertArrayHasKey('id', $createdMantenedorExterno);
        $this->assertNotNull($createdMantenedorExterno['id'], 'Created MantenedorExterno must have id specified');
        $this->assertNotNull(MantenedorExterno::find($createdMantenedorExterno['id']), 'MantenedorExterno with given id must be in DB');
        $this->assertModelData($mantenedorExterno, $createdMantenedorExterno);
    }

    /**
     * @test read
     */
    public function test_read_mantenedor_externo()
    {
        $mantenedorExterno = $this->makeMantenedorExterno();
        $dbMantenedorExterno = $this->mantenedorExternoRepo->find($mantenedorExterno->id);
        $dbMantenedorExterno = $dbMantenedorExterno->toArray();
        $this->assertModelData($mantenedorExterno->toArray(), $dbMantenedorExterno);
    }

    /**
     * @test update
     */
    public function test_update_mantenedor_externo()
    {
        $mantenedorExterno = $this->makeMantenedorExterno();
        $fakeMantenedorExterno = $this->fakeMantenedorExternoData();
        $updatedMantenedorExterno = $this->mantenedorExternoRepo->update($fakeMantenedorExterno, $mantenedorExterno->id);
        $this->assertModelData($fakeMantenedorExterno, $updatedMantenedorExterno->toArray());
        $dbMantenedorExterno = $this->mantenedorExternoRepo->find($mantenedorExterno->id);
        $this->assertModelData($fakeMantenedorExterno, $dbMantenedorExterno->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_mantenedor_externo()
    {
        $mantenedorExterno = $this->makeMantenedorExterno();
        $resp = $this->mantenedorExternoRepo->delete($mantenedorExterno->id);
        $this->assertTrue($resp);
        $this->assertNull(MantenedorExterno::find($mantenedorExterno->id), 'MantenedorExterno should not exist in DB');
    }
}
