<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\JsonFuncionalidadesKey;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Buscar usuario por email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        // Verificar contraseña
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Contraseña incorrecta'], 401);
        }

        // Login correcto
        return response()->json([
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role_id' => $user->role_id
            ]
        ]);
    }
    
  

    public function getUserFunctionalities($userId,$parentKey)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

       // Lista de funcionalidades permitidas por el rol
        $allowedFunctionalities = $user->role->functionalities->pluck('id');

        // Filtrar las keys de la tabla JSON que coincidan con las funcionalidades
        $keys = JsonFuncionalidadesKey::
        whereIn('id_frontparent', $allowedFunctionalities)
        ->where('parent_key',$parentKey)
        ->get();

        return response()->json($keys);
    }



}
/*
namespace App\Http\Controllers;

use App\Models\Role;

class RoleController extends Controller
{
    public function getUserFunctionalities($role_id)
    {
        $functionalities = Role::find($role_id)
            ->functionalities()
            ->pluck('name');

        return response()->json($functionalities);
    }
}*/
