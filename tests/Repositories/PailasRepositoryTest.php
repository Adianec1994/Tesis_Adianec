<?php namespace Tests\Repositories;

use App\Models\Pailas;
use App\Repositories\PailasRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePailasTrait;
use Tests\ApiTestTrait;

class PailasRepositoryTest extends TestCase
{
    use MakePailasTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PailasRepository
     */
    protected $pailasRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->pailasRepo = \App::make(PailasRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_pailas()
    {
        $pailas = $this->fakePailasData();
        $createdPailas = $this->pailasRepo->create($pailas);
        $createdPailas = $createdPailas->toArray();
        $this->assertArrayHasKey('id', $createdPailas);
        $this->assertNotNull($createdPailas['id'], 'Created Pailas must have id specified');
        $this->assertNotNull(Pailas::find($createdPailas['id']), 'Pailas with given id must be in DB');
        $this->assertModelData($pailas, $createdPailas);
    }

    /**
     * @test read
     */
    public function test_read_pailas()
    {
        $pailas = $this->makePailas();
        $dbPailas = $this->pailasRepo->find($pailas->id);
        $dbPailas = $dbPailas->toArray();
        $this->assertModelData($pailas->toArray(), $dbPailas);
    }

    /**
     * @test update
     */
    public function test_update_pailas()
    {
        $pailas = $this->makePailas();
        $fakePailas = $this->fakePailasData();
        $updatedPailas = $this->pailasRepo->update($fakePailas, $pailas->id);
        $this->assertModelData($fakePailas, $updatedPailas->toArray());
        $dbPailas = $this->pailasRepo->find($pailas->id);
        $this->assertModelData($fakePailas, $dbPailas->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_pailas()
    {
        $pailas = $this->makePailas();
        $resp = $this->pailasRepo->delete($pailas->id);
        $this->assertTrue($resp);
        $this->assertNull(Pailas::find($pailas->id), 'Pailas should not exist in DB');
    }
}
