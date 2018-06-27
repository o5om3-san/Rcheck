<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users', ['users' => $users]);
    }

    public function store(Request $request) {
        $user = new User;
        $user->name = request('name');
        $user->island = (int) request('island');
        $user->alphabet = request('alphabet');
        $user->save();

        return redirect('/users');
    }
}
