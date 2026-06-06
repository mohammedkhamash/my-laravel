<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password; 
        $user->save();

        return redirect()->back();
    }

    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $users = User::all();
        return view('users', compact('user', 'users'));
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'password' => 'nullable|min:6'
        ]);

        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;

        if (!empty($request->password)) {
            $user->password = $request->password; 
        }

        $user->save();

        return redirect('users');
    }
}