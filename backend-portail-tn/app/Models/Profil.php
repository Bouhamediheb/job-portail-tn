<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    use HasFactory;

    protected $fillable = [
        'profilePicture',
        'birthDate',
        'bio',
        'gender',
        'city',
        'country',
        'phoneNumber',
        'website',
        'address',
        'skills',
        'languages',
        'domain',
        'cv',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function professionalExperiences()
    {
        return $this->hasMany(ProfessionalExperience::class);
    }

    public function academicExperiences()
    {
        return $this->hasMany(AcademicExperience::class);
    }
}
