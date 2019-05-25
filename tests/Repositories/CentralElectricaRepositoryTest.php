<?php namespace Tests\Repositories;

use App\Models\CentralElectrica;
use App\Repositories\CentralElectricaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCentralElectricaTrait;
use Tests\ApiTestTrait;

class CentralElectricaRepositoryTest extends TestCase
{
    use MakeCentralElectricaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CentralElectricaRepository
     */
    protected $centralElectricaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->centralElectricaRepo = \App::make(CentralElectricaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_central_electrica()
    {
        $centralElectrica = $this->fakeCentralElectricaData();
        $createdCentralElectrica = $this->centralElectricaRepo->create($centralElectrica);
        $createdCentralElectrica = $createdCentralElectrica->toArray();
        $this->assertArrayHasKey('id', $createdCentralElectrica);
        $this->assertNotNull($createdCentralElectrica['id'], 'Created CentralElectrica must have id specified');
        $this->assertNotNull(CentralElectrica::find($createdCentralElectrica['id']), 'CentralElectrica with given id must be in DB');
        $this->assertModelData($centralElectrica, $createdCentralElectrica);
    }

    /**
     * @test read
     */
    public function test_read_central_electrica()
    {
        $centralElectrica = $this->makeCentralElectrica();
        $dbCentralElectrica = $this->centralElectricaRepo->find($centralElectrica->id);
        $dbCentralElectrica = $dbCentralElectrica->toArray();
        $this->assertModelData($centralElectrica->toArray(), $dbCentralElectrica);
    }

    /**
     * @test update
     */
    public function test_update_central_electrica()
    {
        $centralElectrica = $this->makeCentralElectrica();
        $fakeCentralElectrica = $this->fakeCentralElectricaData();
        $updatedCentralElectrica = $this->centralElectricaRepo->update($fakeCentralElectrica, $centralElectrica->id);
        $this->assertModelData($fakeCentralElectrica, $updatedCentralElectrica->toArray());
        $dbCentralElectrica = $this->centralElectricaRepo->find($centralElectrica->id);
        $this->assertModelData($fakeCentralElectrica, $dbCentralElectrica->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_central_electrica()
    {
        $centralElectrica = $this->makeCentralElectrica();
        $resp = $this->centralElectricaRepo->delete($centralElectrica->id);
        $this->assertTrue($resp);
        $this->assertNull(CentralElectrica::find($centralElectrica->id), 'CentralElectrica should not exist in DB');
    }
}
