@extends('layouts.auth')

@section('title', 'Iniciar sesión')

@section('content')
<div class="flex min-h-screen flex-col lg:flex-row">

    {{-- Panel izquierdo: identidad del evento --}}
    <aside class="relative hidden overflow-hidden bg-sds-mint lg:flex lg:w-1/2 lg:flex-col lg:justify-between lg:p-12 xl:p-16">
        <span class="sds-stripes left-0 top-0"></span>
        <span class="sds-stripes bottom-0 right-0 rotate-180"></span>

        {{-- Logos --}}
        <div class="relative flex items-center gap-6">
            <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS - Universidad de El Salvador" class="h-12 w-auto xl:h-14" >
            <span class="h-14 w-px bg-sds-ink"></span>
            <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="h-16 w-auto xl:h-20">
        </div>

        {{-- Mensaje principal --}}
        <div class="relative">
            <p class="mb-3 text-sm font-semibold uppercase tracking-[0.3em] text-sds-green-dark">Blog oficial</p>
            <h1 class="text-4xl font-black uppercase leading-tight xl:text-5xl">
                Semana de<br>Sistemas <span class="text-sds-green">2026</span>
            </h1>
            <p class="mt-6 max-w-md text-2xl font-light italic leading-snug text-sds-ink/70 xl:text-3xl">
                Bienvenido. Comparte lo que vivimos durante la semana.
            </p>
        </div>

        {{-- Bloque estilo itinerario --}}
        <div class="relative grid max-w-md grid-cols-[auto_1fr] overflow-hidden rounded-xl shadow-sm">
            <div class="flex flex-col items-center justify-center bg-sds-green px-6 py-4 text-white">
                <span class="text-3xl font-black leading-none">16-20</span>
                <span class="text-xs font-bold uppercase tracking-wider">Noviembre</span>
            </div>
            <div class="bg-white px-5 py-4">
                <p class="text-lg font-extrabold italic uppercase">Green IoT</p>
                <p class="text-xs font-semibold uppercase text-sds-ink/70">Facultad Multidisciplinaria Oriental</p>
            </div>
        </div>
    </aside>



    {{-- Panel derecho: formulario--}}
    <main class="relative flex flex-1 items-center justify-center overflow-hidden px-6 py-12 sm:px-10">
        {{-- Franjas visibles solo en móvil --}}
        <span class="sds-stripes left-0 top-0 scale-75 -translate-x-4 -translate-y-4 lg:hidden"></span>
        <span class="sds-stripes bottom-0 right-0 rotate-180 scale-75 translate-x-4 translate-y-4 lg:hidden"></span>

        <div class="relative w-full max-w-md">

            {{-- Logo para móvil --}}
            <div class="mb-10 flex items-center justify-center gap-4 lg:hidden">
                <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS" class="h-9 w-auto">
                <span class="h-10 w-px bg-sds-ink"></span>
                <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="h-12 w-auto">
            </div>

            <h2 class="text-3xl font-extrabold uppercase">Iniciar sesión</h2>
            <p class="mt-2 text-sm text-sds-ink/60">Área administrativa del blog de la Semana de Sistemas 2026.</p>

            {{-- Mensaje de confirmación (por ejemplo, al cerrar sesión) --}}
            @if (session('success'))
                <div class="mt-6 rounded-lg border border-sds-green/40 bg-sds-mint px-4 py-3 text-sm font-medium text-sds-green-dark">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5" novalidate>
                @csrf

                {{-- Correo --}}
                <div>
                    <label for="correo" class="mb-1.5 block text-sm font-medium">Correo electrónico</label>
                    <input id="correo" name="correo" type="email" value="{{ old('correo') }}"
                        autocomplete="username" autofocus required
                        placeholder="carnet@ues.edu.sv"
                        @class([
                            'w-full rounded-lg border bg-white px-4 py-3 text-sm outline-none transition placeholder:text-sds-ink/40 focus:ring-4',
                            'border-red-400 focus:border-red-500 focus:ring-red-100' => $errors->has('correo'),
                            'border-gray-300 focus:border-sds-green focus:ring-sds-green/20' => ! $errors->has('correo'),
                        ])>
                    @error('correo')
                        <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div>
                    <label for="contrasena" class="mb-1.5 block text-sm font-medium">Contraseña</label>
                    <div class="relative">
                        <input id="contrasena" name="contrasena" type="password"
                            autocomplete="current-password" required
                            placeholder="Ingresa tu contraseña"
                            @class([
                                'w-full rounded-lg border bg-white py-3 pl-4 pr-12 text-sm outline-none transition placeholder:text-sds-ink/40 focus:ring-4',
                                'border-red-400 focus:border-red-500 focus:ring-red-100' => $errors->has('contrasena'),
                                'border-gray-300 focus:border-sds-green focus:ring-sds-green/20' => ! $errors->has('contrasena'),
                            ])>
                        <button type="button" data-toggle-password="contrasena"
                            class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-sds-ink/40 hover:text-sds-green-dark"
                            aria-label="Mostrar u ocultar contraseña">
                            {{-- ojo abierto --}}
                            <svg data-eye="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            {{-- ojo tachado --}}
                            <svg data-eye="hide" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" class="hidden size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    @error('contrasena')
                        <p class="mt-1.5 text-xs font-medium text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Recordarme --}}
                <label for="recordar" class="flex cursor-pointer items-center gap-2 text-sm text-sds-ink/70">
                    <input id="recordar" name="recordar" type="checkbox" value="1" @checked(old('recordar'))
                        class="size-4 rounded border-gray-300 accent-sds-green">
                    Mantener sesión iniciada
                </label>

                <button type="submit"
                    class="w-full rounded-lg bg-sds-green px-4 py-3 text-sm font-bold uppercase tracking-wider text-white shadow-sm transition hover:bg-sds-green-dark focus:outline-none focus:ring-4 focus:ring-sds-green/30">
                    Ingresar
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-sds-ink/60">
                ¿Solo quieres leer el blog?
                <a href="{{ route('home') }}" class="font-semibold text-sds-green-dark hover:underline">Ir al inicio</a>
            </p>
        </div>
    </main>
</div>
@endsection
