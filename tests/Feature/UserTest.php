<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use App\Models\User;

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

    public function test_only_admin_can_delete_any_user()
    {
        $response = $this->authenticateAdmin();
        $users = User::factory(30)->create();

        $response = $response->delete(route('user.delete', $users[4]->id));
        $response->assertRedirect();
        $this->assertDatabaseCount('users', 30);

        $response2 = $this->authenticateUser();
        $response2 = $response2->delete(route('user.delete', $users[2]->id));
        $response2->assertNotFound();


    }
}
