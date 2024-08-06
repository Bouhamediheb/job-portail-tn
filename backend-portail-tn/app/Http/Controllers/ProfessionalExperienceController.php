<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfessionalExperience;

class ProfessionalExperienceController extends Controller
{
    /**
     * Store a newly created professional experience in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'companyName' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:255',
            'startDate' => 'required',
            'endDate' => 'required',
            'profil_id' => 'required'
        ]);

        // Create a new professional experience instance
        $professionalExperience = new ProfessionalExperience();

        // Assign the validated data to the model's attributes
        $professionalExperience->companyName = $request->companyName;
        $professionalExperience->jobTitle = $request->jobTitle;
        $professionalExperience->startDate = $request->startDate;
        $professionalExperience->endDate = $request->endDate;
        $professionalExperience->profil_id = $request->profil_id;

        // Save the professional experience to the database
        $professionalExperience->save();

        // Return a JSON response with the created professional experience
        return response()->json($professionalExperience);
    }
}
