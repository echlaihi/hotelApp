<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

        public function test_a_user_can_update_his_profile()
        {
            $user = User::factory()->create()->toArray();
            dd($user);
        }
}
