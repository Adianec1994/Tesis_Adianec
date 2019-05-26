<?php namespace Tests\Repositories;

use App\Models\Operador;
use App\Repositories\OperadorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeOperadorTrait;
use Tests\ApiTestTrait;

class OperadorRepositoryTest extends TestCase
{
    use MakeOperadorTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OperadorRepository
     */
    protected $operadorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->operadorRepo = \App::make(OperadorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_operador()
    {
        $operador = $this->fakeOperadorData();
        $createdOperador = $this->operadorRepo->create($operador);
        $createdOperador = $createdOperador->toArray();
        $this->assertArrayHasKey('id', $createdOperador);
        $this->assertNotNull($createdOperador['id'], 'Created Operador must have id specified');
        $this->assertNotNull(Operador::find($createdOperador['id']), 'Operador with given id must be in DB');
        $this->assertModelData($operador, $createdOperador);
    }

    /**
     * @test read
     */
    public function test_read_operador()
    {
        $operador = $this->makeOperador();
        $dbOperador = $this->operadorRepo->find($operador->id);
        $dbOperador = $dbOperador->toArray();
        $this->assertModelData($operador->toArray(), $dbOperador);
    }

    /**
     * @test update
     */
    public function test_update_operador()
    {
        $operador = $this->makeOperador();
        $fakeOperador = $this->fakeOperadorData();
        $updatedOperador = $this->operadorRepo->update($fakeOperador, $operador->id);
        $this->assertModelData($fakeOperador, $updatedOperador->toArray());
        $dbOperador = $this->operadorRepo->find($operador->id);
        $this->assertModelData($fakeOperador, $dbOperador->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_operador()
    {
        $operador = $this->makeOperador();
        $resp = $this->operadorRepo->delete($operador->id);
        $this->assertTrue($resp);
        $this->assertNull(Operador::find($operador->id), 'Operador should not exist in DB');
    }
}
