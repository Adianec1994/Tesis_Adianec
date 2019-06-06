<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeInfoTrait;
use Tests\ApiTestTrait;

class InfoApiTest extends TestCase
{
    use MakeInfoTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_info()
    {
        $info = $this->fakeInfoData();
        $this->response = $this->json('POST', '/api/infos', $info);

        $this->assertApiResponse($info);
    }

    /**
     * @test
     */
    public function test_read_info()
    {
        $info = $this->makeInfo();
        $this->response = $this->json('GET', '/api/infos/'.$info->id);

        $this->assertApiResponse($info->toArray());
    }

    /**
     * @test
     */
    public function test_update_info()
    {
        $info = $this->makeInfo();
        $editedInfo = $this->fakeInfoData();

        $this->response = $this->json('PUT', '/api/infos/'.$info->id, $editedInfo);

        $this->assertApiResponse($editedInfo);
    }

    /**
     * @test
     */
    public function test_delete_info()
    {
        $info = $this->makeInfo();
        $this->response = $this->json('DELETE', '/api/infos/'.$info->id);

        $this->assertApiSuccess();
        $this->response = $this->json('GET', '/api/infos/'.$info->id);

        $this->response->assertStatus(404);
    }
}
