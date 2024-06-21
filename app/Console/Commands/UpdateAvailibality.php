<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Room;
use App\Models\Reservation;
use Carbon\Carbon;

class UpdateAvailibality extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-availibality';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reservations = Reservation::all();

        foreach( $reservations as $reservation ) {

            $carbon_start_date = Carbon::parse($reservation->start_date);
            $carbon_end_date   = Carbon::parse($reservation->end_date);

            $num_days_to_start = (int) $carbon_start_date->diffInDays(now());
            $num_days_to_end  = (int) now()->diffInDays($carbon_end_date);

            echo $num_days_to_end ;

            if ( $reservation->status == "prêt" && $num_days_to_start == 0) 
            {
                $reservation->status = "activée";
                $room = Room::find($reservation->room_id);
                $reservation->save();
                $room->is_available = false;
                $room->save();
            }
            

            if ( $reservation->status == "activée" && $num_days_to_end == 1)
            {
                $reservation->status = "terminée";
                $reservation->save();
                $room = Room::find($reservation->room_id);
                $room->is_available = true;
                $room->save();
            }
        }

    }
}
