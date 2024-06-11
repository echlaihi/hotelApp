<?php

namespace Tests\Feature\Reservation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function an_authenticated_user_can_reserve_a_room_with_online_payment()
    {
        $response = $this->authenticateUser();
        $url = "https://api.stripe.com/v1/tokens";
        $data = [
                  'card' => [
                    'number'    => 4242424242424242,
                    'exp_month' => 03,
                    'exp_year'  =>2025,
                    'cvc'       =>123
                                ]
                ];

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . env('STRIPE_SECRET'),
            "Content-Type" => "application/x-www-form-urlencoded",

        ])->post($url, $data);

        // dd(json_decode($response));

    }

    public function test_an_authenticated_user_can_reserve_room()
    {

        // $this->withoutExceptionHandling();
        $response = $this->authenticateUser();

        $room = Room::factory()->create();

        $reservation = [
            "start_date" => Carbon::now()->addDay(2),
            "end_date"   => Carbon::now()->addDay(7),
        ];

        $response = $response->post(route("reservation.make", $room->id), $reservation);
        $response->assertRedirect();
        $this->assertDatabaseCount("reservations", 1);
      
    }

    public function test_non_authenticated_users_cannot_reserve_room()
    {
        $room = Room::factory()->create();

        $reservation = [
            "start_date" => Carbon::now()->addDay(2),
            "end_date"   => Carbon::now()->addDay(7),
        ];

        $response = $this->post(route("reservation.make", 1), $reservation);
        $response->assertRedirect(route("login"));    
    }

    public function test_only_admin_can_list_all_reservations()
    {
        Reservation::factory(40)->create();
        $response1 = $this->authenticateUser();
        $response1 = $response1->get(route('admin.reservations.list'));
        $response1->assertStatus(404);

        $response = $this->authenticateAdmin();

        $this->withoutExceptionHandling();
        $response = $response->get(route("admin.reservations.list"));
        $response->assertOk();
        $response->assertViewIs("admin.dashboard.reservation.index");
    }

    public function test_a_user_can_reserve_a_room_of_type_double_triple()
    {
        $this->withoutExceptionHandling();
        $room = Room::factory(['type' => 'double'])->create();

        $response = $this->authenticateUser();
        $file_name = "contract.pdf";
        $content = "content";
        file_put_contents($file_name, $content);
        $fake_pdf = UploadedFile::fake()->create($file_name);

        $reservation = [
            "partner_first_name" => "test1",
            "partner_last_name" => "test2",
            "partner_cin"               => "id4545",
            "marriage_contract"  =>  $fake_pdf,
            "start_date" => "2024-06-12",
            "end_date"   => "2024-06-19",

        ];


        $response = $response->post(route("reservation.make", $room->id), $reservation);
        $response->assertRedirect();

        $this->assertDatabaseCount('reservations', 1);
        $this->assertDatabaseCount('partners', 1);

        $reservation = Reservation::first();
        Storage::disk("contracts")->assertExists($reservation->marriage_contract);

        // deleting the file after using it
        unlink('storage/app/contracts/' . $reservation->marriage_contract);
    }

    // public function test_authenticated_user_can_show_his_reservation()
    // {
    //     Reservation::factory()->create();
        
    // }

}
