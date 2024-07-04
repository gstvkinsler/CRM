<?php

// app/Services/UserService.php

namespace App\Http\Services;

use App\Models\User;
use App\Models\DocumentUser;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
        ]);

        $this->createDocuments($user->id, $data['documents']);

        return $user;
    }

    protected function createDocuments(int $userId, array $documents)
    {
        $documentos = [];
        foreach ($documents as $document) {
            $documentos[] = [
                'user_id' => $userId,
                'type' => $document['type'],
                'document' => $document['document'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DocumentUser::insert($documentos);
    }
}
