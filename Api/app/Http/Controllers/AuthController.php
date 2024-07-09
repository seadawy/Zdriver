<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $re){

        $validator = Validator::make($re->all(), [
            'name' => 'required',
            'address' => 'required',
            'role' => 'required',
            'password' => 'required|min:8',
            'gender' => 'required|bool',
            'phone' => 'required',
            'email' => 'required|email',
            'company_id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['password'] = bcrypt($re->password);
        $user=User::create($data);

        $token = $user->createToken($re->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'message' => 'The provided credentials are incorrect.'
            ];
        }
        $token = $user->createToken($user->name);
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }
    public function me(Request $request)
    {
        return $request->user();
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return [
            'message' => 'You are logged out.'
        ];
    }
}
