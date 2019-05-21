<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeProvinciaTrait;
use Tests\ApiTestTrait;

class ProvinciaApiTest extends TestCase
{
    use MakeProvinciaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_provincia()
    {
        $provincia = $this->fakeProvinciaData();
        $this->response = $this->json('POST', '/api/provincias', $provincia);

        $this->assertApiResponse($provincia);
    }

    /**
     * @test
     */
    public function test_read_provincia()
    {
        $provincia = $this->makeProvincia();
        $this->response = $this->json('GET', '/api/provincias/'.$provincia->id);

        $this->assertApiResponse($provincia->toArray());
    }

    /**
     * @test
     */
    public function test_update_provincia()
    {
        $provincia = $this->makeProvincia();
        $editedProvincia = $this->fakeProvinciaData();

        $this->response = $this->json('PUT', '/api/provincias/'.$provincia->id, $editedProvincia);

        $this->assertApiResponse($editedProvincia);
    }

    /**
     * @test
     */
    public function test_delete_provincia()
    {
        $provincia = $this->makeProvincia();
        $this->response = $this->json('DELETE', '/api/provincias/'.$provincia->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/provincias/'.$provincia->id);

        $this->response->assertStatus(404);
    }
}
