<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'etat',
        'offre_id',
        'user_id'
    ];

    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
