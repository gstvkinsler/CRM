<?php

// app/Services/UserService.php

namespace App\Http\Services;

use App\Models\Customer;

class CustomerService
{
    public function register(array $data): Customer
    {

        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
        ]);

        return $customer;
    }

    public function updateCustomer(array $data, int $id): Customer
    {   
        $customer = Customer::findOrFail($id);
        $customer->email = $data['email'];
        $customer->name = $data['name']; 
        $customer->phone_number = $data['phone_number'];
        $customer->save();
  
        return $customer;
    }
}
