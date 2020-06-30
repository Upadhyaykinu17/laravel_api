<?php

namespace App\Http\Controllers\Api;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate ([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if( !Auth::attempt($credentials)){
            return response(['message' => 'wrong credentials']);
        }

        $accessToken = Auth::user()->createToken('AuthToken')->accessToken;
        return response(['logedin' => 'you are loged in' ,'user' => Auth::user(), 'access_token' => $accessToken]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails()){
            return response(['message' => $validator->errors()]);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $accessToken = $user->createToken('AuthToken')->accessToken;
        return response(['message' => 'sign up successfully', 'access_token' => $accessToken]);
    }

}
