<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * @name: REGISTER
     * @desc: Show the registration form.
     * @route: GET /register
     */
    public function register(): View
    {
        return view('auth.register');
    }


    /**
     * @name: STORE
     * @desc: Submit the registration data to the database.
     * @route: POST /register
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Hash password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create user
        $user = User::create($validatedData);

        return redirect()->route('login')->with('success', 'You registered your account successfully, you can now log in!');
    }


    /**
     * @name: LOGIN
     * @desc: Show the login form.
     * @route: GET /login
     */
    public function login(Request $request): View
    {
        return view('auth.login');
    }


    /**
     * @name: AUTHENTICATE
     * @desc: Send the login data to the database for authentication
     * @route: POST /login
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate user
        if (Auth::attempt($credentials)) {
            // Regenerate the session to prevent fixation attacks
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('success', 'Welcome, you are now logged in!');
        }

        // If auth fails, redirect back with error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records'
        ])->onlyInput('email');
    }

    /**
     * @name: LOGOUT
     * @desc: Send the login data to the database for authentication
     * @route: POST /logout
     */
    public function logout(Request $request): RedirectResponse
    {
        // Log out the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the CSRF token for protecting against CSRF attacks
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been succesfully logged out!');
    }
}
