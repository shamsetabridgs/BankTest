<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    //.........Showing registration form.............//
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    //.............Register user.....................//
    public function register(Request $request)
    {
        //............. Validation rules .............
        $request -> validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        //.............. Create User..................
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        //.............. Redirect after registration ..............
        return redirect()->route('login')->with('success', 'Registration successfull. Please login.');
    }

    //.................................. Login user.........................................//

    //.......... Show login form..................
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //........... Login user.............
    public function login(Request $request)
    {
        //....... validate rules...........
        $request -> validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        //...........Attempt to authenticate user..........
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            //........... Authentication passed..........
            return redirect()->intended('/');
        }

        //............ Authentication failed.........
        return back()->withErrors(['email' => 'Invalid Credentials'])->withInput();
    }

    //........................ logout user ...........................//
    public function logout(Request $request)
    {
        Auth::logout();
        $request -> session() -> invalidate();
        $request -> session() -> regenerateToken();

        return redirect('/');
    }
}
