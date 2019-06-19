<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeTrazaTrait;
use Tests\ApiTestTrait;

class TrazaApiTest extends TestCase
{
    use MakeTrazaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_traza()
    {
        $traza = $this->fakeTrazaData();
        $this->response = $this->json('POST', '/api/trazas', $traza);

        $this->assertApiResponse($traza);
    }

    /**
     * @test
     */
    public function test_read_traza()
    {
        $traza = $this->makeTraza();
        $this->response = $this->json('GET', '/api/trazas/'.$traza->id);

        $this->assertApiResponse($traza->toArray());
    }

    /**
     * @test
     */
    public function test_update_traza()
    {
        $traza = $this->makeTraza();
        $editedTraza = $this->fakeTrazaData();

        $this->response = $this->json('PUT', '/api/trazas/'.$traza->id, $editedTraza);

        $this->assertApiResponse($editedTraza);
    }

    /**
     * @test
     */
    public function test_delete_traza()
    {
        $traza = $this->makeTraza();
        $this->response = $this->json('DELETE', '/api/trazas/'.$traza->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/trazas/'.$traza->id);

        $this->response->assertStatus(404);
    }
}
