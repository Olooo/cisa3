<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\User;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->only('login', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $token = Auth::user()->createToken(config('app.name'));
        $token->token->expires_at = Carbon::now()->addDay();

        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString()
        ], 200);

        /*{
            "accessToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6Ijk2YWYzNDBlZjVlNTMxZmY0MTc4NmJkM2NiN2QwZjk4Yzh...",
            "token": {
                "id": "96af340ef5e531ff41786bd3cb7d0f98c8c323b30c1a4857a027aa064b1c40adb50a5a0e6668ae46",
                "user_id": 3,
                "client_id": 1,
                "name": "Test App",
                "scopes": [],
                "revoked": false,
                "created_at": "2019-01-15 19:49:37",
                "updated_at": "2019-01-15 19:49:37",
                "expires_at": "2020-01-15 19:49:37"
            }
        }*/
    }

}
