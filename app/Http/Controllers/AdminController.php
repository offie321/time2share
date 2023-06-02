<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
// remove items

// block users
    public function blockUser(User $user)
    {
        if($user->role == 'user'){
            $user->blocked = 1;
        }elseif ($user->role == 'admin'){
            return Redirect::back()->withErrors(['msg' => 'Admin cannot be blocked']);
        }

        $user->save();
        return redirect()->route('profile.show', ['id' => $user->id]);
    }

    public function unblockUser(User $user)
    {
        if($user->role == 'user'){
            $user->blocked = 0;
        }elseif ($user->role == 'admin'){
            return Redirect::back()->withErrors(['msg' => 'Admin cannot be blocked']);
        }
        $user->save();
        return redirect()->route('profile.show', ['id' => $user->id]);
    }
}
