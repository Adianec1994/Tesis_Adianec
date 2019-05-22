<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDisponibilidadTrait;
use Tests\ApiTestTrait;

class DisponibilidadApiTest extends TestCase
{
    use MakeDisponibilidadTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_disponibilidad()
    {
        $disponibilidad = $this->fakeDisponibilidadData();
        $this->response = $this->json('POST', '/api/disponibilidads', $disponibilidad);

        $this->assertApiResponse($disponibilidad);
    }

    /**
     * @test
     */
    public function test_read_disponibilidad()
    {
        $disponibilidad = $this->makeDisponibilidad();
        $this->response = $this->json('GET', '/api/disponibilidads/'.$disponibilidad->id);

        $this->assertApiResponse($disponibilidad->toArray());
    }

    /**
     * @test
     */
    public function test_update_disponibilidad()
    {
        $disponibilidad = $this->makeDisponibilidad();
        $editedDisponibilidad = $this->fakeDisponibilidadData();

        $this->response = $this->json('PUT', '/api/disponibilidads/'.$disponibilidad->id, $editedDisponibilidad);

        $this->assertApiResponse($editedDisponibilidad);
    }

    /**
     * @test
     */
    public function test_delete_disponibilidad()
    {
        $disponibilidad = $this->makeDisponibilidad();
        $this->response = $this->json('DELETE', '/api/disponibilidads/'.$disponibilidad->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/disponibilidads/'.$disponibilidad->id);

        $this->response->assertStatus(404);
    }
}
