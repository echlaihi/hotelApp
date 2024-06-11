<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_admin_can_list_all_users()
    {
        $response = $this->authenticateAdmin();
        $response = $response->get(route("admin.users.list"));
        $response->assertOk();
        $response->assertViewIs("admin.dashboard.users");
        Auth::logout();

        $response = $this->get(route("admin.users.list"));
        $response->assertRedirect();
        $response = $this->authenticateUser();
        $response = $response->get(route("admin.users.list"));
        $response->assertNotFound();

    }
}
