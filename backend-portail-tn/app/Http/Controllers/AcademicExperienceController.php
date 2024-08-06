<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicExperience;

class AcademicExperienceController extends Controller
{
    /**
     * Store a newly created academic experience in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'institute' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'graduation_year' => 'required',
            'profil_id' => 'required|integer'
        ]);

        // Create a new academic experience instance
        $academicExperience = new AcademicExperience();

        // Assign the validated data to the model's attributes
        $academicExperience->institute = $request->institute;
        $academicExperience->degree = $request->degree;
        $academicExperience->graduation_year = $request->graduation_year;
        $academicExperience->profil_id = $request->profil_id;

        // Save the academic experience to the database
        $academicExperience->save();

        // Return a JSON response with the created academic experience
        return response()->json($academicExperience);
    }
}
