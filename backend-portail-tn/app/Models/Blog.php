<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', "admin_id"
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function images()
    {
        return $this->hasMany(BlogImage::class);
    }
}
