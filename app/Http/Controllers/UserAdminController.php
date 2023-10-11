<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index(){
        $user=User::all();

        return view('admin.index',compact('user'));
    }

    public function destroy(User $user,$id)
    {
        $user = User::find($id);
    $user->delete();
    return redirect()->route('user')->with('success', 'user supprimée avec succès.');
    }
}
