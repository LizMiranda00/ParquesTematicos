<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
   

    use AuthenticatesUsers;

   
    protected $redirectTo = '/home';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    protected function authenticated($request, $user)
    {
        // Redirigir al usuario a su página personal después de iniciar sesión
        return redirect()->route('user.show', ['id' => $user->id]);
    }
}
