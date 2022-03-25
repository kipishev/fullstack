<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile (User $user) {
        if (!Auth::user())
            return redirect(route('home'));
        if (Auth::user()->isAdmin() || $user->id == Auth::user()->id)
            return view('profile', compact('user'));
        return redirect(route('home'));
    }
    public function save (Request $request) {
        $input = request()->all();
        //dd($input);

        $name = $input['name'];
        $email = $input['email'];
        $userId = $input['userId'];
        $picture = $input['picture'] ?? null;
        $newAddress = $input['new_address'] ?? null;
        $newMainAddress = $input['new_main_address'] ?? null;
        $user = User::find($userId);

        request()->validate([
            'name' => 'required',
            'email' => "email|required|unique:users,email,{$user->id}",
            //'picture' => 'mimes:jpg,bmp,png,webp',
            'picture' => 'mimetypes:image/*',
            'current_password' => 'current_password|required_with:password|nullable',
            'password' => 'confirmed|min:8|nullable',
        ]);


        if (isset($input['password'])) {
            $user->password = Hash::make($input['password']);
            $user->save();
        }

        Address::where('user_id', $user->id)->update([
            'main' => 0
        ]);

        if (isset($input['main_address'])) {
            Address::where('id', $input['main_address'])->update([
                'main' => 1
            ]);
        }

        if ($newAddress && $newMainAddress) {
            Address::where('user_id', $user->id)->update([
                'main' => 0,
            ]);
            Address::create([
                'user_id' => $user->id,
                'address' => $newAddress,
                'main' => 1,
            ]);
        } else if ($newAddress) {
            Address::create([
                'user_id' => $user->id,
                'address' => $newAddress,
                'main' => 0,
            ]);
        }

        if ($picture) {
            $ext = $picture->getClientOriginalExtension();
            $fileName = time() . rand(10000, 99999) . '.' . $ext;
            $picture->storeAs('public/users', $fileName);
            $user->picture = "users/$fileName";
        }

        $user->name = $name;
        $user->email = $email;
        $user->save();
        session()->flash('profileSaved');
        return back();
    }
}
