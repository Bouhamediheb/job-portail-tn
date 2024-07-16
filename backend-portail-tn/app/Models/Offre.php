<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'employmentType',
        'workplace',
        'description',
        'minSalary',
        'maxSalary',
        'hourlyWage',
        'domain',
        'featured',
        'internshipMotivation',
        'internshipDuration',
        'yearsOfExperience',
        'city',
        'country',
        'address',
        'skills',
        'file',
        'societe_id',
    ];

    public function societe()
    {
        return $this->belongsTo(Societe::class);
    }
}
