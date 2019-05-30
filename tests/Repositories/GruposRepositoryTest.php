<?php namespace Tests\Repositories;

use App\Models\Grupos;
use App\Repositories\GruposRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGruposTrait;
use Tests\ApiTestTrait;

class GruposRepositoryTest extends TestCase
{
    use MakeGruposTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var GruposRepository
     */
    protected $gruposRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->gruposRepo = \App::make(GruposRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_grupos()
    {
        $grupos = $this->fakeGruposData();
        $createdGrupos = $this->gruposRepo->create($grupos);
        $createdGrupos = $createdGrupos->toArray();
        $this->assertArrayHasKey('id', $createdGrupos);
        $this->assertNotNull($createdGrupos['id'], 'Created Grupos must have id specified');
        $this->assertNotNull(Grupos::find($createdGrupos['id']), 'Grupos with given id must be in DB');
        $this->assertModelData($grupos, $createdGrupos);
    }

    /**
     * @test read
     */
    public function test_read_grupos()
    {
        $grupos = $this->makeGrupos();
        $dbGrupos = $this->gruposRepo->find($grupos->id);
        $dbGrupos = $dbGrupos->toArray();
        $this->assertModelData($grupos->toArray(), $dbGrupos);
    }

    /**
     * @test update
     */
    public function test_update_grupos()
    {
        $grupos = $this->makeGrupos();
        $fakeGrupos = $this->fakeGruposData();
        $updatedGrupos = $this->gruposRepo->update($fakeGrupos, $grupos->id);
        $this->assertModelData($fakeGrupos, $updatedGrupos->toArray());
        $dbGrupos = $this->gruposRepo->find($grupos->id);
        $this->assertModelData($fakeGrupos, $dbGrupos->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_grupos()
    {
        $grupos = $this->makeGrupos();
        $resp = $this->gruposRepo->delete($grupos->id);
        $this->assertTrue($resp);
        $this->assertNull(Grupos::find($grupos->id), 'Grupos should not exist in DB');
    }
}
