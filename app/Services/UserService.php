<?php

namespace App\Services;

use App\Models\User; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /*
     * Create a new user.
     *
     * @param array $data The data for the new user.
     * @return \Illuminate\Http\JsonResponse The response with user details and token.
     */
    public function createUser(array $data)
    {
        // إنشاء المستخدم 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']), // تشفير كلمة المرور 
        ])->assignRole('borrower'); // تعيين دور "borrower" للمستخدم

        // تسجيل الدخول وتوليد رمز JWT
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

    /*
     * Update an existing user.
     *
     * @param User $User The user object to update.
     * @param array $data The data to update the user with.
     * @return User The updated user object.
     */
    public function updateUser(User $User, array $data)
    {
        $User->update($data); 
        return $User; 
    }

    /*
     * Delete a user.
     *
     * @param User $User The user object to delete.
     * @return void
     */
    public function deleteUser(User $User)
    {
        $User->delete(); 
    }
}
