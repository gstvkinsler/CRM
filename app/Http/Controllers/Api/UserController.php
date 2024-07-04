<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Request;

class UserController extends Controller
{
    protected $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request) : JsonResponse
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

    public function store(StoreUserRequest $request): JsonResponse
    {
        $validations = $request->validated();

        try {
            $user = $this->userService->register($validations);

            return response()->json([
                'status' => true,
                'message' => "Usuário cadastrado com sucesso!",
                'user' => $user,
            ], 201);
        } catch (Exception $e) {
            \Log::info($e->getMessage());

            return response()->json([
                'status' => false,
                'message' => "Não foi possível criar o usuário. Tente novamente mais tarde.",
            ], 500);
        }
    }
}
