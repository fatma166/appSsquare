<?php
namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Requests\Api\AuthUserRequest;
use App\Http\Requests\Api\RegisterRequest;
//use App\Http\Resources\UserCollection;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{


    public function login(AuthUserRequest $request){


        $validated= $request->validated();


        $token =Auth::attempt($validated);

        if (!$token) {

                return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
                 'data'=>"",
                ], 401);
        }

        $user = Auth::user();
        return response()->json([
                'status' => 'success',
                'data' =>$user,
                'message'=>'login',
                'token' => $token,

        ],200);

    }

    public function register(RegisterRequest $request) {



        $validated = $request->validated();

            $user= User::create($validated);
            $token = Auth::login($user);
            return response()->json([
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'data' => $user,
                    'token' => $token,

            ],200);
        }

        public function logout()
        {
            Auth::logout();
            return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
            'data'=>""
            ],200);
    }

    public function refresh()
    {
            return response()->json([
            'status' => 'success',
            'data' => Auth::user(),
            'token' => Auth::refresh(),

            ],200);
    }

}
