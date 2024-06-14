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

   public function test_admin_can_list_all_of_his_messages()
   {      
          $this->withoutExceptionHandling();
          $response = $this->authenticateAdmin();
          $response1 = $response->get(route('admin.messages.list', ['type' => 'sent']));
          $response1->assertViewIs("admin.dashboard.messages");
          $response1->assertOk();

          $response = $response->get(route('admin.messages.list', ['type' => 'received']));
          $response->assertViewIs("admin.dashboard.messages");
          $response->assertOk();
   }

     public function test_user_can_list_all_of_his_messages()
     {
          $response = $this->authenticateUser();
          $response1 = $response->get(route('messages.list', ['type' => 'sent']));
          $response1->assertViewIs("messages.index");
          $response1->assertOk();

          $response = $response->get(route('messages.list', ['type' => 'received']));
          $response->assertViewIs("messages.index");
          $response->assertOk();
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

   public function test_a_user_can_mark_a_message_as_read()
   {
        $response = $this->authenticateUser();
        $message = Message::factory(['receiver' => Auth::user()->email])->create();

        $response = $response->put(route("message.read", $message->id));
        $response->assertJsonStructure(['read_at']);
   }


}
