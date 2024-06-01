<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
   
   use RefreshDatabase;

   public function test_only_admin_can_get_redirected_to_admin_dashboard()
   {
        $this->withoutExceptionHandling();
        $response = $this->authenticateAdmin();
        $response = $response->get(route("admin.dashboard"));
        $response->assertOk();
        $response->assertViewIs("admin.dashboard.index");
   }

   public function test_non_admin_auth_get_redirected_to_regular_dashboard()
   {
        $this->withoutExceptionHandling();
        $response = $this->authenticateUser();
        $response = $response->get(route("user.dashboard"));
        $response->assertOk();
   }
}
