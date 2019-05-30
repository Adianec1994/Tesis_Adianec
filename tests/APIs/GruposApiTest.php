<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeGruposTrait;
use Tests\ApiTestTrait;

class GruposApiTest extends TestCase
{
    use MakeGruposTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_grupos()
    {
        $grupos = $this->fakeGruposData();
        $this->response = $this->json('POST', '/api/grupos', $grupos);

        $this->assertApiResponse($grupos);
    }

    /**
     * @test
     */
    public function test_read_grupos()
    {
        $grupos = $this->makeGrupos();
        $this->response = $this->json('GET', '/api/grupos/'.$grupos->id);

        $this->assertApiResponse($grupos->toArray());
    }

    /**
     * @test
     */
    public function test_update_grupos()
    {
        $grupos = $this->makeGrupos();
        $editedGrupos = $this->fakeGruposData();

        $this->response = $this->json('PUT', '/api/grupos/'.$grupos->id, $editedGrupos);

        $this->assertApiResponse($editedGrupos);
    }

    /**
     * @test
     */
    public function test_delete_grupos()
    {
        $grupos = $this->makeGrupos();
        $this->response = $this->json('DELETE', '/api/grupos/'.$grupos->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/grupos/'.$grupos->id);

        $this->response->assertStatus(404);
    }
}
