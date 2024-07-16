<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;

class ProfilController extends Controller
{

    public function index()
    {
        $profils = Profil::all();
        return $profils;
    }

    public function show($id)
    {
        $profil = Profil::find($id);
        return $profil;
    }

    public function store(Request $request)
    {
        $request->validate([
            'profilePicture' => 'required',
            'birthDate' => 'required',
            'bio' => 'required',
            'gender' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phoneNumber' => 'required',
            'website' => 'required',
            'address' => 'required',
            'domain' => 'required',
            'cv' => 'required|file|mimes:pdf',
            'user_id' => 'required|exists:users,id',
        ]);

        $profil = new Profil();

        $profil->profilePicture = $request->profilePicture;
        $profil->birthDate = $request->birthDate;
        $profil->bio = $request->bio;
        $profil->gender = $request->gender;
        $profil->city = $request->city;
        $profil->country = $request->country;
        $profil->phoneNumber = $request->phoneNumber;
        $profil->website = $request->website;
        $profil->address = $request->address;
        $profil->domain = $request->domain;
        $profil->user_id = $request->user_id;

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = 'cv_' . hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move(public_path('images/profil'), $filename);
            $profil->cv = $filename;
        }

        $profil->save();
    }

    public function delete($id)
    {
        $profil = Profil::find($id);
        $profil->delete();
        return response()->json([
            'status' => true,
            'message' => 'Profile Deleted Successfully',
        ], 200);
    }
}
