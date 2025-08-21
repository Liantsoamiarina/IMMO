<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
     // Formulaire inscription
    public function showRegister()
    {
        return view('auth.register');
    }

    // Inscription
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client', // par défaut
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }
     // ----- Owner -----
    public function showRegisterOwner()
    {
        return view('auth.register-owner');
    }

    public function registerOwner(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'owner',
        ]);

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    // Formulaire login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Connexion
public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'owner') {
            return redirect()->route('dashboard');
        } else {
            return redirect('/');
        }
    }

    return back()->withErrors(['email' => 'Identifiants invalides']);
}


    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('homepage');
    }
}
