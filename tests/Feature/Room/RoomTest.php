<?php

namespace Tests\Feature\Room;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Room;

class RoomTest extends TestCase
{

    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    public function test_a_user_can_list_all_rooms()
    {
        $response = $this->get(route("room.index"));
        $response->assertOk();
        $response->assertviewIs("room.index");
    }

    public function test_user_can_see_specific_room()
    {
        Room::factory()->create();
        $response = $this->get(route("room.show", 1));
        $response->assertOk();
        $response->assertViewIs("room.show");
    }

    public function test_user_can_reserve_room()
    {

    }

    
    public function test_non_auth_user_cannot_reserve_room()
    {

    }

    public function test_admin_can_create_new_room()
    {

    }

    public function test_admin_can_update_room()
    {

    }


    public function test_admin_can_delete_room()
    {

    }



}
