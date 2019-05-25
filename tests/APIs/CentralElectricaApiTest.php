<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeCentralElectricaTrait;
use Tests\ApiTestTrait;

class CentralElectricaApiTest extends TestCase
{
    use MakeCentralElectricaTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_central_electrica()
    {
        $centralElectrica = $this->fakeCentralElectricaData();
        $this->response = $this->json('POST', '/api/centralElectricas', $centralElectrica);

        $this->assertApiResponse($centralElectrica);
    }

    /**
     * @test
     */
    public function test_read_central_electrica()
    {
        $centralElectrica = $this->makeCentralElectrica();
        $this->response = $this->json('GET', '/api/centralElectricas/'.$centralElectrica->id);

        $this->assertApiResponse($centralElectrica->toArray());
    }

    /**
     * @test
     */
    public function test_update_central_electrica()
    {
        $centralElectrica = $this->makeCentralElectrica();
        $editedCentralElectrica = $this->fakeCentralElectricaData();

        $this->response = $this->json('PUT', '/api/centralElectricas/'.$centralElectrica->id, $editedCentralElectrica);

        $this->assertApiResponse($editedCentralElectrica);
    }

    /**
     * @test
     */
    public function test_delete_central_electrica()
    {
        $centralElectrica = $this->makeCentralElectrica();
        $this->response = $this->json('DELETE', '/api/centralElectricas/'.$centralElectrica->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/centralElectricas/'.$centralElectrica->id);

        $this->response->assertStatus(404);
    }
}
