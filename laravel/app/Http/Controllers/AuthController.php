<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();

            return redirect()->route('filme.index')->with('mensagem', 'Login realizado');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas'
        ])->onlyInput('email');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function showRegister() {
        return view('auth.register');
    }

    public function register(Request $request) {
        $dados = $request->validate([
            'name' => 'required|min:1|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|confirmed',
        ]);

        $dados['password'] = Hash::make($dados['password']);
        $dados['is_admin'] = $request->boolean('is_admin'); // ← nova linha

        $usuario = User::create($dados);

        Auth::login($usuario);

        return redirect()->route('filme.index')->with('mensagem', 'Cadastro realizado');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('filme.index')->with('mensagem', 'Logout realizado');
    }
}
