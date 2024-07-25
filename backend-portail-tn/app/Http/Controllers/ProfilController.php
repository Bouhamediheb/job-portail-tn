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
            'profilePicture',
            'bio' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phoneNumber' => 'required',
            'skills',
            'languages',
            'address',
            'cv' => 'file|mimes:pdf',
            'user_id' => 'required|exists:users,id',
        ]);

        $profil = new Profil();

        $profil->profilePicture = $request->profilePicture;
        $profil->bio = $request->bio;
        $profil->gender = $request->gender;
        $profil->city = $request->city;
        $profil->country = $request->country;
        $profil->phoneNumber = $request->phoneNumber;
        $profil->website = $request->website;
        $profil->address = $request->address;
        $profil->skills = $request->skills;
        $profil->languages = $request->languages;
        $profil->user_id = $request->user_id;

        if ($request->hasFile('profilePicture')) {
            $file = $request->file('profilePicture');
            $filename = 'profil_' . hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move(public_path('images/profil'), $filename);
            $profil->profilePicture = $filename;
        }

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');
            $filename = 'cv_' . hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move(public_path('files/cv'), $filename);
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

    public function getProfilePicture($id)
    {
        $profil = Profil::find($id);
        return response()->file('images/profil/' . $profil->profilePicture);
    }

    //get profil by id 
    public function getProfilById($id)
    {
        $profil = Profil::find($id);
        return $profil;
    }
}
