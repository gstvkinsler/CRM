<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\CustomerRequest;
use App\Http\Services\CustomerService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Customer;
use Exception;

class CustomerController extends Controller
{

    protected $customerService;
    
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request) : JsonResponse
    {
        $users = Customer::orderBy('id')->paginate(10);
        
        return response()->json([
            'status' => true,
            'message' => $users,
            ], 200);
    }

    public function show(Customer $id) : JsonResponse
    {
        return response()->json([
            'status' => true,
            'id' => $id,
            ], 200);
    }


    public function store(CustomerRequest $request): JsonResponse
    {
        $validations = $request->validated();
        try{
            $customer = $this->customerService->register($validations);

            return response()->json([
                "status" => true,
                "message" => 'Cliente criado com sucesso!',
                "customer" => $customer
            ], 200);
          }catch(Exception $e){
            return response()->json([
                "status" => false,
                "message" => 'Não foi possivel cadastrar!',
            ], 404);
        }
    }

    public function update(UpdateCustomerRequest $request, int $id) : JsonResponse
    {   
        $validations = $request->validated();

        $customer = $this->customerService->updateCustomer($validations, $id);
        
        try{     
            return response()->json([
                'status' => true,
                 'message' => "Cliente editado com sucesso!",
                 'user' =>$customer,
             ], 201);
        } catch(Exception $e){
            return response()->json([
                'status' => true,
                'message' => "Usuário não editado!",
                'user' =>$customer,
            ], 400);
        }
        
    }
}
