<?php

namespace Tests\Feature\Room;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


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
        $user = User::factory()->create();
        Room::factory()->create();
        $response = $this->get(route("room.show", 1));
        $response->assertOk();
        $response->assertViewIs("room.show");
    }

    public function test_only_admin_can_list_all_rooms()
    {
        $response = $this->authenticateUser();
        $this->withExceptionHandling();
        Room::factory(20)->create();

        $response = $response->get(route("room.all"));
        $response->assertStatus(404);

        $response = $this->authenticateAdmin();
        $response = $response->get(route("room.all"));
        $response->assertOk();
        $response->assertViewIs("dashboard.rooms");

    }


    public function test_admin_can_create_room_with_images()
    {
        $room = Room::factory()->make()->toArray();
        $room['image1'] = UploadedFile::fake()->image("initial.jpg", 1000, 900)->size(2000);
        $room['image2'] = UploadedFile::fake()->image("initial2.jpg", 1000, 900)->size(2000);
        $room['image3'] = UploadedFile::fake()->image("initial3.jpg", 1000, 900)->size(2000);
        // $room['image4'] = UploadedFile::fake()->image("initial4.jpg", 1000, 900)->size(2000);

        $response1 = $this->authenticateAdmin();
        $response2 = $response1;

        $response1->assertAuthenticated();
        
        $response1 = $response1->get(route('room.create'));
        $response1->assertOk();

        $response2 = $response2->post(route('room.store'), $room);
        $response2->assertRedirect(route("room.all"));
        $this->assertDatabaseCount('rooms', 1);
        $this->assertDatabaseCount('images', 3);
        $images = Image::where('room_id', 1)->get();
        
        foreach ($images as $image) {
            $exists = Storage::disk('public')->exists($image->name);
            $this->assertTrue($exists);
        }

    }


    public function test_admin_can_delete_a_room_with_images()
    {


        $response = $this->authenticateAdmin();
        $room = Room::factory()->make()->toArray();
        $room['image1'] = UploadedFile::fake()->image("initial.jpg", 1000, 900)->size(2000);
        $room['image2'] = UploadedFile::fake()->image("initial2.jpg", 1000, 900)->size(2000);

        $response1 = $response->post(route('room.store'), $room);
        $response1->assertRedirect(route('room.all'));

        $response2 = $response->delete(route('room.delete', 1));
        $response2->assertRedirect(route('room.all'));
        $this->assertDatabaseCount('rooms', 0);
        $this->assertDatabaseCount('images', 0);



    }

    public function test_non_admin_user_cannot_create_room()
    {

        $this->withExceptionHandling();
        $room = Room::factory()->create()->toArray();
        $response = $this->authenticateUser();
        $response = $this->get(route('room.create'));
        $response->assertStatus(404);

        $response = $this->post(route('room.store'), $room);
        $response->assertStatus(404);
    }

}
