<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    public function authenticateAdmin()
    {
        $user = [
            'first_name' => 'admin first',
            'last_name'  => 'admin last',
            'email'      => 'admin@email.com',
            'is_admin'   => true,
            'cin'        => 'ib343',
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => 'sdfad', 
        ];

        $user = User::create($user);

        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        return $response;
    }

    public function authenticateUser()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->assertAuthenticated();
        return $response;
    }
}
