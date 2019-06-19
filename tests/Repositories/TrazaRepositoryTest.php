<?php namespace Tests\Repositories;

use App\Models\Traza;
use App\Repositories\TrazaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTrazaTrait;
use Tests\ApiTestTrait;

class TrazaRepositoryTest extends TestCase
{
    use MakeTrazaTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var TrazaRepository
     */
    protected $trazaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->trazaRepo = \App::make(TrazaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_traza()
    {
        $traza = $this->fakeTrazaData();
        $createdTraza = $this->trazaRepo->create($traza);
        $createdTraza = $createdTraza->toArray();
        $this->assertArrayHasKey('id', $createdTraza);
        $this->assertNotNull($createdTraza['id'], 'Created Traza must have id specified');
        $this->assertNotNull(Traza::find($createdTraza['id']), 'Traza with given id must be in DB');
        $this->assertModelData($traza, $createdTraza);
    }

    /**
     * @test read
     */
    public function test_read_traza()
    {
        $traza = $this->makeTraza();
        $dbTraza = $this->trazaRepo->find($traza->id);
        $dbTraza = $dbTraza->toArray();
        $this->assertModelData($traza->toArray(), $dbTraza);
    }

    /**
     * @test update
     */
    public function test_update_traza()
    {
        $traza = $this->makeTraza();
        $fakeTraza = $this->fakeTrazaData();
        $updatedTraza = $this->trazaRepo->update($fakeTraza, $traza->id);
        $this->assertModelData($fakeTraza, $updatedTraza->toArray());
        $dbTraza = $this->trazaRepo->find($traza->id);
        $this->assertModelData($fakeTraza, $dbTraza->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_traza()
    {
        $traza = $this->makeTraza();
        $resp = $this->trazaRepo->delete($traza->id);
        $this->assertTrue($resp);
        $this->assertNull(Traza::find($traza->id), 'Traza should not exist in DB');
    }
}
