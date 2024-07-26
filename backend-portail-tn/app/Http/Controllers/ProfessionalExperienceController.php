<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfessionalExperience;

class ProfessionalExperienceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'companyName' => 'required',
            'jobTitle' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
            'location' => 'required',
            'description'
        ]);

        $professionalExperience = new ProfessionalExperience();

        $professionalExperience->companyName = $request->companyName;
        $professionalExperience->jobTitle = $request->jobTitle;
        $professionalExperience->startDate = $request->startDate;
        $professionalExperience->endDate = $request->endDate;
        $professionalExperience->location = $request->location;
        $professionalExperience->description = $request->description;
        $professionalExperience->profil_id = $request->profil_id;

        $professionalExperience->save();

        return response()->json($professionalExperience);
    }
}
