<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class GroupTest extends TestCase
{
    public function testMustBeAuthenticated()
    {
        auth()->logout();

        $response = $this->call('GET', 'api/v1/groups');
        $response
            ->assertStatus(401)
            ->assertJson([
                'status' => 'failed',
                'message' => 'Unauthorized.'
            ]);
    }
    
    public function testListGroupsData()
    {
        // $user = factory(User::class)->create();
        $user = User::find(1);

        $this->actingAs($user, 'api');
        $response = $this->json('GET', 'api/v1/groups');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true,
            ]);
    }

    public function testCreateGroup()
    {
        $user = User::find(1);

        $this->actingAs($user, 'api');
        $response = $this->json('POST', 'api/v1/groups', ['name' => 'Company Name', 'company_id' => auth()->user()->id]);

        $response
            ->assertStatus(201);
            // ->assertJson([
            //     'data' => true,
            // ]);
    }

    public function testGetSuccesstGroup()
    {
        $user = User::find(1);

        $this->actingAs($user, 'api');
        $response = $this->json('GET', 'api/v1/groups/1');

        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => true,
            ]);

        $response = $this->json('GET', 'api/v1/groups/notexists');

        $response
            ->assertStatus(404)
            ->assertJson([
                'data' => null,
            ]);
    }
}
