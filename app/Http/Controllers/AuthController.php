<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    use HttpResponses;

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('login');
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate login credentials
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return $this->error($validator->errors(), 'Please fix the errors', 500);
        }

        // if validation passed gather login credentials
        $credentials = $request->only('email', 'password');

        if (! Auth::attempt($credentials)) {
            return $this->error(null, 'Invalid login details', 401);
        }
        Auth::user()->tokens()->delete();
        $token = Auth::user()->createToken('Auth token for ' . Auth::user()->staff_no)->plainTextToken;

        return $this->success(['token' => $token, 'user' => Auth::user()]);
    }

    public function refresh(): \Illuminate\Http\JsonResponse
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return $this->success(['user' => $user, 'token' => $user->createToken($user->staff_no)->plainTextToken]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
//        Auth::user()->currentAccessToken()->delete();
        Auth::user()->tokens()->delete();
        return $this->success([
            'message' => 'You have successfully been logged out'
        ]);
    }
}
