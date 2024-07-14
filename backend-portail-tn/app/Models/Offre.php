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
        'yearsOfExperience',
        'city',
        'country',
        'address',
        'file',
        'societe_id',
    ];

    public function company()
    {
        return $this->belongsTo(Societe::class);
    }
}
