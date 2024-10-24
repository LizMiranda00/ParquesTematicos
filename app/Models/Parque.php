<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parque extends Model
{
    use HasFactory;

    protected $fillable = ['nombre']; // Añade los campos que se pueden rellenar

    // Define las relaciones si es necesario
    public function parqueImages()
    {
        return $this->hasMany(ParqueImage::class);
    }

    public function parqueVideos()
    {
        return $this->hasMany(ParqueVideo::class);
    }
}
