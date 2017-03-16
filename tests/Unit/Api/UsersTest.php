<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSignUp()
    {
    	// https://www.neontsunami.com/posts/changing-the-base-url-with-laravel-54-testing
        // $response = $this->json('POST', 'api/signup', ['name' => 'Sally']);

        // $response
        //     ->assertStatus(200)
        //     ->assertJson([
        //         'created' => true,
        //     ]);
    }
}
