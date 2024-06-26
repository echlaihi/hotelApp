<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        $users = User::paginate(6);
        return view("admin.dashboard.users")->with('users', $users);
    }

    public function delete(Request $request, User $user)
    {
        $user->delete();
        $request->session()->flash("status", "L'utilisateur est supprimé avec succès.");
        return redirect()->back();
    
    }
}
