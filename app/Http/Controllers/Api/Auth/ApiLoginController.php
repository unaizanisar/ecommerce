<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiLoginController extends Controller
{
    /**
     * Handle login request for API.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
    
            if ($user->status == 0) {
                return response()->json(['error' => 'Your account is inactive.'], 403);
            }
            // Generate a token for the user
            $token = $user->createToken('API Token')->plainTextToken;
            return response()->json([
                'message' => 'Login successful!',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        // If login fails
        return response()->json(['error' => 'Invalid credentials.'], 401);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Fetch the currently authenticated user
        $user = Auth::guard('sanctum')->user();
        if ($user) {
            // Delete all tokens associated with the user
            $user->tokens()->delete();
            return response()->json(['message' => 'Successfully logged out'], 200);
        }
        return response()->json(['error' => 'User not found.'], 404);
    }
}
