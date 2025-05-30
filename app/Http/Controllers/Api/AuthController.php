<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        // 1) Validar entrada
        $data = $req->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // 2) Obtener usuario por email
        $user = User::where('email', $data['email'])->first();
        if (! $user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // 3) Verificar contraseña
        if (! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        // 4) Generar token de Sanctum
        $token = $user->createToken('geo-token')->plainTextToken;

        // 5) Devolver token y datos de usuario
        return response()->json([
            'token' => $token,
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
        ]);
    }

    public function logout(Request $req)
    {
        // Eliminar el token con el que se hizo la petición
        $req->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Desconectado correctamente']);
    }

    public function me(Request $req)
    {
        // Devuelve los datos del usuario autenticado
        return response()->json([
            'id'    => $req->user()->id,
            'name'  => $req->user()->name,
            'email' => $req->user()->email,
        ]);
    }
}
