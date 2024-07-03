<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index() : JsonResponse
    {
        $users = User::orderBy('id')->paginate(10);
        
        return response()->json([
            'status' => true,
            'message' => $users,
            ], 200);
    }

    public function show(User $id) : JsonResponse
    {
        return response()->json([
            'status' => true,
            'id' => $id,
            ], 200);
    }

    public function store(Request $request)
    {   
        $validations = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
                'regex:/[A-Z]/', 
                'regex:/[a-z]/', 
                'regex:/[0-9]/', 
                'regex:/[@$!%*?&]/' 
            ],
            'cpf' => 'required|string|unique:users',
            'phone_number' => 'required|string|min:10|max:15',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.cpf' => 'O CPF deve ser um número válido.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'phone_number.required' => 'O número de telefone é obrigatório.',
            'phone_number.min' => 'O número de telefone deve ter no mínimo 10 caracteres.',
            'phone_number.max' => 'O número de telefone não pode ter mais de 15 caracteres.',
        ]);

        // Iniciar a Criação de Usuários
        DB::beginTransaction();

        try{

            $user = User::create([
                'email' => $validations['email'],
                'password' =>  Hash::make($validations['password']),
                'cpf' => $validations['cpf'],
                'phone_number' => $validations['phone_number'],
                'name' => $validations['name'],
            ]);

            DB::commit();

            return response()->json([
                'status' => false,
                'user' =>$user,
                'message' => "Usuário cadastrado com sucesso!",
            ], 201);

        } catch(Exception $e){

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => "Usuário não cadastrado!",
            ], 400);
        }
    }
}
