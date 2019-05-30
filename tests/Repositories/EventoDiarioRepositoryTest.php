<?php namespace Tests\Repositories;

use App\Models\EventoDiario;
use App\Repositories\EventoDiarioRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeEventoDiarioTrait;
use Tests\ApiTestTrait;

class EventoDiarioRepositoryTest extends TestCase
{
    use MakeEventoDiarioTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var EventoDiarioRepository
     */
    protected $eventoDiarioRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->eventoDiarioRepo = \App::make(EventoDiarioRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_evento_diario()
    {
        $eventoDiario = $this->fakeEventoDiarioData();
        $createdEventoDiario = $this->eventoDiarioRepo->create($eventoDiario);
        $createdEventoDiario = $createdEventoDiario->toArray();
        $this->assertArrayHasKey('id', $createdEventoDiario);
        $this->assertNotNull($createdEventoDiario['id'], 'Created EventoDiario must have id specified');
        $this->assertNotNull(EventoDiario::find($createdEventoDiario['id']), 'EventoDiario with given id must be in DB');
        $this->assertModelData($eventoDiario, $createdEventoDiario);
    }

    /**
     * @test read
     */
    public function test_read_evento_diario()
    {
        $eventoDiario = $this->makeEventoDiario();
        $dbEventoDiario = $this->eventoDiarioRepo->find($eventoDiario->id);
        $dbEventoDiario = $dbEventoDiario->toArray();
        $this->assertModelData($eventoDiario->toArray(), $dbEventoDiario);
    }

    /**
     * @test update
     */
    public function test_update_evento_diario()
    {
        $eventoDiario = $this->makeEventoDiario();
        $fakeEventoDiario = $this->fakeEventoDiarioData();
        $updatedEventoDiario = $this->eventoDiarioRepo->update($fakeEventoDiario, $eventoDiario->id);
        $this->assertModelData($fakeEventoDiario, $updatedEventoDiario->toArray());
        $dbEventoDiario = $this->eventoDiarioRepo->find($eventoDiario->id);
        $this->assertModelData($fakeEventoDiario, $dbEventoDiario->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_evento_diario()
    {
        $eventoDiario = $this->makeEventoDiario();
        $resp = $this->eventoDiarioRepo->delete($eventoDiario->id);
        $this->assertTrue($resp);
        $this->assertNull(EventoDiario::find($eventoDiario->id), 'EventoDiario should not exist in DB');
    }
}
