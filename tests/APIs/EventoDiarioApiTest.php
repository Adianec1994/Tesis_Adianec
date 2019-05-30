<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeEventoDiarioTrait;
use Tests\ApiTestTrait;

class EventoDiarioApiTest extends TestCase
{
    use MakeEventoDiarioTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_evento_diario()
    {
        $eventoDiario = $this->fakeEventoDiarioData();
        $this->response = $this->json('POST', '/api/eventoDiarios', $eventoDiario);

        $this->assertApiResponse($eventoDiario);
    }

    /**
     * @test
     */
    public function test_read_evento_diario()
    {
        $eventoDiario = $this->makeEventoDiario();
        $this->response = $this->json('GET', '/api/eventoDiarios/'.$eventoDiario->id);

        $this->assertApiResponse($eventoDiario->toArray());
    }

    /**
     * @test
     */
    public function test_update_evento_diario()
    {
        $eventoDiario = $this->makeEventoDiario();
        $editedEventoDiario = $this->fakeEventoDiarioData();

        $this->response = $this->json('PUT', '/api/eventoDiarios/'.$eventoDiario->id, $editedEventoDiario);

        $this->assertApiResponse($editedEventoDiario);
    }

    /**
     * @test
     */
    public function test_delete_evento_diario()
    {
        $eventoDiario = $this->makeEventoDiario();
        $this->response = $this->json('DELETE', '/api/eventoDiarios/'.$eventoDiario->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/eventoDiarios/'.$eventoDiario->id);

        $this->response->assertStatus(404);
    }
}
