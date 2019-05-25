<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCoberturaCombustibleTrait;
use Tests\ApiTestTrait;

class CoberturaCombustibleApiTest extends TestCase
{
    use MakeCoberturaCombustibleTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_cobertura_combustible()
    {
        $coberturaCombustible = $this->fakeCoberturaCombustibleData();
        $this->response = $this->json('POST', '/api/coberturaCombustibles', $coberturaCombustible);

        $this->assertApiResponse($coberturaCombustible);
    }

    /**
     * @test
     */
    public function test_read_cobertura_combustible()
    {
        $coberturaCombustible = $this->makeCoberturaCombustible();
        $this->response = $this->json('GET', '/api/coberturaCombustibles/'.$coberturaCombustible->id);

        $this->assertApiResponse($coberturaCombustible->toArray());
    }

    /**
     * @test
     */
    public function test_update_cobertura_combustible()
    {
        $coberturaCombustible = $this->makeCoberturaCombustible();
        $editedCoberturaCombustible = $this->fakeCoberturaCombustibleData();

        $this->response = $this->json('PUT', '/api/coberturaCombustibles/'.$coberturaCombustible->id, $editedCoberturaCombustible);

        $this->assertApiResponse($editedCoberturaCombustible);
    }

    /**
     * @test
     */
    public function test_delete_cobertura_combustible()
    {
        $coberturaCombustible = $this->makeCoberturaCombustible();
        $this->response = $this->json('DELETE', '/api/coberturaCombustibles/'.$coberturaCombustible->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/coberturaCombustibles/'.$coberturaCombustible->id);

        $this->response->assertStatus(404);
    }
}
