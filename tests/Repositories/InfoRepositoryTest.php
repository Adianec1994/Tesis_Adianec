<?php namespace Tests\Repositories;

use App\Models\Info;
use App\Repositories\InfoRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeInfoTrait;
use Tests\ApiTestTrait;

class InfoRepositoryTest extends TestCase
{
    use MakeInfoTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var InfoRepository
     */
    protected $infoRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->infoRepo = \App::make(InfoRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_info()
    {
        $info = $this->fakeInfoData();
        $createdInfo = $this->infoRepo->create($info);
        $createdInfo = $createdInfo->toArray();
        $this->assertArrayHasKey('id', $createdInfo);
        $this->assertNotNull($createdInfo['id'], 'Created Info must have id specified');
        $this->assertNotNull(Info::find($createdInfo['id']), 'Info with given id must be in DB');
        $this->assertModelData($info, $createdInfo);
    }

    /**
     * @test read
     */
    public function test_read_info()
    {
        $info = $this->makeInfo();
        $dbInfo = $this->infoRepo->find($info->id);
        $dbInfo = $dbInfo->toArray();
        $this->assertModelData($info->toArray(), $dbInfo);
    }

    /**
     * @test update
     */
    public function test_update_info()
    {
        $info = $this->makeInfo();
        $fakeInfo = $this->fakeInfoData();
        $updatedInfo = $this->infoRepo->update($fakeInfo, $info->id);
        $this->assertModelData($fakeInfo, $updatedInfo->toArray());
        $dbInfo = $this->infoRepo->find($info->id);
        $this->assertModelData($fakeInfo, $dbInfo->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_info()
    {
        $info = $this->makeInfo();
        $resp = $this->infoRepo->delete($info->id);
        $this->assertTrue($resp);
        $this->assertNull(Info::find($info->id), 'Info should not exist in DB');
    }
}
