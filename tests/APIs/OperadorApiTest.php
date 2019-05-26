<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeOperadorTrait;
use Tests\ApiTestTrait;

class OperadorApiTest extends TestCase
{
    use MakeOperadorTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_operador()
    {
        $operador = $this->fakeOperadorData();
        $this->response = $this->json('POST', '/api/operadors', $operador);

        $this->assertApiResponse($operador);
    }

    /**
     * @test
     */
    public function test_read_operador()
    {
        $operador = $this->makeOperador();
        $this->response = $this->json('GET', '/api/operadors/'.$operador->id);

        $this->assertApiResponse($operador->toArray());
    }

    /**
     * @test
     */
    public function test_update_operador()
    {
        $operador = $this->makeOperador();
        $editedOperador = $this->fakeOperadorData();

        $this->response = $this->json('PUT', '/api/operadors/'.$operador->id, $editedOperador);

        $this->assertApiResponse($editedOperador);
    }

    /**
     * @test
     */
    public function test_delete_operador()
    {
        $operador = $this->makeOperador();
        $this->response = $this->json('DELETE', '/api/operadors/'.$operador->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/operadors/'.$operador->id);

        $this->response->assertStatus(404);
    }
}
