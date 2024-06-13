<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {

        return [
            "user_id" => User::factory()->create()->id,
            "room_id" => Room::factory()->create()->id,
            "start_date" => Carbon::now()->addDay(1),
            "end_date" => Carbon::now()->addDay(3),
            "status" => "disactivée",
            "invoice" => "300",
        ];
    }
}
