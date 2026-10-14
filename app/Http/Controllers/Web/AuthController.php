<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->isAdmin())  return redirect()->route('admin.dashboard');
            if ($user->isCoach())  return redirect()->route('coach.dashboard');
            if ($user->isPlayer()) return redirect()->route('player.dashboard');
        }

        return view('auth.iniciar-sesion');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Tu cuenta está inactiva.',
                ]);
            }

            if ($user->isAdmin())  return redirect()->intended(route('admin.dashboard'));
            if ($user->isCoach())  return redirect()->intended(route('coach.dashboard'));
            if ($user->isPlayer()) return redirect()->intended(route('player.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}