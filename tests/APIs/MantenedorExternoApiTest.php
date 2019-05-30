<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeMantenedorExternoTrait;
use Tests\ApiTestTrait;

class MantenedorExternoApiTest extends TestCase
{
    use MakeMantenedorExternoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_mantenedor_externo()
    {
        $mantenedorExterno = $this->fakeMantenedorExternoData();
        $this->response = $this->json('POST', '/api/mantenedorExternos', $mantenedorExterno);

        $this->assertApiResponse($mantenedorExterno);
    }

    /**
     * @test
     */
    public function test_read_mantenedor_externo()
    {
        $mantenedorExterno = $this->makeMantenedorExterno();
        $this->response = $this->json('GET', '/api/mantenedorExternos/'.$mantenedorExterno->id);

        $this->assertApiResponse($mantenedorExterno->toArray());
    }

    /**
     * @test
     */
    public function test_update_mantenedor_externo()
    {
        $mantenedorExterno = $this->makeMantenedorExterno();
        $editedMantenedorExterno = $this->fakeMantenedorExternoData();

        $this->response = $this->json('PUT', '/api/mantenedorExternos/'.$mantenedorExterno->id, $editedMantenedorExterno);

        $this->assertApiResponse($editedMantenedorExterno);
    }

    /**
     * @test
     */
    public function test_delete_mantenedor_externo()
    {
        $mantenedorExterno = $this->makeMantenedorExterno();
        $this->response = $this->json('DELETE', '/api/mantenedorExternos/'.$mantenedorExterno->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/mantenedorExternos/'.$mantenedorExterno->id);

        $this->response->assertStatus(404);
    }
}
