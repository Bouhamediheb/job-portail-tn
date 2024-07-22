<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Prompts\Output\ConsoleOutput;
use Laravel\Sanctum\HasApiTokens;

class LoginControllerAdmin extends Controller
{
    use HasFactory, Notifiable, HasApiTokens;
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $admin = Auth::guard('admin')->user();
            $token = $admin->createToken('token-name')->plainTextToken;
            return response()->json([
                'status' => true,
                'message' => 'Admin Logged In Successfully',
                'token' => $token,
                'admin' => $admin
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Credentials'
            ], 401);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
