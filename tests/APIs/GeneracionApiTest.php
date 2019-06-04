<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGeneracionTrait;
use Tests\ApiTestTrait;

class GeneracionApiTest extends TestCase
{
    use MakeGeneracionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_generacion()
    {
        $generacion = $this->fakeGeneracionData();
        $this->response = $this->json('POST', '/api/generacions', $generacion);

        $this->assertApiResponse($generacion);
    }

    /**
     * @test
     */
    public function test_read_generacion()
    {
        $generacion = $this->makeGeneracion();
        $this->response = $this->json('GET', '/api/generacions/'.$generacion->id);

        $this->assertApiResponse($generacion->toArray());
    }

    /**
     * @test
     */
    public function test_update_generacion()
    {
        $generacion = $this->makeGeneracion();
        $editedGeneracion = $this->fakeGeneracionData();

        $this->response = $this->json('PUT', '/api/generacions/'.$generacion->id, $editedGeneracion);

        $this->assertApiResponse($editedGeneracion);
    }

    /**
     * @test
     */
    public function test_delete_generacion()
    {
        $generacion = $this->makeGeneracion();
        $this->response = $this->json('DELETE', '/api/generacions/'.$generacion->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/generacions/'.$generacion->id);

        $this->response->assertStatus(404);
    }
}
