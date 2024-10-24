<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RatingController;
// Ruta para la página de bienvenida
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Rutas de autenticación (login, register, password reset)
Auth::routes();

// Ruta para el dashboard después de iniciar sesión
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas para el perfil del usuario
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');

// Rutas específicas para login y registro (si se necesita)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::delete('/user/{user}/deleteImage/{image}', [UserController::class, 'deleteImage'])->name('user.deleteImage');
Route::delete('/user/{user}/deleteVideo/{video}', [UserController::class, 'deleteVideo'])->name('user.deleteVideo');

Route::get('/user/profile/{id}', [UserController::class, 'show'])->name('profile');
//calificacion
Route::post('/users/{user}/rate', [RatingController::class, 'store'])->name('ratings.store');

Route::get('/recommended-parks', [UserController::class, 'recommendedParks'])->name('recommended.parks');
