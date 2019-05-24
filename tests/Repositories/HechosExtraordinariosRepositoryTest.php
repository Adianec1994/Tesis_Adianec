<?php namespace Tests\Repositories;

use App\Models\HechosExtraordinarios;
use App\Repositories\HechosExtraordinariosRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHechosExtraordinariosTrait;
use Tests\ApiTestTrait;

class HechosExtraordinariosRepositoryTest extends TestCase
{
    use MakeHechosExtraordinariosTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var HechosExtraordinariosRepository
     */
    protected $hechosExtraordinariosRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->hechosExtraordinariosRepo = \App::make(HechosExtraordinariosRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_hechos_extraordinarios()
    {
        $hechosExtraordinarios = $this->fakeHechosExtraordinariosData();
        $createdHechosExtraordinarios = $this->hechosExtraordinariosRepo->create($hechosExtraordinarios);
        $createdHechosExtraordinarios = $createdHechosExtraordinarios->toArray();
        $this->assertArrayHasKey('id', $createdHechosExtraordinarios);
        $this->assertNotNull($createdHechosExtraordinarios['id'], 'Created HechosExtraordinarios must have id specified');
        $this->assertNotNull(HechosExtraordinarios::find($createdHechosExtraordinarios['id']), 'HechosExtraordinarios with given id must be in DB');
        $this->assertModelData($hechosExtraordinarios, $createdHechosExtraordinarios);
    }

    /**
     * @test read
     */
    public function test_read_hechos_extraordinarios()
    {
        $hechosExtraordinarios = $this->makeHechosExtraordinarios();
        $dbHechosExtraordinarios = $this->hechosExtraordinariosRepo->find($hechosExtraordinarios->id);
        $dbHechosExtraordinarios = $dbHechosExtraordinarios->toArray();
        $this->assertModelData($hechosExtraordinarios->toArray(), $dbHechosExtraordinarios);
    }

    /**
     * @test update
     */
    public function test_update_hechos_extraordinarios()
    {
        $hechosExtraordinarios = $this->makeHechosExtraordinarios();
        $fakeHechosExtraordinarios = $this->fakeHechosExtraordinariosData();
        $updatedHechosExtraordinarios = $this->hechosExtraordinariosRepo->update($fakeHechosExtraordinarios, $hechosExtraordinarios->id);
        $this->assertModelData($fakeHechosExtraordinarios, $updatedHechosExtraordinarios->toArray());
        $dbHechosExtraordinarios = $this->hechosExtraordinariosRepo->find($hechosExtraordinarios->id);
        $this->assertModelData($fakeHechosExtraordinarios, $dbHechosExtraordinarios->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_hechos_extraordinarios()
    {
        $hechosExtraordinarios = $this->makeHechosExtraordinarios();
        $resp = $this->hechosExtraordinariosRepo->delete($hechosExtraordinarios->id);
        $this->assertTrue($resp);
        $this->assertNull(HechosExtraordinarios::find($hechosExtraordinarios->id), 'HechosExtraordinarios should not exist in DB');
    }
}
