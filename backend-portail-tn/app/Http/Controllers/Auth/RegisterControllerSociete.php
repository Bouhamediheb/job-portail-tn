<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Models\Societe;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\ValidationException;


class RegisterControllerSociete extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:societes,email',
            'password' => 'required|min:8',
        ]);

        $societe = new Societe();

        $societe->name = $request->name;
        $societe->email = $request->email;
        $societe->password = Hash::make($request->password);

        $societe->save();

        $token = $societe->createToken('token-name')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'Company Created Successfully',
            'token' => $token
        ], 200);
    }
}
