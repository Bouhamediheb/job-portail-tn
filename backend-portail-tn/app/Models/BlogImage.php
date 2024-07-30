<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'blog_id'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
