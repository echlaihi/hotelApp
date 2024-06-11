<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

        public function test_a_user_can_update_his_profile()
        {
            $new_profile_info = [
            	"first_name" => "my new first name",
            	"last_name" => "my new last name",
            	// "email"		=> "email@email.com",
            ];


            $response = $this->authenticateUser();

			$response1 =  $response->get(route("profile.edit"));
			$response1->assertViewIs("profile.edit");

            $response->patch(route("profile.update"), $new_profile_info);
            $response->assertEquals($new_profile_info["first_name"], Auth::user()->first_name);
            $response->assertEquals($new_profile_info["last_name"], Auth::user()->last_name);

        }

        public function test_user_can_update_his_password()
        {
			$this->withoutExceptionHandling();
        	$user = [
        		"first_name"            => "test first",
        		"last_name"             => "test last",
        		"email"		            => "email@email.com",
        		"password"              => "password1",
        		"password_confirmation" => "password1",
        		"cin" 		            => "idfas9k"
        	];
        	$response = $this->post(route("register"), $user);
			$response->assertRedirect(route("user.dashboard", absolute: false));
			// dd(User::first()->first_name, User::first()->last_name, User::first()->email, User::first()->cin, User::first()->password);
        	// $this->assertAuthenticated();

        	$passwords = [
        		"current_password" => "password1",
        		"password"		   => "newpassword",
        	];

        	$this->post(route("logout"));
        	$this->put(route("password.update"), $passwords);
        	$this->assertGuest();

			$this->get(route('login'), ['email' => $user['email'], 'password' => $passwords['password']]);

			$this->assertAuthenticated();


        }
}
