<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    //Please add this method
    public function login() {
        // get email and password from request
        $credentials = request(['email', 'password']);
        
        // try to auth and get the token using api authentication
        if (!$token = auth('api')->attempt($credentials)) {
            // if the credentials are wrong we send an unauthorized error in json format
            return response()->json(['error' => 'You are Unauthorized user'], 401);
        }
        $user = User::where('email',request(['email']))->first();
        return response()->json([
            'token' => $token,
            'user' => $user, // you can ommit this
            'expires' => auth('api')->factory()->getTTL() * 60, // time to expiration
            
        ]);
    }

    /**
 * API Register
 *
 * @param Request $request
 * @return \Illuminate\Http\JsonResponse
 */
public function register(Request $request)
{
    $rules = [
        'name' => 'required',
        'email'    => 'unique:users|required',
        'password' => 'required',
    ];

    $input = $request->only('name', 'email','password');
    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'error' => $validator->messages()]);
    }
    $name = $request->name;
    $email    = $request->email;
    $password = $request->password;
    $user     = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);

}

}
