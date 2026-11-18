@extends('layouts.auth')

@section('title', 'Panel de control')


@section('content')
<header class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
        <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="h-10 w-auto">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="rounded-lg border border-sds-ink px-4 py-2 text-sm font-semibold hover:bg-sds-ink hover:text-white">
                Cerrar sesión
            </button>
        </form>
    </div>
</header>

<main class="mx-auto max-w-6xl px-6 py-10">
    @if (session('success'))
        <div class="mb-6 rounded-lg border border-sds-green/40 bg-sds-mint px-4 py-3 text-sm font-medium text-sds-green-dark">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-black uppercase">Panel de control</h1>
    <p class="mt-2 text-sds-ink/60">Sesión iniciada como <strong>{{ auth()->user()->correo }}</strong>.</p>
</main>
@endsection
