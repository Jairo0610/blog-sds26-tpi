<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

//Controlador de autentificación
class LoginController extends Controller
{
    //Muestra el formulario al iniciar la sesión
    public function create(): View
    {
        return view('auth.login');
    }

    //Metodo para realizar el inicio de sesión del usuario mediante el formulario
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'))->with('success', '¡Bienvenido, '.Auth::user()->name.'!');
    }

    //Metodo para cerrar la sesión actual
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Has cerrado sesión correctamente.');
    }
}
