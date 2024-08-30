<?php

namespace App\Services;

use App\Models\User; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    
    public function createUser(array $data)
    {
    
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ])->assignRole('borrower');

    $token = Auth::login($user);
    return response()->json([
        'status' => 'success',
        'message' => 'User created successfully',
        'user' => $user,
        'authorisation' => [
            'token' => $token,
            'type' => 'bearer',
        ]
    ]);
    }

    
    public function updateUser(User $User, array $data)
    {
        $User->update($data); 
        return $User; 
    }

    
    public function deleteUser(User $User)
    {
        $User->delete(); 
    }
}
