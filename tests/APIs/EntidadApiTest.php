<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeEntidadTrait;
use Tests\ApiTestTrait;

class EntidadApiTest extends TestCase
{
    use MakeEntidadTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_entidad()
    {
        $entidad = $this->fakeEntidadData();
        $this->response = $this->json('POST', '/api/entidads', $entidad);

        $this->assertApiResponse($entidad);
    }

    /**
     * @test
     */
    public function test_read_entidad()
    {
        $entidad = $this->makeEntidad();
        $this->response = $this->json('GET', '/api/entidads/'.$entidad->id);

        $this->assertApiResponse($entidad->toArray());
    }

    /**
     * @test
     */
    public function test_update_entidad()
    {
        $entidad = $this->makeEntidad();
        $editedEntidad = $this->fakeEntidadData();

        $this->response = $this->json('PUT', '/api/entidads/'.$entidad->id, $editedEntidad);

        $this->assertApiResponse($editedEntidad);
    }

    /**
     * @test
     */
    public function test_delete_entidad()
    {
        $entidad = $this->makeEntidad();
        $this->response = $this->json('DELETE', '/api/entidads/'.$entidad->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/entidads/'.$entidad->id);

        $this->response->assertStatus(404);
    }
}
