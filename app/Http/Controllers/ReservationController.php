<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{

	public function make(Room $room, Request $request)
	{
		if (!$room->is_available) abort(404);

		$validated_data = $request->validate([
			"start_date" => "required|date|after:today|before:" . Carbon::now()->addMonths(3)->format("Y-m-d"),

			"end_date" => "required|date|after:" . $request->input("start_date") ."|before:" . Carbon::now()->addMonths(3)->format("Y-m-d"),

		]);


		$reservation = [
			"user_id" => Auth::user()->id,
			"start_date" => $validated_data["start_date"],
			"end_date"   => $validated_data["end_date"],
			"room_id"    => $room->id,
			"status"	 => "disactive", 

		];

		// dd($reservation);

		Reservation::create($reservation);

		$request->session()->flash("status", "le chambre est reserver");
		return back();


	}

	
	public function index(Request $request)
	{

		$data = $request->validate(['num_per_page' => 'nullable|integer|min:5|max:14']);
		$reservations = Reservation::paginate($data["num_per_page"]);
		return view("dashboard.reservation.index")->with("reservations", $reservations);
	}
}
