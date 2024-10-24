<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $users = User::all(); // Obtener todos los usuarios
        return view('welcome', compact('users'));
    }
    public function recommendedParks()
    {
        $usersOrderedByRating = User::with('ratings')
            ->withCount(['ratings as average_rating' => function ($query) {
                $query->select(\DB::raw('coalesce(avg(rating), 0)'));
            }])
            ->orderByDesc('average_rating')
            ->get();

        return view('recommended_parks', compact('usersOrderedByRating'));
    }
}

