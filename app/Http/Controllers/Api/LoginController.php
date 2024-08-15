<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class LoginController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            
            $token = $request->user()->createToken('api-token')->plainTextToken;

            return response()->json([
                "status" => true,
                "token" => $token,
                "user" => $user,
            ], 200);
        }else{
            return response()->json([
                "status" => false,
                "message" => 'Login ou senha incorreta!'
            ], 404);
        }
    }

    public function logout(User $user) : JsonResponse
    {
      try{
        $user->tokens()->delete();

        return response()->json([
            "status" => true,
            "message" => 'Usuário deslogado com sucesso!',
        ], 200);
      }catch(Exception $e){

        return response()->json([
            "status" => false,
            "message" => 'Falha ao deslogar!',
        ], 404);
      }
    }
}
