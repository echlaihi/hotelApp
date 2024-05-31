<?php

namespace Tests\Feature\Reservation;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Reservation;

use Illuminate\Support\Facades\Http;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_authenticated_user_can_reserve_a_room_with_online_payment()
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

        dd(json_decode($response));

    }

    public function test_an_authenticated_user_can_reserve_room()
    {

        $this->withoutExceptionHandling();
        $response = $this->authenticateUser();

        $room = Room::factory()->create();

        $reservation = [
            "start_date" => Carbon::now()->addDay(2),
            "end_date"   => Carbon::now()->addDay(7),
        ];

        $response = $response->post(route("reservation.make", 1), $reservation);
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
        $this->withExceptionHandling();

        Reservation::factory(40)->create();
        $response1 = $this->authenticateUser();
        $response1 = $response1->get(route('reservation.index'));
        $response1->assertStatus(404);

        $response = $this->authenticateAdmin();

        $response = $response->get(route("reservation.index") . "?num_per_page=8");
        $response->assertOk();
        $response->assertViewIs("dashboard.reservation.index");
    }

    public function test_authenticated_user_can_show_his_reservation()
    {
        Reservation::factory()->create();
        
    }

}
