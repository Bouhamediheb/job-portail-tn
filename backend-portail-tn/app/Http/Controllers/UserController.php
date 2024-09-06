<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    public function getAllUsers()
    {
        $users = User::with('profil')->get();
        return $users;
    }

    public function blockUser($id)
    {
        $user = User::find($id);
        $user->blocked = true;
        $user->save();
        return $user;
    }

    public function unblockUser($id)
    {
        $user = User::find($id);
        $user->blocked = false;
        $user->save();
        return $user;
    }
}
