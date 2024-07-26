<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'companyName', 'jobTitle', 'startDate', 'endDate', 'location', 'description', 'profil_id'
    ];

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }
}
