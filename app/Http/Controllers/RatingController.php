<?php
namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request , $userId )
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        
    
        // Guardar la nueva calificación
        Rating::create([
            'user_id' => $userId,
           
            'rating' => $request->rating,
        ]);
    
        return back()->with('success', 'Gracias por tu calificación');
    }
    
    

}

