<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\User;

class UserController extends Controller
{
    protected $UserService; 

    
    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService; 
    }
    public function index(Request $request)
    {
        $Users = User::all();
        return response()->json($Users, 200); 
    }

    
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
    

        
        $User = $this->UserService->createUser($validatedData); 

        return response()->json($User, 201); 
    }

    /**
     * Display the specified resource 
     */
    public function show(User $User)
    {
        return response()->json($User, 200); 
    }


    public function update(Request $request, User $User)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:6',
        ]);

        
        $updated_User = $this->UserService->updateUser($User, $validatedData); 
        return response()->json($updated_User, 200); 
    }

    
    public function destroy(User $User)
    {
        
        $User = $this->UserService->deleteUser($User); 
        
        return response()->json(null, 204);}
    
    }

