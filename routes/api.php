<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Support\Facades\Route;

// Route::get('/users', function (Request $request) {
//     return response()->json([
//         'status' => true,
//         'message' => "Listar usuários",
//     ],200);
// });
Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::get('/users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::post('/logout/{id}', [LoginController::class, 'logout']);
});

Route::get('/foo', [UserController::class, 'index'])->name('login');