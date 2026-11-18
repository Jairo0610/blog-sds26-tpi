<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'correo' => ['required', 'string', 'email', 'max:255'],
            'contrasena' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingresa un correo electrónico válido.',
            'correo.max' => 'El correo no debe superar los 255 caracteres.',
            'contrasena.required' => 'La contraseña es obligatoria.',
        ];
    }

    /**
     * Intenta autenticar. Bloquea 5 intentos fallidos por minuto (correo + IP).
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // La clave "password" es la que Laravel espera; el modelo Usuario
        // le indica que la columna real se llama "contrasena".
        $credenciales = [
            'email' => $this->input('correo'),
            'password' => $this->input('contrasena'),
        ];

        if (! Auth::attempt($credenciales, $this->boolean('recordar'))) {
            RateLimiter::hit($this->throttleKey(), 60);

            throw ValidationException::withMessages([
                'correo' => 'Estas credenciales no coinciden con nuestros registros.',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

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

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('correo')).'|'.$this->ip());
    }
}
