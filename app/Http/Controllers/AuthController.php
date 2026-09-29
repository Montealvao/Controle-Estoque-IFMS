<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByPerfil();
        }

        return view('auth.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'E-mail ou senha inválidos.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectByPerfil();
    }


    public function logout(AuthRequest $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectByPerfil()
    {
        $perfil = Auth::user()->perfil;

        if ($perfil === 'admin') {
            return redirect()->route('painel');
        }

        if ($perfil === 'cliente') {
            return redirect()->route('painel');
        }

        Auth::logout();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Perfil de usuário inválido.',
            ]);
    }
}