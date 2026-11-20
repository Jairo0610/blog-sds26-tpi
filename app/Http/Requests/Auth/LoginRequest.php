<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

//Clase de petición de inicio de sesión
class LoginRequest extends FormRequest
{
    //Indica si el usuario puedo realizar la petición
    public function authorize(): bool
    {
        return true;
    }

    //Reglas de validación del formulario
    public function rules(): array
    {
        return [
            'correo' => ['required', 'string', 'email', 'max:255'],
            'contrasena' => ['required', 'string'],
        ];
    }


    //Mensajes personalizados para cada regla
    public function messages(): array
    {
        return [
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingresa un correo electrónico válido.',
            'correo.max' => 'El correo no debe superar los 255 caracteres.',
            'contrasena.required' => 'La contraseña es obligatoria.',
        ];
    }

    //Metodo para autentificar al usuario con las credenciales del formulario
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        //valida el email y compara el pass con el hash guardado
        $credenciales = [
            'email' => $this->input('correo'),
            'password' => $this->input('contrasena'),
        ];


        //Mantener la sesión iniciada mediante las cookies
        if (! Auth::attempt($credenciales, $this->boolean('recordar'))) {
            RateLimiter::hit($this->throttleKey(), 60);

            throw ValidationException::withMessages([
                'correo' => 'Estas credenciales no coinciden con nuestros registros.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    //Comprueba que el usuario no supere el limite de intentos antes de bloquearse
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'correo' => "Demasiados intentos. Vuelve a intentarlo en {$seconds} segundos.",
        ]);
    }

    //Clave con la que se cuentan los intentos
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('correo')).'|'.$this->ip());
    }
}
