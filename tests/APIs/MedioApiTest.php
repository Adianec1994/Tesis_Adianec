<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMedioTrait;
use Tests\ApiTestTrait;

class MedioApiTest extends TestCase
{
    use MakeMedioTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_medio()
    {
        $medio = $this->fakeMedioData();
        $this->response = $this->json('POST', '/api/medios', $medio);

        $this->assertApiResponse($medio);
    }

    /**
     * @test
     */
    public function test_read_medio()
    {
        $medio = $this->makeMedio();
        $this->response = $this->json('GET', '/api/medios/'.$medio->id);

        $this->assertApiResponse($medio->toArray());
    }

    /**
     * @test
     */
    public function test_update_medio()
    {
        $medio = $this->makeMedio();
        $editedMedio = $this->fakeMedioData();

        $this->response = $this->json('PUT', '/api/medios/'.$medio->id, $editedMedio);

        $this->assertApiResponse($editedMedio);
    }

    /**
     * @test
     */
    public function test_delete_medio()
    {
        $medio = $this->makeMedio();
        $this->response = $this->json('DELETE', '/api/medios/'.$medio->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/medios/'.$medio->id);

        $this->response->assertStatus(404);
    }
}
