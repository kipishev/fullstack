<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile ($id) {
        //$id = Auth::user()->id; // чтобы не определять переменную, передаем ее параметром в функцию
        $user = User::findOrFail($id);
        return view('profile', compact('user'));
    }
    public function save () {
        request()->validate([
            'name' => 'required',
            'email' => 'email|required|unique:users',
        ]);

        $input = request()->all();
        $name = $input['name'];
        $email = $input['email'];
        $userId = $input['userId'];

        $user = User::find($userId);
        $user->name = $name;
        $user->email = $email;
        $user->save();
        return back();
    }
}
