<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    protected $UserService; 

    // Dependency Injection of UserService
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService; 
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get all users
        $Users = User::all();
        // Return the users as JSON with status code 200 (OK)
        return response()->json($Users, 200); 
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data using built-in validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Ensure email is unique
            'password' => 'required|string|min:6', // Password validation
        ]);

        // Create a new user using the UserService
        $User = $this->UserService->createUser($validatedData); 

        // Return the newly created user as JSON with status code 201 (Created)
        return response()->json($User, 201); 
    }

    /*
     * Display the specified resource.
     *
     * @param \App\Models\User $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        // Return the user as JSON with status code 200 (OK)
        return response()->json($User, 200); 
    }

    /*
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $User
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        // Validate the request data using built-in validation
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $User->id, // Ensure email is unique except for the current user
            'password' => 'string|min:6', 
        ]);

        // Update the user using the UserService
        $updated_User = $this->UserService->updateUser($User, $validatedData); 
        // Return the updated user as JSON with status code 200 (OK)
        return response()->json($updated_User, 200); 
    }

    /*
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        // Delete the user using the UserService
        $User = $this->UserService->deleteUser($User); 

        // Return an empty response with status code 204 (No Content) 
        return response()->json(null, 204);
    }
    
}