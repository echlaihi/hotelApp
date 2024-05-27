<?php

namespace Tests\Feature\Message;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageTest extends TestCase
{
   use RefreshDatabase;

   public function setUp():void
   {
        parent::setUp();
        $this->withoutExceptionHandling();
   }


   public function test_unauthenticated_user_can_message_admin()
   {
        $message = Message::factory()->make()->toArray();

        $response = $this->post(route("message.send"), $message);
        $response->assertRedirect(route("room.index"));
        $this->assertDatabaseCount('messages', 1);
   }

   public function test_authenticate_user_can_message_admin()
   {
        $response = $this->authenticateUser();
        $user = Auth::user();
        $message = Message::factory()->make()->toArray();
        $message['sender'] = $user->email;
        $message['receiver'] = "system@email.com";

        $response = $response->post(route('message.send'), $message);
        $response->assertRedirect();
        $this->assertDatabaseCount("messages", 1);
   }

   public function test_admin_can_message_authenticated_user()
   {    

            $response = $this->authenticateAdmin();
            $user = User::factory()->create();
            $admin = Auth::user();
            $message = Message::factory()->make()->toArray();

            $response = $response->post(route("message.send"), $message);
            $response->assertRedirect();
            $this->assertDatabaseCount("messages", 1);
   }

   public function test_admin_can_message_unauthenticated_user()
   {
        $response = $this->authenticateAdmin();
        $admin = Auth::user();
        $message = Message::factory()->make()->toArray();

        $response = $response->post(route("message.send"), $message);
        $response->assertRedirect();
        $this->assertDatabaseCount("messages", 1);
   }


   // public function test_regular_user_cannot_message_regular_user()
   // {
   //      $user = User::factory()->create()->toArray();
   //      $response = $this->actingAs($user);
   //      $response->assertAuthenticated();
   // }

}
