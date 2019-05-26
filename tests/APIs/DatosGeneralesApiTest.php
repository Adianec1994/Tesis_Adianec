<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeDatosGeneralesTrait;
use Tests\ApiTestTrait;

class DatosGeneralesApiTest extends TestCase
{
    use MakeDatosGeneralesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_datos_generales()
    {
        $datosGenerales = $this->fakeDatosGeneralesData();
        $this->response = $this->json('POST', '/api/datosGenerales', $datosGenerales);

        $this->assertApiResponse($datosGenerales);
    }

    /**
     * @test
     */
    public function test_read_datos_generales()
    {
        $datosGenerales = $this->makeDatosGenerales();
        $this->response = $this->json('GET', '/api/datosGenerales/'.$datosGenerales->id);

        $this->assertApiResponse($datosGenerales->toArray());
    }

    /**
     * @test
     */
    public function test_update_datos_generales()
    {
        $datosGenerales = $this->makeDatosGenerales();
        $editedDatosGenerales = $this->fakeDatosGeneralesData();

        $this->response = $this->json('PUT', '/api/datosGenerales/'.$datosGenerales->id, $editedDatosGenerales);

        $this->assertApiResponse($editedDatosGenerales);
    }

    /**
     * @test
     */
    public function test_delete_datos_generales()
    {
        $datosGenerales = $this->makeDatosGenerales();
        $this->response = $this->json('DELETE', '/api/datosGenerales/'.$datosGenerales->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/datosGenerales/'.$datosGenerales->id);

        $this->response->assertStatus(404);
    }
}
