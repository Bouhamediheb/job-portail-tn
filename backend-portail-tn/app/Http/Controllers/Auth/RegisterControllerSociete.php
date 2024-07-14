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


class RegisterControllerCompany extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'address' => 'required',
            'phoneNumber' => 'required',
            'fax' => 'required',
            'city' => 'required',
            'country' => 'required',
            'website' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_' . hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move(public_path('images/societe'), $filename);
        } else {
            return back()->withInput()->withErrors('Logo Required');
        }


        $societe = new Societe();

        $societe->name = $request->name;
        $societe->email = $request->email;
        $societe->password = Hash::make($request->password);
        $societe->address = $request->address;
        $societe->phoneNumber = $request->phoneNumber;
        $societe->city = $request->city;
        $societe->country = $request->country;
        $societe->fax = $request->fax;
        $societe->website = $request->website;
        $societe->logo = $filename;

        $societe->save();

        $token = $societe->createToken('token-name')->plainTextToken;
        return response()->json([
            'status' => true,
            'message' => 'Company Created Successfully',
            'token' => $token
        ], 200);
    }
}
