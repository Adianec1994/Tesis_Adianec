<?php namespace Tests\Repositories;

use App\Models\Baterias;
use App\Repositories\BateriasRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBateriasTrait;
use Tests\ApiTestTrait;

class BateriasRepositoryTest extends TestCase
{
    use MakeBateriasTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BateriasRepository
     */
    protected $bateriasRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->bateriasRepo = \App::make(BateriasRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_baterias()
    {
        $baterias = $this->fakeBateriasData();
        $createdBaterias = $this->bateriasRepo->create($baterias);
        $createdBaterias = $createdBaterias->toArray();
        $this->assertArrayHasKey('id', $createdBaterias);
        $this->assertNotNull($createdBaterias['id'], 'Created Baterias must have id specified');
        $this->assertNotNull(Baterias::find($createdBaterias['id']), 'Baterias with given id must be in DB');
        $this->assertModelData($baterias, $createdBaterias);
    }

    /**
     * @test read
     */
    public function test_read_baterias()
    {
        $baterias = $this->makeBaterias();
        $dbBaterias = $this->bateriasRepo->find($baterias->id);
        $dbBaterias = $dbBaterias->toArray();
        $this->assertModelData($baterias->toArray(), $dbBaterias);
    }

    /**
     * @test update
     */
    public function test_update_baterias()
    {
        $baterias = $this->makeBaterias();
        $fakeBaterias = $this->fakeBateriasData();
        $updatedBaterias = $this->bateriasRepo->update($fakeBaterias, $baterias->id);
        $this->assertModelData($fakeBaterias, $updatedBaterias->toArray());
        $dbBaterias = $this->bateriasRepo->find($baterias->id);
        $this->assertModelData($fakeBaterias, $dbBaterias->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_baterias()
    {
        $baterias = $this->makeBaterias();
        $resp = $this->bateriasRepo->delete($baterias->id);
        $this->assertTrue($resp);
        $this->assertNull(Baterias::find($baterias->id), 'Baterias should not exist in DB');
    }
}
