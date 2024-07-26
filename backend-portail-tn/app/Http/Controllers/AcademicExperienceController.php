<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicExperience;

class AcademicExperienceController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'diploma' => 'required',
            'school' => 'required',
            'obtainedDate' => 'required',
            'description' => 'required',
            'profil_id' => 'required'
        ]);

        $academicExperience = new AcademicExperience();

        $academicExperience->diploma = $request->diploma;
        $academicExperience->school = $request->school;
        $academicExperience->obtainedDate = $request->obtainedDate;
        $academicExperience->description = $request->description;
        $academicExperience->profil_id = $request->profil_id;

        $academicExperience->save();

        return response()->json($academicExperience);
    }
}
