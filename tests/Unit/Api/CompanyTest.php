<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\User;

class CompanyTest extends TestCase
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

    public function testUpdateUserCompanyValidationWorking()
    {
        $user = User::find(1);

        $this->actingAs($user, 'api');
        $response = $this->json('POST', 'api/v1/companies/1', []);

        $response
            ->assertStatus(422); // 422 will trigger for failed validation
    }

    public function testUpdateUserCompany()
    {
        $user = User::find(1);

        $this->actingAs($user, 'api');
        $response = $this->json('POST', 'api/v1/companies/1', [
                'name' => 'Company Name ' . str_random(5), 
                'user_id' => auth()->user()->id, 
                'trade_name' => 'Trade Name ' . str_random(5),
                'type' => 'Private'
                ]);

        $response
            ->assertStatus(200);
            // ->assertJson([
            //     'data' => true,
            // ]);
    }
}
