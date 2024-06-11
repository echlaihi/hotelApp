<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        if (Auth::check()) {
            $added_inputs = ["sender" => Auth::user()->email];
        } else {
            $added_inputs = ["receiver" => "admin@email.com"];
        }

        $request->merge($added_inputs);

        $validated_data = $request->validate([
            "title" => "required|min:10,max:500",
            "body" => "required|min:10,max:1000",
            "sender" => "required|email",
            "receiver" => "required|email",
        ]);

     

        Message::create($validated_data);

        $request->session()->flash("status", "Message envoyée");
        return back();





    }

    public function list($type)
    {
        $type = "df";
        dd("hello orld");

        if ($type != 'sent' && $type != 'received') {
            return abort(404);
        }

        if ($type == 'sent'){
            $messages = Message::where("sender", Auth::user()->email)->paginate(10);
        } else {
            $messages = Message::where("receiver", Auth::user()->email)->paginate(10);
        }



        // dd($messages);
        if (Auth::user()->is_admin){

            return view("admin.dashboard.messages")->with('messages', $messages);

        } else {
            dd("user");
        }
    }
}
