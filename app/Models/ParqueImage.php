<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParqueImage extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'image_path'];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

