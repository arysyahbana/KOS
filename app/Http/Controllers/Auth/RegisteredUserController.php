<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $hp = $request->input('hp');

        if (substr($hp, 0, 1) === '0') {
            $hp = '+62' . substr($hp, 1);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'hp' => $hp,
            'alamat' => $request->alamat,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if (auth()->user()->role === 'Admin') {
            return redirect()->intended('/home-admin');
        } elseif (auth()->user()->role === 'Owner') {
            return redirect()->intended('/home-owner');
        } elseif (auth()->user()->role === 'Client') {
            return redirect()->intended('/');
        } else {
            return redirect()->intended('/');
        }
    }
}
