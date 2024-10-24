<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 

class RegisterController extends Controller
{

    use RegistersUsers;
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string','regex:/^[a-zA-ZÀ-ÿ]+$/', 'max:255',],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:8','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/','confirmed'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'], // Validación para la imagen
            'entry_cost' => ['required', 'string'], // Validar costo de entradas
            'opening_hours' => ['required', 'string'], // Validar horarios de atención
            'transport_cbba' => ['required', 'string'],
            'transport_vt' => ['required', 'string'],
            'lodgings' => ['required', 'string'],
            'location_url' => 'nullable|string',
        ]);
    }

    protected function create(array $data) 
    {
        $profileImagePath = null;

        if (isset($data['profile_image'])) {
            // El archivo debe ser validado antes de llegar aquí
            $profileImagePath = $data['profile_image']->store('profile_images', 'public');
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_image' => $profileImagePath, // Guarda la ruta de la imagen
            'entry_cost' => $data['entry_cost'], // Guardar costo de entradas
            'opening_hours' => $data['opening_hours'], // Guardar horarios de atención
            'transport_cbba' => $data['transport_cbba'],
            'transport_vt' => $data['transport_vt'],
            'lodgings' => $data['lodgings'],
            'location_url' => $data['location_url'], 
        ]);
    }

    public function register(Request $request)
{
    $this->validator($request->all())->validate();

    $user = $this->create($request->all());

    return redirect($this->redirectTo);
}
    
public function showRegistrationForm()
{
    return view('auth.register'); // Asegúrate de que esta vista exista
}
}   