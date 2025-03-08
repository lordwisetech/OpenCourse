<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'video_url',
        'thumbnail',
        'contents',
        'user_id'
    ];

    // Automatically cast the JSON contents to an array
    protected $casts = [
        'contents' => 'array',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
