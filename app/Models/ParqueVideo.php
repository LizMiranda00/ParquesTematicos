<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParqueVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'video_path'
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

