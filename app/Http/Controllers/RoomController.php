<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view("room.index")->with("rooms", $rooms);

    }

    public function getAll()
    {
        $rooms = Room::all();
        return view("dashboard.rooms")->with("rooms", $rooms);
    }

    public function show($id)
    {
        $room = Room::find($id);
        return view("room.show")->with("room", $room);
    }

    public function create()
    {
        return view('room.create');
    }

    public function store(Request $request) 
    {
        $validated_data  = $request->validate([
            'type' => 'required|max:10',
            'price'=> 'required|integer',
            'is_available' => 'required|boolean',
            'conforts' => 'required',
            'image1' => 'required|file|mimes:jpeg,png,jpg|max:2000',
            'image2' => 'nullable|file|mimes:jpeg,png,jpg|max:2000',
            'image3' => 'nullable|file|mimes:jpeg,png,jpg|max:2000',
            'image4' => 'nullable|file|mimes:jpeg,png,jpg|max:2000',

        ]);

        $room = Room::create($validated_data);



        $images = array();

        $images[0] = $validated_data['image1'];
        $images[1] = isset($validated_data['image2']) ? $validated_data['image2'] : null;
        $images[2] = isset($validated_data['image3']) ? $validated_data['image3'] : null;
        $images[3] = isset($validated_data['image4']) ? $validated_data['image4'] : null;


        $images = array_filter($images);


        $images_to_insert = [];

         for ($i = 0; $i < count($images); $i++){
            $images_to_insert[$i]  = [];
            $images_to_insert[$i]['extension'] = $images[$i]->getClientOriginalExtension();
            $images_to_insert[$i]['name'] = Str::uuid() .'.' . $images_to_insert[$i]['extension'] ;
            $images_to_insert[$i]['is_initial'] = false;
            $images_to_insert[$i]['room_id']  =  $room->id;     

            // storing the image 
            Storage::disk('public')->put($images_to_insert[$i]['name'], $images[$i]);
        }

        $images_to_insert[0]['is_initial'] = true;

        foreach($images_to_insert as $img) {
            Image::create($img);
        }






        $request->session()->flash('status', 'Chambre créer avec succés');
        return to_route('room.all');
    }


    public function delete(Request $request, Room $room)
    {
        $room_id = $room->id;

        Image::where("room_id", $room_id)->delete();
        $room->delete();

        $request->session()->flash("status", "Chambre supprimée avec succés");
        return to_route("room.all");
    }
}
