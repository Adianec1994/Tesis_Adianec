<?php namespace Tests\Repositories;

use App\Models\Provincia;
use App\Repositories\ProvinciaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeProvinciaTrait;
use Tests\ApiTestTrait;

class ProvinciaRepositoryTest extends TestCase
{
    use MakeProvinciaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProvinciaRepository
     */
    protected $provinciaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->provinciaRepo = \App::make(ProvinciaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_provincia()
    {
        $provincia = $this->fakeProvinciaData();
        $createdProvincia = $this->provinciaRepo->create($provincia);
        $createdProvincia = $createdProvincia->toArray();
        $this->assertArrayHasKey('id', $createdProvincia);
        $this->assertNotNull($createdProvincia['id'], 'Created Provincia must have id specified');
        $this->assertNotNull(Provincia::find($createdProvincia['id']), 'Provincia with given id must be in DB');
        $this->assertModelData($provincia, $createdProvincia);
    }

    /**
     * @test read
     */
    public function test_read_provincia()
    {
        $provincia = $this->makeProvincia();
        $dbProvincia = $this->provinciaRepo->find($provincia->id);
        $dbProvincia = $dbProvincia->toArray();
        $this->assertModelData($provincia->toArray(), $dbProvincia);
    }

    /**
     * @test update
     */
    public function test_update_provincia()
    {
        $provincia = $this->makeProvincia();
        $fakeProvincia = $this->fakeProvinciaData();
        $updatedProvincia = $this->provinciaRepo->update($fakeProvincia, $provincia->id);
        $this->assertModelData($fakeProvincia, $updatedProvincia->toArray());
        $dbProvincia = $this->provinciaRepo->find($provincia->id);
        $this->assertModelData($fakeProvincia, $dbProvincia->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_provincia()
    {
        $provincia = $this->makeProvincia();
        $resp = $this->provinciaRepo->delete($provincia->id);
        $this->assertTrue($resp);
        $this->assertNull(Provincia::find($provincia->id), 'Provincia should not exist in DB');
    }
}
