<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlanesTrait;
use Tests\ApiTestTrait;

class PlanesApiTest extends TestCase
{
    use MakePlanesTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_planes()
    {
        $planes = $this->fakePlanesData();
        $this->response = $this->json('POST', '/api/planes', $planes);

        $this->assertApiResponse($planes);
    }

    /**
     * @test
     */
    public function test_read_planes()
    {
        $planes = $this->makePlanes();
        $this->response = $this->json('GET', '/api/planes/'.$planes->id);

        $this->assertApiResponse($planes->toArray());
    }

    /**
     * @test
     */
    public function test_update_planes()
    {
        $planes = $this->makePlanes();
        $editedPlanes = $this->fakePlanesData();

        $this->response = $this->json('PUT', '/api/planes/'.$planes->id, $editedPlanes);

        $this->assertApiResponse($editedPlanes);
    }

    /**
     * @test
     */
    public function test_delete_planes()
    {
        $planes = $this->makePlanes();
        $this->response = $this->json('DELETE', '/api/planes/'.$planes->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/planes/'.$planes->id);

        $this->response->assertStatus(404);
    }
}
