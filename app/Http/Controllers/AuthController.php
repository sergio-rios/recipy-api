<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;

class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        $user = User::where(['email' => $request->email])->first();

        if (!isset($user)) {
            return $this->errorResponse('unauthorized_email', 401);
        }
        elseif ($user->verified) {
            if (! $token = auth()->attempt($credentials)) {
                return $this->errorResponse('unauthorized_pass', 401);
            }
    
            $response['token'] = $token;
            $response['expires'] = auth()->factory()->getTTL() * 60;
            $response['user'] = auth()->user();
    
            return $this->successResponse($response);
        }
        else {
            return $this->errorResponse('verified', 403);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            $response['token'] = auth()->refresh();
            $response['expires'] = auth()->factory()->getTTL() * 60;
            $response['user'] = auth()->user();
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return $this->errorResponse($e->getMessage, 401);
        }
        
        return $this->successResponse($response);
    }
}
