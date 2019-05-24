<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeHechosExtraordinariosTrait;
use Tests\ApiTestTrait;

class HechosExtraordinariosApiTest extends TestCase
{
    use MakeHechosExtraordinariosTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_hechos_extraordinarios()
    {
        $hechosExtraordinarios = $this->fakeHechosExtraordinariosData();
        $this->response = $this->json('POST', '/api/hechosExtraordinarios', $hechosExtraordinarios);

        $this->assertApiResponse($hechosExtraordinarios);
    }

    /**
     * @test
     */
    public function test_read_hechos_extraordinarios()
    {
        $hechosExtraordinarios = $this->makeHechosExtraordinarios();
        $this->response = $this->json('GET', '/api/hechosExtraordinarios/'.$hechosExtraordinarios->id);

        $this->assertApiResponse($hechosExtraordinarios->toArray());
    }

    /**
     * @test
     */
    public function test_update_hechos_extraordinarios()
    {
        $hechosExtraordinarios = $this->makeHechosExtraordinarios();
        $editedHechosExtraordinarios = $this->fakeHechosExtraordinariosData();

        $this->response = $this->json('PUT', '/api/hechosExtraordinarios/'.$hechosExtraordinarios->id, $editedHechosExtraordinarios);

        $this->assertApiResponse($editedHechosExtraordinarios);
    }

    /**
     * @test
     */
    public function test_delete_hechos_extraordinarios()
    {
        $hechosExtraordinarios = $this->makeHechosExtraordinarios();
        $this->response = $this->json('DELETE', '/api/hechosExtraordinarios/'.$hechosExtraordinarios->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/hechosExtraordinarios/'.$hechosExtraordinarios->id);

        $this->response->assertStatus(404);
    }
}
