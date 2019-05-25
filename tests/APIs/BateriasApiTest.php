<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBateriasTrait;
use Tests\ApiTestTrait;

class BateriasApiTest extends TestCase
{
    use MakeBateriasTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_baterias()
    {
        $baterias = $this->fakeBateriasData();
        $this->response = $this->json('POST', '/api/baterias', $baterias);

        $this->assertApiResponse($baterias);
    }

    /**
     * @test
     */
    public function test_read_baterias()
    {
        $baterias = $this->makeBaterias();
        $this->response = $this->json('GET', '/api/baterias/'.$baterias->id);

        $this->assertApiResponse($baterias->toArray());
    }

    /**
     * @test
     */
    public function test_update_baterias()
    {
        $baterias = $this->makeBaterias();
        $editedBaterias = $this->fakeBateriasData();

        $this->response = $this->json('PUT', '/api/baterias/'.$baterias->id, $editedBaterias);

        $this->assertApiResponse($editedBaterias);
    }

    /**
     * @test
     */
    public function test_delete_baterias()
    {
        $baterias = $this->makeBaterias();
        $this->response = $this->json('DELETE', '/api/baterias/'.$baterias->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/baterias/'.$baterias->id);

        $this->response->assertStatus(404);
    }
}
