<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->titulo }} · Blog SDS26</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
@php
    $mesesEs = [
        1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
        5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
        9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre',
    ];
    $fechaFormateada = null;
    if ($post->fecha_actividad) {
        $mesNombre = $mesesEs[(int) $post->fecha_actividad->format('n')] ?? '';
        $fechaFormateada = $post->fecha_actividad->format('j') . ' de ' . $mesNombre . ' de ' . $post->fecha_actividad->format('Y');
    }

    $btnOutline = 'inline-flex items-center gap-[7px] rounded-full border border-[#cfd7cb] bg-white px-[15px] py-2 text-[13px] font-semibold text-sds-ink no-underline transition hover:border-sds-green hover:bg-[#f4faea] hover:text-[#4f7918]';
@endphp
<div class="min-h-screen bg-[#f6f8f4] bg-[radial-gradient(900px_360px_at_100%_-10%,rgba(140,198,63,.14),transparent_60%),radial-gradient(700px_300px_at_-10%_0%,rgba(140,198,63,.07),transparent_60%)] font-['Poppins',ui-sans-serif,system-ui,sans-serif] text-sds-ink antialiased">
    <header class="sticky top-0 z-30 border-b border-[#e3e8e0] bg-white/90 backdrop-blur-md backdrop-saturate-150">
        <div class="mx-auto flex max-w-[1120px] items-center justify-between gap-4 px-4 py-3 sm:px-6">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-[14px] no-underline">
                <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS - Universidad de El Salvador" class="block h-6 w-auto max-w-none sm:h-[30px]">
                <span class="h-7 w-px bg-[#cfd7cb]"></span>
                <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="block h-[30px] w-auto max-w-none sm:h-[38px]">
            </a>
            <div class="flex items-center gap-2.5">
                @auth
                    <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center gap-1.5 rounded-full bg-linear-to-br from-sds-green to-sds-green-dark px-3.5 py-[7px] text-[12.5px] font-bold text-white no-underline shadow-[0_3px_10px_rgba(111,165,43,.25)]">
                        <span>+ Nueva publicación</span>
                    </a>
                    <a href="{{ route('admin.posts.edit', $post) }}" class="{{ $btnOutline }}">Editar entrada</a>
                @endauth
                <a href="{{ route('home') }}" class="{{ $btnOutline }}">Volver al blog</a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-[880px] px-4 pt-6 pb-16 sm:px-6">
        <nav class="mb-4 flex flex-wrap items-center gap-2 text-[12.5px] text-[#78827b]" aria-label="Migas de pan">
            <a href="{{ route('home') }}" class="font-medium text-[#4a544d] no-underline hover:text-[#4f7918] hover:underline">Inicio</a>
            <span>/</span>
            @if ($post->categoria)
                <a href="{{ route('home', ['categoria' => $post->categoria->slug]) . '#publicaciones' }}" class="font-medium text-[#4a544d] no-underline hover:text-[#4f7918] hover:underline">{{ $post->categoria->nombre }}</a>
                <span>/</span>
            @endif
            <span class="font-semibold text-sds-ink">{{ \Illuminate\Support\Str::limit($post->titulo, 48) }}</span>
        </nav>

        <article class="overflow-hidden rounded-[22px] border border-[#e3e8e0] bg-white shadow-[0_6px_28px_rgba(17,22,19,.045)]">
            <header class="border-b border-[#e3e8e0] bg-linear-to-br from-white from-0% to-[#f5fbed] to-100% px-[18px] pt-[22px] pb-[18px] sm:px-[34px] sm:pt-7 sm:pb-[22px]">
                <div class="mb-3 flex flex-wrap items-center gap-2.5">
                    @if ($post->categoria)
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#e8f4d4] px-3 py-1 text-[11px] font-bold tracking-[.05em] text-[#4f7918] uppercase">{{ $post->categoria->nombre }}</span>
                    @endif
                    @if ($fechaFormateada)
                        <span class="text-[12.5px] font-medium text-[#78827b]">Actividad del {{ $fechaFormateada }}</span>
                    @endif
                </div>

                <h1 class="m-0 text-2xl leading-[1.2] font-extrabold tracking-[-.015em] text-sds-ink sm:text-[30px]">{{ $post->titulo }}</h1>

                @if ($post->resumen)
                    <p class="mt-3 mb-0 text-[15px] leading-[1.6] font-normal text-[#4a544d]">{{ $post->resumen }}</p>
                @endif

                <div class="mt-[18px] flex flex-wrap items-center justify-between gap-3 border-t border-[#e6ece1] pt-4">
                    <div class="flex flex-wrap items-center gap-2">
                        @php($listaAutores = $post->autores->isNotEmpty() ? $post->autores : collect([$post->usuario])->filter())
                        @foreach ($listaAutores as $autor)
                            <span class="inline-flex items-center gap-2 rounded-full border border-[#e3e8e0] bg-white py-1 pr-3 pl-1.5 text-[12.5px] font-semibold text-sds-ink">
                                <span class="inline-flex size-6 items-center justify-center rounded-full bg-linear-to-br from-sds-green to-sds-green-dark text-[11px] font-extrabold text-white">{{ mb_strtoupper(mb_substr($autor->name, 0, 1)) }}</span>
                                <span>{{ $autor->name }}</span>
                            </span>
                        @endforeach
                    </div>

                    @if ($post->actividad)
                        <span class="rounded-[10px] border border-[#e3e8e0] bg-white px-3 py-[5px] text-xs font-semibold text-[#4f7918]">
                            Itinerario: {{ $post->actividad->nombre }}
                        </span>
                    @endif
                </div>
            </header>

            @if ($post->imagen_principal)
                <div class="px-[18px] pt-[18px] sm:px-[34px] sm:pt-6">
                    <div class="flex max-h-[220px] items-center justify-center overflow-hidden rounded-2xl border border-[#e3e8e0] bg-[#f3f6f1] sm:max-h-[310px]">
                        <img src="{{ asset('storage/' . $post->imagen_principal) }}" alt="{{ $post->titulo }}" class="block max-h-[220px] w-full object-cover sm:max-h-[310px]">
                    </div>
                </div>
            @endif

            <div class="px-[18px] pt-7 pb-8 text-[15.5px] leading-[1.78] text-[#1f2622] sm:px-[34px]">
                @foreach (preg_split("/\r\n|\n|\r/", trim($post->contenido)) as $parrafo)
                    @if (filled($parrafo))
                        <p class="mt-0 mb-4 last:mb-0">{{ $parrafo }}</p>
                    @endif
                @endforeach
            </div>

            @if ($post->imagenes->isNotEmpty())
                <section class="px-[18px] pb-8 sm:px-[34px]">
                    <h2 class="mt-0 mb-3.5 text-[13px] font-bold tracking-[.05em] text-[#4a544d] uppercase">Galería de la actividad</h2>
                    <div class="grid grid-cols-[repeat(auto-fill,minmax(210px,1fr))] gap-3.5">
                        @foreach ($post->imagenes as $img)
                            <figure class="m-0 overflow-hidden rounded-[14px] border border-[#e3e8e0] bg-[#fafbf9]">
                                <img src="{{ asset('storage/' . $img->ruta) }}" alt="{{ $img->descripcion ?? $post->titulo }}" loading="lazy" class="block aspect-[16/10] w-full object-cover">
                                @if ($img->descripcion)
                                    <figcaption class="px-3 py-2 text-xs text-[#4a544d]">{{ $img->descripcion }}</figcaption>
                                @endif
                            </figure>
                        @endforeach
                    </div>
                </section>
            @endif

            <div class="mx-[18px] flex flex-wrap items-center justify-between gap-3 border-t border-[#eff2ec] pt-[18px] pb-7 text-[12.5px] text-[#78827b] sm:mx-[34px]">
                <span>Semana de Sistemas 2026 · Green IoT</span>
                <a href="{{ route('home') }}" class="{{ $btnOutline }}">Ver todas las publicaciones</a>
            </div>
        </article>

        @if ($relacionadas->isNotEmpty())
            <section class="mt-[34px]">
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h2 class="m-0 text-lg font-extrabold text-sds-ink">Más publicaciones de la semana</h2>
                    <a href="{{ route('home') }}" class="{{ $btnOutline }}">Ver todas</a>
                </div>
                <div class="grid grid-cols-3 gap-4 max-[780px]:grid-cols-2 max-[540px]:grid-cols-1">
                    @foreach ($relacionadas as $item)
                        <a href="{{ route('posts.show', $item->slug) }}" class="flex flex-col overflow-hidden rounded-2xl border border-[#e3e8e0] bg-white text-inherit no-underline transition hover:-translate-y-0.5 hover:border-sds-green hover:shadow-[0_8px_20px_rgba(17,22,19,.06)]">
                            <div class="flex aspect-[16/10] w-full items-center justify-center overflow-hidden bg-[#f4faea]">
                                @if ($item->imagen_principal)
                                    <img src="{{ asset('storage/' . $item->imagen_principal) }}" alt="{{ $item->titulo }}" loading="lazy" class="block size-full object-cover">
                                @else
                                    <span class="text-[11px] font-bold tracking-[.06em] text-[#4f7918]">SDS26 GREEN IOT</span>
                                @endif
                            </div>
                            <div class="flex flex-1 flex-col px-[15px] py-[13px]">
                                @if ($item->categoria)
                                    <span class="text-[10.5px] font-bold tracking-[.04em] text-[#4f7918] uppercase">{{ $item->categoria->nombre }}</span>
                                @endif
                                <h3 class="mt-[5px] mb-0 line-clamp-2 text-sm leading-[1.35] font-bold">{{ $item->titulo }}</h3>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </main>
</div>
</body>
</html>