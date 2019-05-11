<?php namespace Tests\Repositories;

use App\Models\Proveedor;
use App\Repositories\ProveedorRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeProveedorTrait;
use Tests\ApiTestTrait;

class ProveedorRepositoryTest extends TestCase
{
    use MakeProveedorTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ProveedorRepository
     */
    protected $proveedorRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->proveedorRepo = \App::make(ProveedorRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_proveedor()
    {
        $proveedor = $this->fakeProveedorData();
        $createdProveedor = $this->proveedorRepo->create($proveedor);
        $createdProveedor = $createdProveedor->toArray();
        $this->assertArrayHasKey('id', $createdProveedor);
        $this->assertNotNull($createdProveedor['id'], 'Created Proveedor must have id specified');
        $this->assertNotNull(Proveedor::find($createdProveedor['id']), 'Proveedor with given id must be in DB');
        $this->assertModelData($proveedor, $createdProveedor);
    }

    /**
     * @test read
     */
    public function test_read_proveedor()
    {
        $proveedor = $this->makeProveedor();
        $dbProveedor = $this->proveedorRepo->find($proveedor->id);
        $dbProveedor = $dbProveedor->toArray();
        $this->assertModelData($proveedor->toArray(), $dbProveedor);
    }

    /**
     * @test update
     */
    public function test_update_proveedor()
    {
        $proveedor = $this->makeProveedor();
        $fakeProveedor = $this->fakeProveedorData();
        $updatedProveedor = $this->proveedorRepo->update($fakeProveedor, $proveedor->id);
        $this->assertModelData($fakeProveedor, $updatedProveedor->toArray());
        $dbProveedor = $this->proveedorRepo->find($proveedor->id);
        $this->assertModelData($fakeProveedor, $dbProveedor->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_proveedor()
    {
        $proveedor = $this->makeProveedor();
        $resp = $this->proveedorRepo->delete($proveedor->id);
        $this->assertTrue($resp);
        $this->assertNull(Proveedor::find($proveedor->id), 'Proveedor should not exist in DB');
    }
}
