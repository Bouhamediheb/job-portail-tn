<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offre;

class OffreController extends Controller
{
    public function index()
    {
        $offres = Offre::all();
        return $offres;
    }

    public function show($id)
    {
        $offre = Offre::find($id);
        return $offre;
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'city' => 'required',
            'country' => 'required',
            'minSalary',
            'maxSalary',
            'employmentType',
            'yearsOfExperience',
            'hourlyWage',
            'internshipMotivation',
            'internshipDuration',
            'workplace' => 'required',
            'skills' => 'required',
            'description' => 'required',
            'address' => 'required',
            'file' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|nullable',
            'company_id' => 'required|exists:companies,id',
        ]);

        $offre = new Offre();

        $offre->title = $request->title;
        $offre->type = $request->type;
        $offre->city = $request->city;
        $offre->employmentType = $request->employmentType;
        $offre->country = $request->country;
        $offre->minSalary = $request->minSalary;
        $offre->maxSalary = $request->maxSalary;
        $offre->hourlyWage = $request->hourlyWage;
        $offre->internshipMotivation = $request->internshipMotivation;
        $offre->internshipDuration = $request->internshipDuration;
        $offre->yearsOfExperience = $request->yearsOfExperience;
        $offre->workplace = $request->workplace;
        $offre->skills = $request->skills;
        $offre->description = $request->description;
        $offre->address = $request->address;
        $offre->company_id = $request->company_id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'job_' . hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move(public_path('files/offres'), $filename);
            $offre->file = $filename;
        }

        $offre->save();

        return response()->json([
            'status' => true,
            'message' => 'Job Created Successfully',
        ], 200);
    }


    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'city' => 'required',
            'country' => 'required',
            'minSalary',
            'maxSalary',
            'employmentType',
            'yearsOfExperience',
            'hourlyWage',
            'internshipMotivation',
            'internshipDuration',
            'workplace' => 'required',
            'skills' => 'required',
            'description' => 'required',
            'address' => 'required',
            'file' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|nullable',
            'societe_id' => 'required|exists:societes,id',
        ]);

        $offre = Offre::find($id);

        $offre->title = $request->title;
        $offre->type = $request->type;
        $offre->city = $request->city;
        $offre->employmentType = $request->employmentType;
        $offre->country = $request->country;
        $offre->minSalary = $request->minSalary;
        $offre->maxSalary = $request->maxSalary;
        $offre->hourlyWage = $request->hourlyWage;
        $offre->internshipMotivation = $request->internshipMotivation;
        $offre->internshipDuration = $request->internshipDuration;
        $offre->yearsOfExperience = $request->yearsOfExperience;
        $offre->workplace = $request->workplace;
        $offre->skills = $request->skills;
        $offre->description = $request->description;
        $offre->address = $request->address;
        $offre->company_id = $request->company_id;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'job_' . hexdec(uniqid()) . '.' . strtolower($file->getClientOriginalExtension());
            $file->move(public_path('files/offres'), $filename);
            $offre->file = $filename;
        }

        $offre->save();

        return response()->json([
            'status' => true,
            'message' => 'Job Created Successfully',
        ], 200);
    }


    public function delete($id)
    {
        $offre = Offre::find($id);

        $offre->delete();
        return response()->json([
            'status' => true,
            'message' => 'Job Deleted Successfully',
        ], 200);
    }
}
