<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Retrieve the user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists
        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }

        // Verify the password
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['The provided credentials are incorrect']
            ]);
        }

        // Define token abilities based on user role
        $tokenAbilities = ['basic'];
        if (in_array($user->role, ['admin', 'super admin'])) {
            $tokenAbilities = ['admin', 'product-manage'];
        }

        // Create a new API token for the user with specific abilities
        $token = $user->createToken('api-token', $tokenAbilities)->plainTextToken;

        // Return the response with user details and token
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ],
            'access_token' => $token,
            'token_type' => 'Bearer',
            'abilities' => $tokenAbilities
        ], 200);
    }

    /**
     * Log the user out (invalidate the token).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke all tokens for the user
        $request->user()->tokens()->delete();

        // Return a success message
        return response()->json([
            'message' => 'User logged out successfully'
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user with the validated data
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Return the created user and token as a JSON response
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $user->createToken('api-token')->plainTextToken,
        ])->setStatusCode(201, 'User Created Successfully');
    }
}
