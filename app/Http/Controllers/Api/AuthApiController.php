<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'cpf' => 'required|string|size:11|unique:users',
            'telefone' => 'required|string|max:20',
            'data_nascimento' => 'required|date|before:-18 years',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nome' => $validated['nome'],
            'email' => $validated['email'],
            'cpf' => $validated['cpf'],
            'telefone' => $validated['telefone'],
            'data_nascimento' => $validated['data_nascimento'],
            'password' => Hash::make($validated['password']),
            'saldo' => 0,
            'is_admin' => false,
            'ativo' => true,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        if (!$user->ativo) {
            return response()->json([
                'success' => false,
                'message' => 'Sua conta está bloqueada. Entre em contato com o suporte.',
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'user' => $user,
            'token' => $token,
        ]);
    }
}

