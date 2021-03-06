<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        var_dump(request()->all());

         $attributes = request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:7', 'max:255']
        ]);

        $user = User::create($attributes);
        auth()->login($user);
        session()->flash('success','Your account has been created.');
        return redirect('/');
    }
}
