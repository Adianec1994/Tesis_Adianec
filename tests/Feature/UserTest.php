<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRoutes()
    {
        $response = $this->get('/baterias');

        $response->assertStatus(200);
    }
    /** Routes post register */
    public function test_routes_post_register()
    {
        $response = $this->post('/register');

        $response->assertStatus(405);
    }

    /** @test register */
    public function can_register()
    {
        $this->postJson('/api/register', [
            'name' => 'Test User',
            'email' => 'test@test.app',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ])
            ->assertSuccessful()
            ->assertJsonStructure(['id', 'name', 'email']);
    }

    public function testDataBase()
    {
        $this->assertDataBaseHas('users',[
            'name'=>"adianec",
            'email'=>"adianec@geysel.cu"
        ]);
    }


}
