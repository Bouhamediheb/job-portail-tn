<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Societe;

class SocieteController extends Controller
{
    public function createProfile($id, Request $request)
    {
        $request->validate([
            'address',
            'phoneNumber',
            'fax',
            'city',
            'country',
            'website',
            'logo' => 'file|mimes:jpeg,png,jpg',
        ]);

        $societe = Societe::find($id);

        $societe->address = $request->address;
        $societe->phoneNumber = $request->phoneNumber;
        $societe->fax = $request->fax;
        $societe->city = $request->city;
        $societe->country = $request->country;
        $societe->website = $request->website;

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = 'logo_' . hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move(public_path('images/societe'), $filename);
            $societe->logo = $filename;
        }

        $societe->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile Created Successfully',
        ], 200);
    }

    public function getProfile($id)
    {
        $societe = Societe::find($id);
        return $societe;
    }

    public function getLogo($id)
    {
        $societe = Societe::find($id);
        return response()->file('images/societe/' . $societe->logo);
    }
}
