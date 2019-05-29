<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePailasTrait;
use Tests\ApiTestTrait;

class PailasApiTest extends TestCase
{
    use MakePailasTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_pailas()
    {
        $pailas = $this->fakePailasData();
        $this->response = $this->json('POST', '/api/pailas', $pailas);

        $this->assertApiResponse($pailas);
    }

    /**
     * @test
     */
    public function test_read_pailas()
    {
        $pailas = $this->makePailas();
        $this->response = $this->json('GET', '/api/pailas/'.$pailas->id);

        $this->assertApiResponse($pailas->toArray());
    }

    /**
     * @test
     */
    public function test_update_pailas()
    {
        $pailas = $this->makePailas();
        $editedPailas = $this->fakePailasData();

        $this->response = $this->json('PUT', '/api/pailas/'.$pailas->id, $editedPailas);

        $this->assertApiResponse($editedPailas);
    }

    /**
     * @test
     */
    public function test_delete_pailas()
    {
        $pailas = $this->makePailas();
        $this->response = $this->json('DELETE', '/api/pailas/'.$pailas->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/pailas/'.$pailas->id);

        $this->response->assertStatus(404);
    }
}
