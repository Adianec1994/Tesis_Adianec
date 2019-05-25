<?php namespace Tests\Repositories;

use App\Models\CoberturaCombustible;
use App\Repositories\CoberturaCombustibleRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCoberturaCombustibleTrait;
use Tests\ApiTestTrait;

class CoberturaCombustibleRepositoryTest extends TestCase
{
    use MakeCoberturaCombustibleTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CoberturaCombustibleRepository
     */
    protected $coberturaCombustibleRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->coberturaCombustibleRepo = \App::make(CoberturaCombustibleRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_cobertura_combustible()
    {
        $coberturaCombustible = $this->fakeCoberturaCombustibleData();
        $createdCoberturaCombustible = $this->coberturaCombustibleRepo->create($coberturaCombustible);
        $createdCoberturaCombustible = $createdCoberturaCombustible->toArray();
        $this->assertArrayHasKey('id', $createdCoberturaCombustible);
        $this->assertNotNull($createdCoberturaCombustible['id'], 'Created CoberturaCombustible must have id specified');
        $this->assertNotNull(CoberturaCombustible::find($createdCoberturaCombustible['id']), 'CoberturaCombustible with given id must be in DB');
        $this->assertModelData($coberturaCombustible, $createdCoberturaCombustible);
    }

    /**
     * @test read
     */
    public function test_read_cobertura_combustible()
    {
        $coberturaCombustible = $this->makeCoberturaCombustible();
        $dbCoberturaCombustible = $this->coberturaCombustibleRepo->find($coberturaCombustible->id);
        $dbCoberturaCombustible = $dbCoberturaCombustible->toArray();
        $this->assertModelData($coberturaCombustible->toArray(), $dbCoberturaCombustible);
    }

    /**
     * @test update
     */
    public function test_update_cobertura_combustible()
    {
        $coberturaCombustible = $this->makeCoberturaCombustible();
        $fakeCoberturaCombustible = $this->fakeCoberturaCombustibleData();
        $updatedCoberturaCombustible = $this->coberturaCombustibleRepo->update($fakeCoberturaCombustible, $coberturaCombustible->id);
        $this->assertModelData($fakeCoberturaCombustible, $updatedCoberturaCombustible->toArray());
        $dbCoberturaCombustible = $this->coberturaCombustibleRepo->find($coberturaCombustible->id);
        $this->assertModelData($fakeCoberturaCombustible, $dbCoberturaCombustible->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_cobertura_combustible()
    {
        $coberturaCombustible = $this->makeCoberturaCombustible();
        $resp = $this->coberturaCombustibleRepo->delete($coberturaCombustible->id);
        $this->assertTrue($resp);
        $this->assertNull(CoberturaCombustible::find($coberturaCombustible->id), 'CoberturaCombustible should not exist in DB');
    }
}
