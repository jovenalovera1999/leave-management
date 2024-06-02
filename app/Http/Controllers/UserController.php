<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return view('login.index');
    }

    public function processLogin(Request $request) {
        $validated = $request->validate([
            'username' => ['required', 'max:12'],
            'password' => ['required', 'max:15'],
        ]);

        $validated['username'] = strtoupper($validated['username']);
        $validated['password'] = strtoupper($validated['password']);

        $user = User::where('tbl_users.username', $validated['username'])
            ->first();

        if($user && auth()->attempt($validated)) {
            auth()->login($user);
            $request->session()->regenerate();

            // return dd(auth()->user());
            return redirect('/request/leaves');
        } else {
            return back()->with('failed', 'INCORRECT USERNAME OR PASSWORD.');
        }
    }

    public function processLogout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'YOUR ACCOUNT WAS SUCCESSFULLY LOGGED OUT.');
    }
}
