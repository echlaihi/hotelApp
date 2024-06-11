<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ReservationController extends Controller
{

	public function make(Room $room, Request $request)
	{
		if (!$room->is_available) abort(404);

		if ($room->type == 'single') $this->reserveSingle($room, $request);
		else if ($room->type == 'double' || $room->type == 'triple') $this->reserveDoubleTriple($room, $request);
		else abort(404);

		$request->session()->flash("status", "le chambre est reserver");
		return redirect()->route("user.dashboard");
	}

	
	public function index(Request $request,  $num_per_page = 0)
	{
		$num_per_page = (int) $num_per_page;
		if ($num_per_page < 5) $num_per_page = 5;
		$reservations = Reservation::paginate($num_per_page);

		foreach ($reservations as $reservation) {
			$reservation->user = $reservation->user()->first();
			$reservation->partner = $reservation->user()->first()->partner()->first() ?? null;
			$reservation->room = $reservation->room()->first();
		}


		return view("admin.dashboard.reservation.index")->with("reservations", $reservations);
	}

	public function reserveSingle(Room $room, Request $request)
	{

		$validated_data = $request->validate([
			"start_date" => "required|date|after:today|before:" . Carbon::now()->addMonths(3)->format("Y-m-d"),
			"end_date" => "required|date|after:" . $request->input("start_date") . "|before:" . Carbon::now()->addMonths(3)->format("Y-m-d"),

		]);

		
		
		$reservation = [
			"user_id" => Auth::user()->id,
			"start_date" => $validated_data["start_date"],
			"end_date"   => $validated_data["end_date"],
			"room_id"    => $room->id,
			"status"	 => "disactive",
			"partner_id" => null,
			
		];
		
		// dd($reservation);

		Reservation::create($reservation);

		

	}

	public function reserveDoubleTriple(Room $room, Request $request)
	{
		$validated_data = $request->validate([
			"start_date"         => "required|date|after:today|before:" . Carbon::now()->addMonths(3)->format("Y-m-d"),
			"end_date"           => "required|date|after:" . $request->input("start_date") . "|before:" . Carbon::now()->addMonths(3)->format("Y-m-d"),
			"partner_first_name" => "required|string|min:3|max:20",
			"partner_last_name"  => "required|string|min:3|max:20",
			"marriage_contract"  => "required|mimes:pdf|max:1000",
			"partner_cin" 		 => "required|string|min:6|max:10"

		]);


		$contract_name = Storage::disk("contracts")->put('', $validated_data['marriage_contract']);

		// Storage::disk("images")->put('', $images[$i])


		$partner = Partner::create([
			'first_name' => $validated_data['partner_first_name'],
			'last_name'  => $validated_data['partner_last_name'],
			'cin' 		 => $validated_data['partner_cin'],
			'user_id' => Auth::user()->id,

		]);


		Reservation::create([
			'start_date' => $validated_data['start_date'],
			'end_date'   => $validated_data['end_date'],
			'user_id'    => Auth::user()->id,
			'partner_id' => $partner->id,
			'room_id'    => $room->id,
			'status' 	 => 'disactive',
			'marriage_contract' => $contract_name,

		]);




	}
}
