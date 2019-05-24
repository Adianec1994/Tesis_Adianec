<?php namespace Tests\Repositories;

use App\Models\Planes;
use App\Repositories\PlanesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakePlanesTrait;
use Tests\ApiTestTrait;

class PlanesRepositoryTest extends TestCase
{
    use MakePlanesTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlanesRepository
     */
    protected $planesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->planesRepo = \App::make(PlanesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_planes()
    {
        $planes = $this->fakePlanesData();
        $createdPlanes = $this->planesRepo->create($planes);
        $createdPlanes = $createdPlanes->toArray();
        $this->assertArrayHasKey('id', $createdPlanes);
        $this->assertNotNull($createdPlanes['id'], 'Created Planes must have id specified');
        $this->assertNotNull(Planes::find($createdPlanes['id']), 'Planes with given id must be in DB');
        $this->assertModelData($planes, $createdPlanes);
    }

    /**
     * @test read
     */
    public function test_read_planes()
    {
        $planes = $this->makePlanes();
        $dbPlanes = $this->planesRepo->find($planes->id);
        $dbPlanes = $dbPlanes->toArray();
        $this->assertModelData($planes->toArray(), $dbPlanes);
    }

    /**
     * @test update
     */
    public function test_update_planes()
    {
        $planes = $this->makePlanes();
        $fakePlanes = $this->fakePlanesData();
        $updatedPlanes = $this->planesRepo->update($fakePlanes, $planes->id);
        $this->assertModelData($fakePlanes, $updatedPlanes->toArray());
        $dbPlanes = $this->planesRepo->find($planes->id);
        $this->assertModelData($fakePlanes, $dbPlanes->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_planes()
    {
        $planes = $this->makePlanes();
        $resp = $this->planesRepo->delete($planes->id);
        $this->assertTrue($resp);
        $this->assertNull(Planes::find($planes->id), 'Planes should not exist in DB');
    }
}
