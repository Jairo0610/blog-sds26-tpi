<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog · Semana de Sistemas 2026</title>
    <meta name="description" content="Blog oficial de la Semana de Sistemas 2026 · Green IoT, Facultad Multidisciplinaria Oriental.">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800,900&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-[Poppins] text-sds-ink antialiased">

    {{--  Encabezado  --}}
    <header class="sticky top-0 z-30 border-b border-black/5 bg-white/90 backdrop-blur">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-5 sm:h-20">
            <a href="{{ route('home') }}" class="flex items-center gap-3 sm:gap-4">
                <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS" class="h-7 w-auto sm:h-9">
                <span class="h-8 w-px bg-sds-ink/80 sm:h-10"></span>
                <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="h-9 w-auto sm:h-12">
            </a>

            <nav class="flex items-center gap-1 sm:gap-2">
                <a href="#publicaciones" class="hidden rounded-full px-4 py-2 text-sm font-medium text-sds-ink/70 hover:text-sds-ink md:block">Publicaciones</a>
                <a href="#ponencias" class="hidden rounded-full px-4 py-2 text-sm font-medium text-sds-ink/70 hover:text-sds-ink md:block">Ponencias</a>
                <a href="#actividades" class="hidden rounded-full px-4 py-2 text-sm font-medium text-sds-ink/70 hover:text-sds-ink md:block">Actividades</a>
                @auth
                    @php
                        $usuario = auth()->user();
                        $iniciales = collect(explode(' ', trim($usuario->name)))->filter()->take(2)
                            ->map(fn ($parte) => mb_strtoupper(mb_substr($parte, 0, 1)))->implode('');
                    @endphp

                    {{-- Perfil del usuario con sesión iniciada --}}
                    <details class="group relative">
                        <summary class="flex cursor-pointer list-none items-center gap-2.5 rounded-full py-1 pl-1 pr-3 transition hover:bg-sds-mint [&::-webkit-details-marker]:hidden">
                            <span class="grid size-9 place-items-center rounded-full bg-sds-green text-sm font-bold text-sds-ink">{{ $iniciales }}</span>
                            <span class="hidden text-left leading-tight sm:block">
                                <span class="block text-sm font-semibold">{{ $usuario->name }}</span>
                                <span class="block text-xs text-sds-ink/50">{{ $usuario->carnet ?? $usuario->email }}</span>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-4 text-sds-ink/50 transition group-open:rotate-180"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                        </summary>

                        <div class="absolute right-0 mt-2 w-64 overflow-hidden rounded-xl border border-black/5 bg-white shadow-lg">
                            <div class="border-b border-black/5 px-4 py-3">
                                <p class="truncate text-sm font-semibold">{{ $usuario->name }}</p>
                                <p class="truncate text-xs text-sds-ink/55">{{ $usuario->email }}</p>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2.5 text-sm hover:bg-sds-mint">Mi panel</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full px-4 py-2.5 text-left text-sm text-red-600 hover:bg-red-50">Cerrar sesión</button>
                            </form>
                        </div>
                    </details>
                @else
                    <a href="{{ route('login') }}" class="rounded-full bg-sds-ink px-4 py-2 text-sm font-semibold text-white hover:bg-sds-ink/85">Iniciar sesión</a>
                @endauth
            </nav>
        </div>
    </header>

    {{--  Portada  --}}
    <section class="relative overflow-hidden bg-sds-mint">
        <span class="sds-stripes left-0 top-0 hidden sm:block"></span>
        <span class="sds-stripes bottom-0 right-0 rotate-180"></span>

        <div class="relative mx-auto max-w-6xl px-5 py-16 sm:py-24">
            <img src="{{ asset('img/sds26-logo.png') }}" alt="" class="pointer-events-none absolute right-5 top-1/2 hidden w-80 -translate-y-1/2 lg:block xl:w-96">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-sds-green-dark">Blog oficial</p>
            <h1 class="mt-4 text-4xl font-black uppercase leading-[1.05] sm:text-6xl">
                Semana de<br>Sistemas <span class="text-sds-green">2026</span>
            </h1>
            <p class="mt-5 inline-block bg-sds-ink px-3 py-1 text-lg font-extrabold uppercase italic text-white sm:text-xl">
                Green IoT
            </p>
            <p class="mt-6 max-w-xl text-lg text-sds-ink/70">
                Crónicas, fotografías y aprendizajes de cada actividad de la semana, contados por los estudiantes de Ingeniería de Sistemas Informáticos de la FMO.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="#publicaciones" class="rounded-full bg-sds-green px-6 py-3 text-sm font-bold uppercase tracking-wide text-sds-ink transition hover:bg-sds-green-dark hover:text-white">
                    Leer publicaciones
                </a>
                <a href="#ponencias" class="rounded-full border-2 border-sds-ink px-6 py-3 text-sm font-bold uppercase tracking-wide transition hover:bg-sds-ink hover:text-white">
                    Ver ponencias
                </a>
            </div>
        </div>
    </section>

    {{--  Publicaciones  --}}
    <section id="publicaciones" class="scroll-mt-20 py-16 sm:py-20">
        <div class="mx-auto max-w-6xl px-5">
            <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
                <div>
                    <h2 class="text-3xl font-extrabold uppercase sm:text-4xl">Publicaciones</h2>
                    <p class="mt-2 text-sds-ink/60">Todo lo que vivimos durante la Semana de Sistemas.</p>
                </div>

                {{-- Filtro por categoría --}}
                @if ($categorias->isNotEmpty())
                    <div class="mt-5 flex flex-wrap items-center gap-3">
                        @auth
                            <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-1.5 rounded-full bg-linear-to-br from-sds-green to-sds-green-dark px-4 py-2 text-[13px] font-bold text-white no-underline shadow-[0_3px_10px_rgba(111,165,43,.28)]">
                                <span>+ Nueva publicación</span>
                            </a>
                        @endauth
                        <label for="filtro-categoria" class="text-sm font-semibold text-sds-ink/70">
                            Categoría:
                        </label>
                        <select
                            id="filtro-categoria"
                            name="categoria"
                            onchange="if (this.value) { window.location.href = this.value; }"
                            class="cursor-pointer rounded-xl border border-[#cfd7cb] bg-white px-3.5 py-2 text-[13.5px] font-semibold text-sds-ink"
                        >
                            <option value="{{ route('home') }}#publicaciones" @selected(! $categoriaActual)>
                                Todas las categorías
                            </option>
                            @foreach ($categorias as $categoria)
                                <option
                                    value="{{ route('home', ['categoria' => $categoria->slug]) }}#publicaciones"
                                    @selected($categoriaActual === $categoria->slug)
                                >
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            @if ($posts->isEmpty())
                <div class="mt-10 rounded-2xl border-2 border-dashed border-sds-green/40 bg-sds-mint/50 px-6 py-16 text-center">
                    <p class="text-lg font-semibold">Pronto habrá publicaciones aquí</p>
                    <p class="mt-1 text-sds-ink/60">El equipo está preparando las primeras crónicas de la semana.</p>
                </div>
            @else
                <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $post)
                        @php
                            $enlace = Route::has('posts.show') ? route('posts.show', $post->slug) : null;
                        @endphp
                        <article class="group relative flex flex-col overflow-hidden rounded-2xl border border-black/5 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                            {{-- Imagen o portada de respaldo --}}
                            <div class="relative aspect-[16/10] overflow-hidden bg-sds-mint">
                                @if ($post->imagen_principal)
                                    <img src="{{ asset('storage/'.$post->imagen_principal) }}" alt="{{ $post->titulo }}"
                                        class="size-full object-cover transition duration-500 group-hover:scale-105" loading="lazy">
                                @else
                                    <span class="sds-stripes -right-4 -top-4 scale-75"></span>
                                    <img src="{{ asset('img/sds26-logo.png') }}" alt="" class="absolute left-1/2 top-1/2 h-14 w-auto -translate-x-1/2 -translate-y-1/2 opacity-80">
                                @endif
                                @if ($post->categoria)
                                    <span class="absolute bottom-3 left-3 rounded-full bg-white px-3 py-1 text-xs font-semibold shadow-sm">
                                        {{ $post->categoria->nombre }}
                                    </span>
                                @endif
                            </div>

                            <div class="flex flex-1 flex-col p-5">
                                <h3 class="text-lg font-bold leading-snug">
                                    @if ($enlace)
                                        <a href="{{ $enlace }}" class="after:absolute after:inset-0 hover:text-sds-green-dark">{{ $post->titulo }}</a>
                                    @else
                                        {{ $post->titulo }}
                                    @endif
                                </h3>
                                @if ($post->resumen)
                                    <p class="mt-2 line-clamp-3 text-sm text-sds-ink/65">{{ $post->resumen }}</p>
                                @endif
                                @php
                                    $autoresTexto = ($post->autores && $post->autores->isNotEmpty())
                                        ? $post->autores->pluck('name')->join(', ')
                                        : ($post->usuario->name ?? null);
                                @endphp
                                @if ($autoresTexto)
                                    <p class="mt-auto pt-5 text-xs font-medium text-sds-ink/50">Por {{ $autoresTexto }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <div class="mt-12">
                        {{ $posts->fragment('publicaciones')->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>

    {{--  Ponencias  --}}
    <section id="ponencias" class="relative scroll-mt-20 overflow-hidden bg-sds-ink py-16 text-white sm:py-20">
        <span class="sds-stripes right-0 top-0 rotate-90"></span>

        <div class="relative mx-auto max-w-6xl px-5">
            <h2 class="text-3xl font-extrabold uppercase sm:text-4xl">Ponencias</h2>
            <p class="mt-2 text-white/60">Charlas con especialistas sobre tecnología y sostenibilidad.</p>

            @if ($ponencias->isEmpty())
                <p class="mt-10 text-white/60">Las ponencias se anunciarán pronto.</p>
            @else
                <div class="mt-10 grid gap-5 md:grid-cols-2">
                    @foreach ($ponencias as $ponencia)
                        <article class="flex overflow-hidden rounded-2xl bg-white text-sds-ink">
                            {{-- Bloque de horario, como en los afiches --}}
                            <div class="flex w-28 shrink-0 flex-col items-center justify-center bg-sds-green px-3 py-5 text-center sm:w-32">
                                <span class="text-xs font-bold uppercase tracking-wider">{{ ucfirst($ponencia->fecha_hora->translatedFormat('l')) }}</span>
                                <span class="mt-1 text-2xl font-black leading-none">{{ $ponencia->fecha_hora->format('g:i') }}</span>
                                <span class="text-xs font-bold uppercase">{{ $ponencia->fecha_hora->format('a') === 'am' ? 'a. m.' : 'p. m.' }}</span>
                            </div>
                            <div class="flex-1 p-5">
                                <h3 class="text-lg font-extrabold italic uppercase">{{ $ponencia->nombre }}</h3>
                                @if ($ponencia->descripcion)
                                    <p class="mt-1 text-sm text-sds-ink/70">{{ $ponencia->descripcion }}</p>
                                @endif
                                <p class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold uppercase text-sds-ink/50">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                                    {{ $ponencia->lugar }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{--  Más actividades  --}}
    <section id="actividades" class="relative scroll-mt-20 overflow-hidden bg-sds-mint py-16 sm:py-20">
        <span class="sds-stripes bottom-0 left-0 -rotate-90"></span>

        <div class="relative mx-auto max-w-6xl px-5">
            <h2 class="text-3xl font-extrabold uppercase sm:text-4xl">Más actividades</h2>
            <p class="mt-2 text-sds-ink/60">Talleres, convivios, competencias y todo lo demás que hace especial la semana.</p>

            @if ($actividadesPorDia->isEmpty())
                <p class="mt-10 text-sds-ink/60">El resto del programa se anunciará pronto.</p>
            @else
                <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
                    @foreach ($actividadesPorDia as $actividadesDelDia)
                        <div class="flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm">
                            <p class="bg-sds-ink px-4 py-3 text-center text-sm font-extrabold uppercase italic tracking-wide text-white">
                                {{ ucfirst($actividadesDelDia->first()->fecha_hora->translatedFormat('l')) }}
                            </p>

                            <ul class="flex-1 divide-y divide-black/5">
                                @foreach ($actividadesDelDia as $actividad)
                                    <li class="p-4">
                                        <p class="text-sm font-black text-sds-green-dark">
                                            {{ $actividad->fecha_hora->format('g:i') }}
                                            {{ $actividad->fecha_hora->format('a') === 'am' ? 'a. m.' : 'p. m.' }}
                                        </p>
                                        <h3 class="mt-1 font-extrabold uppercase leading-tight">{{ $actividad->nombre }}</h3>
                                        @if ($actividad->descripcion)
                                            <p class="mt-1 text-sm text-sds-ink/65">{{ $actividad->descripcion }}</p>
                                        @endif
                                        <p class="mt-2 inline-flex items-center gap-1.5 text-xs font-semibold uppercase text-sds-ink/45">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-3.5 shrink-0"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                                            {{ $actividad->lugar }}
                                        </p>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{--  Pie de página  --}}
    <footer class="border-t border-black/5 bg-white">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-5 py-8 text-center sm:flex-row sm:text-left">
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS" class="h-7 w-auto">
                <span class="h-7 w-px bg-sds-ink/80"></span>
                <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26" class="h-9 w-auto">
            </div>
            <p class="text-sm text-sds-ink/55">
                Asociación de Estudiantes de Ingeniería de Sistemas · Universidad de El Salvador, FMO
            </p>
        </div>
    </footer>
</body>
</html>
