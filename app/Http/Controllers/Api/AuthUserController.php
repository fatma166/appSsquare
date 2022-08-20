<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AuthUserRequest;
use App\Models\User;


class AuthUserController extends Controller
{
    //
    public function login(AuthUserRequest $request){

        $validated = $request->validated();


        if (!auth()->attempt($validated)) {
            return response(['message' => 'inccorrect data'],'401');
        }


        $token =auth()->user()->createToken('API Token')->accessToken;

        return response(['user' => auth()->user(), 'token' => $token]);
    }
}
