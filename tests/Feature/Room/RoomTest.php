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
    }


        public function removeImages() : void
        {
                $images = Image::all();
            if (count($images)) {
                    foreach($images as $image)
                {
                    unlink("storage/app/images/" . $image->name);
                }
            }
        }


    // public function test_a_user_can_list_all_rooms()
    // {
    //     $response = $this->get(route("room.index"));
    //     $response->assertOk();
    //     $response->assertviewIs("room.index");
    // }

    public function test_user_can_see_specific_room()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $room = Room::factory()->create();
        $image = Image::factory(["room_id" => $room->id])->create();
        // dd($image->room_id, $room->id);
        // dd(Image::all()->count());
        $response = $this->get(route("room.show", $room->id));
        $response->assertOk();
        $response->assertViewIs("room.show");

        $this->removeImages();
    }

    public function test_only_admin_can_list_all_rooms()
    {
        $response = $this->authenticateUser();
        Room::factory(20)->create();
        
        $response = $response->get(route("admin.rooms.list"));
        $response->assertStatus(404);
        
        $this->withoutExceptionHandling();
        $response = $this->authenticateAdmin();
        $response = $response->get(route("admin.rooms.list"));
        $response->assertOk();
        $response->assertViewIs("admin.dashboard.rooms");

        $this->removeImages();

    }


    public function test_admin_can_create_room_with_images()
    {
        $this->withoutExceptionHandling();
        $room = Room::factory()->make()->toArray();
        $room['image1'] = UploadedFile::fake()->image("initial.jpg", 1000, 900)->size(900);
        $room['image2'] = UploadedFile::fake()->image("initial2.jpg", 1000, 900)->size(900);
        $room['image3'] = UploadedFile::fake()->image("initial3.jpg", 1000, 900)->size(900);
        // $room['image4'] = UploadedFile::fake()->image("initial4.jpg", 1000, 900)->size(2000);

        $response1 = $this->authenticateAdmin();
        $response2 = $response1;

        $response1->assertAuthenticated();
        
        $response1 = $response1->get(route('room.create'));
        $response1->assertOk();

        $response2 = $response2->post(route('room.store'), $room);
        $response2->assertRedirect(route("admin.rooms.list"));
        $this->assertDatabaseCount('rooms', 1);
        $this->assertDatabaseCount('images', 3);
        $images = Image::where('room_id', 1)->get();

        
        //test file uploading
        foreach ($images as $image) {
             Storage::disk('images')->assertExists($image->name);
        }

        $this->removeImages();

    }


    public function test_admin_can_delete_a_room_with_images()
    {

        // $this->withoutExceptionHandling();
        $response = $this->authenticateAdmin();
        $room = Room::factory()->create();
        $image = Image::factory(["room_id" => $room->id])->create();

        $response2 = $response->delete(route('room.delete', $room->id));
        $response2->assertRedirect(route('admin.rooms.list'));
        $this->assertDatabaseCount('rooms', 0);
        $this->assertDatabaseCount('images', 0);


        $this->removeImages();
    }

    public function test_non_admin_user_cannot_create_room()
    {

        $room = Room::factory()->create()->toArray();
        $response = $this->authenticateUser();
        $response = $this->get(route('room.create'));
        $response->assertStatus(404);

        $response = $this->post(route('room.store'), $room);
        $response->assertStatus(404);

        $this->removeImages();
    }

    public function test_admin_can_see_edit_room_form()
    {
        $response = $this->authenticateAdmin();
        $room = Room::factory()->create();
        $image = Image::factory(['room_id' => $room->id])->create();

        $response = $response->get(route("room.edit", $room->id));
        $response->assertOk();

        $response2 = $this->authenticateUser();
        $response2 = $response2->get(route("room.edit", $room->id));
        $response2->assertNotFound();
    }

    public function test_admin_can_update_a_room()
    {
        $this->withoutExceptionHandling();
        $room = Room::factory(['type' => 'double'])->create();
        $image = Image::factory(['room_id' => $room->id])->create();


       

        $updated_room = ['type' => 'triple', 'price' => 800, 'conforts' => 'jeux'];
        $updated_room['image1'] = UploadedFile::fake()->image("initial.jpg", 1000, 900)->size(900);
        $updated_room['image2'] = UploadedFile::fake()->image("initial.jpg", 1000, 900)->size(900);
        $updated_room['image3'] = UploadedFile::fake()->image("initial.jpg", 1000, 900)->size(900);

        $response = $this->authenticateAdmin();

        // // $room['room'] d;
        
        $old_images = Image::where("room_id", $room->id)->get();
        $response = $response->put(route("room.update", $room->id), $updated_room);
        
        $room = Room::find($room->id)->toArray();

        unset($room['created_at']);
        // unset($room['id']);
        unset($room['updated_at']);

        unset($updated_room['image1']);
        unset($updated_room['image2']);
        unset($updated_room['image3']);

        // $this->assertSame($updated_room, $room);
        foreach($old_images as $image) {
            Storage::disk("images")->assertMissing($image);
        }

        $new_images = Image::where('room_id', $room['id'])->get();
        $this->assertcount(3, $new_images);
        foreach($new_images as $image) {
            Storage::disk("images")->assertExists($image->name);
        }

        unset($room['id']);
        $this->assertSame($room, $updated_room);

    }   

}
