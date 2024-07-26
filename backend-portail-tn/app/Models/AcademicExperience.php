<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'diploma',
        'school',
        'obtainedDate',
        'description',
        'profil_id'
    ];

    public function profil()
    {
        return $this->belongsTo(Profil::class);
    }
}
