<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas ou você não está cadastrado.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[\W_]/',
            ],
        ], [
            'email.required' => 'O campo de email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.unique' => 'Este email já está cadastrado.',

            'password.required' => 'O campo de senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'As senhas não coincidem.',
            'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma minúscula, um número e um caractere especial.',
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login.form')->with('success', 'Cadastro realizado com sucesso! Faça login.');
    }

    public function logout(Request $request)
    {
        // Realiza o logout do usuário, removendo a autenticação atual.
        Auth::logout();

        // Invalida a sessão atual para garantir que qualquer dado relacionado à sessão seja descartado.
        $request->session()->invalidate();

        // Regenera o token CSRF para evitar que o usuário utilize o token antigo após o logout.
        $request->session()->regenerateToken();

        // Redireciona o usuário para a página de login com uma mensagem de sucesso.
        return redirect()->route('login.form')->with('success', 'Logout realizado com sucesso.');
    }
}
