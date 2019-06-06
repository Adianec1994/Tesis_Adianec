<?php namespace Tests\Repositories;

use App\Models\Medio;
use App\Repositories\MedioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedioTrait;
use Tests\ApiTestTrait;

class MedioRepositoryTest extends TestCase
{
    use MakeMedioTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var MedioRepository
     */
    protected $medioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->medioRepo = \App::make(MedioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_medio()
    {
        $medio = $this->fakeMedioData();
        $createdMedio = $this->medioRepo->create($medio);
        $createdMedio = $createdMedio->toArray();
        $this->assertArrayHasKey('id', $createdMedio);
        $this->assertNotNull($createdMedio['id'], 'Created Medio must have id specified');
        $this->assertNotNull(Medio::find($createdMedio['id']), 'Medio with given id must be in DB');
        $this->assertModelData($medio, $createdMedio);
    }

    /**
     * @test read
     */
    public function test_read_medio()
    {
        $medio = $this->makeMedio();
        $dbMedio = $this->medioRepo->find($medio->id);
        $dbMedio = $dbMedio->toArray();
        $this->assertModelData($medio->toArray(), $dbMedio);
    }

    /**
     * @test update
     */
    public function test_update_medio()
    {
        $medio = $this->makeMedio();
        $fakeMedio = $this->fakeMedioData();
        $updatedMedio = $this->medioRepo->update($fakeMedio, $medio->id);
        $this->assertModelData($fakeMedio, $updatedMedio->toArray());
        $dbMedio = $this->medioRepo->find($medio->id);
        $this->assertModelData($fakeMedio, $dbMedio->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_medio()
    {
        $medio = $this->makeMedio();
        $resp = $this->medioRepo->delete($medio->id);
        $this->assertTrue($resp);
        $this->assertNull(Medio::find($medio->id), 'Medio should not exist in DB');
    }
}
