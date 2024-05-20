<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view("room.index")->with("rooms", $rooms);

    }

    public function show($id)
    {
        $room = Room::find($id);
        return view("room.show")->with("room", $room);
    }
}
