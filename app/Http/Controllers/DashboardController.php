<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Room;
use App\Models\Reservation;
use App\Models\Message;


class DashboardController extends Controller
{
    public function getUserDashboard()
    {
        return view('dashboard');
    }

    public function getAdmindashboard()
    {
        $num_users = User::where("is_admin", false)->count();
        $num_rooms = Room::count();
        $num_messages = Message::where("receiver", Auth::user()->email)->count();
        $num_reservations = Reservation::count();

        return view('admin.dashboard.index')->with([
            'num_users' => $num_users,
            'num_rooms' => $num_rooms,
            'num_reservations' => $num_reservations,
            'num_messages' => $num_messages
        ]);
    }
}
