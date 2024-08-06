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

        return response()->json($profil);
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
        $profil = Profil::find($id)->with('professionalExperiences', 'academicExperiences')->get();
        return $profil;
    }

    public function getProfilByUserId($id)
    {
        // Fetch Profil and related User data
        $profil = Profil::where('user_id', $id)
            ->with(['user', 'professionalExperiences', 'academicExperiences']) // Eager load the related User and experiences
            ->first(); // Use `first()` to get a single record

        // Check if profil was found
        if ($profil) {
            return response()->json($profil);
        } else {
            return response()->json(['error' => 'Profil not found'], 404);
        }
    }

    public function checkProfileExistance($userId)
    {
        if (Profil::where('user_id', $userId)->exists()) {
            return 1;
        } else {
            return 0;
        }
    }
}
