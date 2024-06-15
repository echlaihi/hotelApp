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
        foreach ($rooms as $room) {
            $room->initial_image = $room->images()->where("is_initial", true)->get()[0];
        }
        return view("room.index")->with("rooms", $rooms);

    }

    public function getAll()
    {
        $rooms = Room::paginate(6);
        return view("admin.dashboard.rooms")->with("rooms", $rooms);
    }

    public function show(Room $room)
    {
        $initial_image = $room->images()->where("is_initial", true)->get()->first();

        $images = $room->images()->where("is_initial", false)->get();

        return view("room.show")->with([
            "room" => $room,
            "initial_image" => $initial_image,
            "images" => $images
        ]);
    }

    public function create()
    {
        return view('room.roomForm')->with(['action' => "Créer"]);
    }

    public function store(Request $request) 
    {
        

        $validated_data  = $request->validate([
            'type' => 'required|max:10',
            'price'=> 'required|integer',
            'conforts' => 'required',
            'image1' => 'required|file|mimes:jpeg,png,jpg|max:1000',
            'image2' => 'nullable|file|mimes:jpeg,png,jpg|max:1000',
            'image3' => 'nullable|file|mimes:jpeg,png,jpg|max:1000',
            'image4' => 'nullable|file|mimes:jpeg,png,jpg|max:1000',

        ]);

        $room = Room::create($validated_data);

        $images = array();

        $images[0] = isset($validated_data['image1']) ? $validated_data['image1'] : null;
        $images[1] = isset($validated_data['image2']) ? $validated_data['image2'] : null;
        $images[2] = isset($validated_data['image3']) ? $validated_data['image3'] : null;
        $images[3] = isset($validated_data['image4']) ? $validated_data['image4'] : null;


        $images = array_filter($images);


        $images_to_insert = [];

         for ($i = 0; $i < count($images); $i++){
           
            $images_to_insert[$i]['is_initial'] = false;
            $images_to_insert[$i]['room_id']  =  $room->id;    

            // storing the images
            $images_to_insert[$i]["name"] = Storage::disk("images")->put($i,$images[$i]);

        }

        $images_to_insert[0]['is_initial'] = true;

        foreach($images_to_insert as $img) {
            Image::create($img);
        }



        $request->session()->flash('status', 'La chambre a été créée avec succès.');
        return redirect()->route('admin.rooms.list');
    }


    public function delete(Request $request, Room $room)
    {
        $room_id = $room->id;

        Image::where("room_id", $room_id)->delete();
        $room->delete();

        $request->session()->flash("status", "La chambre a été supprimée avec succès.");
        return to_route("admin.rooms.list");
    }

    public function edit(Room $room)
    {
        $initial_image = $room->images()->where("is_initial", true)->get()->first();
        $images = $room->images()->where("is_initial", false)->get();

        return view("room.roomForm")->with([
            'action' => 'Modifier',
            'room'   => $room,
            'initial_image' => $initial_image,
            'images' => $images
        ]);
    }

    public function update(Room $room, Request $request)
    {
        $validated_data  = $request->validate([
            'type' => 'nullable|max:10',
            'price' => 'nullable|integer',
            'conforts' => 'nullable|max:100',
            'image1' => 'nullable|file|mimes:jpeg,png,jpg|max:1000',
            'image2' => 'nullable|file|mimes:jpeg,png,jpg|max:1000',
            'image3' => 'nullable|file|mimes:jpeg,png,jpg|max:1000',
            'image4' => 'nullable|file|mimes:jpeg,png,jpg|max:1000',

        ]);

        if(!count($validated_data)) {
             $request->session()->flash("status", "La chambre n'a pas été modifiée.");
             return redirect()->back();
        }

        $room->update($validated_data);

        // updating images
        $images[0] = isset($validated_data['image1']) ? $validated_data['image1'] : null;
        $images[1] = isset($validated_data['image2']) ? $validated_data['image2'] : null;
        $images[2] = isset($validated_data['image3']) ? $validated_data['image3'] : null;
        $images[3] = isset($validated_data['image4']) ? $validated_data['image4'] : null;


        if (count($images)) {
            $old_images = Image::where('room_id', $room->id)->orderBy("name", "asc")->get(); 
            foreach ($old_images as $key => $image) {
                $image->prefix = $image->name[0];
            }
            
            for ($i=0; $i < count($images); $i++) { 
                if (isset($images[$i])) {
                    
                    for($j = 0; $j < count($old_images); $j++){
                        if($old_images[$j]->prefix == $i){
                            
                            // update old image
                            $new_name = Storage::disk("images")->put($i, $images[$i]);
                            unlink("storage/app/images/" . $old_images[$j]->name);
                            unset($old_images[$j]->prefix);
                            $old_images[$j]->update(['name' => $new_name]);
                            // dd("here");
                        } else {

                            $new_name = Storage::disk("images")->put($i, $images[$i]);
                            Image::create([
                                "name" => $new_name,
                                "room_id" => $room->id,
                                "is_initial" => (($i == 0) ? true : false),
                            ]);
                        }
                    }
                }
            }

           

        } //endif

        $request->session()->flash("status", "La chambre est modifiée avec succès.");
        return redirect()->back();

    }

}
