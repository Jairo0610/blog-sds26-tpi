@extends('layouts.auth')

@section('title', 'Panel de control')

@section('content')
@php
    $btn = 'inline-flex items-center justify-center gap-[7px] rounded-[11px] px-4 py-[9px] font-[inherit] text-[13px] font-semibold no-underline cursor-pointer transition';
    $btnGhost = $btn . ' border border-[#cfd7cb] bg-white text-sds-ink hover:border-sds-green hover:bg-[#f4faea] hover:text-[#4f7918]';
    $btnPrimary = $btn . ' border-0 bg-linear-to-br from-sds-green to-sds-green-dark font-bold text-white shadow-[0_3px_10px_rgba(111,165,43,.28)] hover:-translate-y-px hover:shadow-[0_5px_14px_rgba(111,165,43,.38)]';
    $btnDark = $btn . ' border border-sds-ink bg-transparent text-sds-ink hover:bg-sds-ink hover:text-white';

    $statCard = 'flex flex-col justify-between rounded-2xl border border-[#e3e8e0] bg-white px-5 py-[18px] shadow-[0_2px_10px_rgba(17,22,19,.03)]';
    $statLabel = 'text-[11.5px] font-bold tracking-[.04em] text-[#78827b] uppercase';
    $statValue = 'mt-2.5 mb-0 text-[28px] leading-[1.1] font-extrabold tabular-nums';

    $th = 'whitespace-nowrap border-b border-[#e3e8e0] bg-[#f8faf6] px-[18px] py-3 text-[11px] font-bold tracking-[.05em] text-[#78827b] uppercase';
    $td = 'border-b border-[#f0f3ed] px-[18px] py-3.5 align-middle text-[#4a544d]';

    $actBtn = 'inline-flex items-center justify-center rounded-lg px-3 py-1.5 font-[inherit] text-xs font-semibold no-underline cursor-pointer transition';
    $iconBtn = 'inline-flex size-8 items-center justify-center rounded-lg border bg-white p-0 font-[inherit] no-underline cursor-pointer transition';
    $iconSvg = 'width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"';
@endphp

<div class="min-h-screen bg-[#f4f7f1] bg-[radial-gradient(900px_380px_at_100%_-10%,rgba(140,198,63,.16),transparent_60%),radial-gradient(700px_320px_at_-10%_0%,rgba(140,198,63,.08),transparent_60%)] font-['Poppins',ui-sans-serif,system-ui,sans-serif] text-sds-ink antialiased">
    <header class="sticky top-0 z-30 border-b border-[#e3e8e0] bg-white/90 backdrop-blur-md backdrop-saturate-150">
        <div class="mx-auto flex max-w-[1200px] flex-wrap items-center justify-between gap-4 px-4 py-3 sm:px-6">
            <div class="inline-flex items-center gap-[14px]">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-[14px] no-underline">
                    <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS - Universidad de El Salvador" class="block h-6 w-auto max-w-none sm:h-[30px]">
                    <span class="h-7 w-px bg-[#cfd7cb]"></span>
                    <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="block h-[30px] w-auto max-w-none sm:h-[38px]">
                </a>
                <span class="hidden rounded-full border border-[#e8f4d4] bg-[#f4faea] px-2.5 py-1 text-xs font-semibold text-[#4a544d] sm:inline">Panel administrativo</span>
            </div>

            <div class="flex flex-wrap items-center gap-2.5">
                <a href="{{ route('home') }}" class="{{ $btnGhost }}">Ver blog</a>
                <a href="{{ route('admin.categorias.index') }}" class="{{ $btnGhost }}">Categorías</a>
                <a href="{{ route('admin.posts.create') }}" class="{{ $btnPrimary }}">+ Nueva publicación</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="{{ $btnDark }}">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-[1200px] px-4 pt-7 pb-14 sm:px-6">
        @if (session('success'))
            <div class="mb-5 rounded-[14px] border border-l-4 border-[#b5dc7a] border-l-sds-green-dark bg-[#f4faea] px-[18px] py-3.5 text-[13.5px] font-semibold text-[#4f7918]" role="status">
                {{ session('success') }}
            </div>
        @endif

        <section class="relative mb-6 flex flex-wrap items-center justify-between gap-4 overflow-hidden rounded-[20px] border border-[#e3e8e0] bg-linear-to-br from-white from-0% to-[#f3faea] to-100% px-5 py-[18px] shadow-[0_4px_20px_rgba(17,22,19,.035)] sm:px-7 sm:py-6">
            <div>
                <span class="mb-2 inline-flex items-center gap-1.5 rounded-full bg-[#e8f4d4] px-[11px] py-1 text-[11px] font-bold tracking-[.06em] text-[#4f7918] uppercase before:size-1.5 before:rounded-full before:bg-sds-green before:content-['']">Administración</span>
                <h1 class="m-0 text-[22px] leading-[1.15] font-extrabold tracking-[-.01em] sm:text-[26px]">Panel de control</h1>
                <p class="mt-1.5 mb-0 text-[13.5px] text-[#4a544d]">Sesión iniciada como <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->carnet }}).</p>
            </div>
        </section>

        <section class="mb-[26px] grid grid-cols-1 gap-4 min-[520px]:grid-cols-2 min-[900px]:grid-cols-4" aria-label="Resumen de publicaciones">
            <div class="{{ $statCard }}">
                <div class="flex items-center justify-between gap-2">
                    <span class="{{ $statLabel }}">Total publicaciones</span>
                    <span class="size-[9px] rounded-full bg-[#cfd7cb]"></span>
                </div>
                <p class="{{ $statValue }} text-sds-ink">{{ $totalPosts ?? 0 }}</p>
            </div>

            <div class="{{ $statCard }}">
                <div class="flex items-center justify-between gap-2">
                    <span class="{{ $statLabel }}">Publicadas</span>
                    <span class="size-[9px] rounded-full bg-sds-green"></span>
                </div>
                <p class="{{ $statValue }} text-sds-green-dark">{{ $publicadasCount ?? 0 }}</p>
            </div>

            <div class="{{ $statCard }}">
                <div class="flex items-center justify-between gap-2">
                    <span class="{{ $statLabel }}">Borradores</span>
                    <span class="size-[9px] rounded-full bg-[#e8a317]"></span>
                </div>
                <p class="{{ $statValue }} text-[#92400e]">{{ $borradoresCount ?? 0 }}</p>
            </div>

            <div class="{{ $statCard }}">
                <div class="flex items-center justify-between gap-2">
                    <span class="{{ $statLabel }}">Categorías / Actividades</span>
                    <span class="size-[9px] rounded-full bg-sds-green"></span>
                </div>
                <p class="{{ $statValue }} text-sds-ink">{{ $categoriasCount ?? 0 }} / {{ $actividadesCount ?? 0 }}</p>
            </div>
        </section>

        <section class="overflow-hidden rounded-[18px] border border-[#e3e8e0] bg-white shadow-[0_4px_20px_rgba(17,22,19,.04)]">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-[#e3e8e0] px-6 py-[18px]">
                <h2 class="m-0 text-[16.5px] font-extrabold text-sds-ink">Publicaciones registradas</h2>
                <a href="{{ route('admin.posts.create') }}" class="text-[13px] font-bold text-[#4f7918] no-underline hover:underline">+ Subir nueva entrada</a>
            </div>

            <div class="w-full overflow-x-auto">
                <table class="w-full border-collapse text-left text-[13.5px]">
                    <thead>
                        <tr>
                            <th class="{{ $th }}">Publicación</th>
                            <th class="{{ $th }}">Categoría</th>
                            <th class="{{ $th }}">Fecha actividad</th>
                            <th class="{{ $th }}">Autores</th>
                            <th class="{{ $th }}">Evidencias</th>
                            <th class="{{ $th }}">Estado</th>
                            <th class="{{ $th }} text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="[&>tr:last-child>td]:border-b-0">
                        @forelse ($posts ?? [] as $post)
                            <tr class="hover:bg-[#fafcf8]">
                                <td class="{{ $td }}">
                                    <div class="flex min-w-60 items-center gap-3.5">
                                        @if ($post->imagen_principal)
                                            <img src="{{ asset('storage/' . $post->imagen_principal) }}" alt="{{ $post->titulo }}" class="block h-12 w-[72px] shrink-0 rounded-[10px] border border-[#e3e8e0] bg-[#f4faea] object-cover">
                                        @else
                                            <span class="inline-flex h-12 w-[72px] shrink-0 items-center justify-center rounded-[10px] border border-dashed border-[#cfd7cb] bg-[#f4faea] text-[10px] font-bold text-[#4f7918] uppercase">SDS26</span>
                                        @endif

                                        <div class="min-w-0">
                                            @if ($post->estado === \App\Models\PostModel::ESTADO_PUBLICADO)
                                                <a href="{{ route('posts.show', $post->slug) }}" class="block text-sm leading-[1.35] font-bold text-sds-ink no-underline hover:text-[#4f7918]">{{ $post->titulo }}</a>
                                            @else
                                                <span class="block text-sm leading-[1.35] font-bold text-sds-ink">{{ $post->titulo }}</span>
                                            @endif
                                            @if ($post->resumen)
                                                <span class="mt-0.5 block max-w-80 truncate text-[11.5px] text-[#78827b]">{{ $post->resumen }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="{{ $td }}">
                                    <span class="inline-block rounded-lg border border-[#e4e9e0] bg-[#f3f6f1] px-2.5 py-1 text-xs font-semibold whitespace-nowrap text-[#4a544d]">{{ $post->categoria->nombre ?? '—' }}</span>
                                </td>
                                <td class="{{ $td }} text-[13px] whitespace-nowrap tabular-nums">
                                    {{ optional($post->fecha_actividad)->format('d/m/Y') ?? '—' }}
                                </td>
                                <td class="{{ $td }} max-w-60 min-w-[170px] text-[12.5px] leading-[1.4] font-medium text-sds-ink">
                                    @if ($post->autores && $post->autores->isNotEmpty())
                                        {{ $post->autores->pluck('name')->join(', ') }}
                                    @else
                                        {{ $post->usuario->name ?? '—' }}
                                    @endif
                                </td>
                                <td class="{{ $td }}">
                                    @php
                                        $totalIntegrantes = $post->integrantes()->count();
                                        $faltantes = $post->integrantesSinEvidencia();
                                        $cubiertos = $totalIntegrantes - $faltantes->count();
                                    @endphp
                                    @if ($faltantes->isEmpty())
                                        <span title="Todos los integrantes tienen evidencia" class="inline-block rounded-full bg-[#e8f4d4] px-[11px] py-1 text-[11.5px] font-bold whitespace-nowrap text-[#4f7918]">✓ {{ $cubiertos }}/{{ $totalIntegrantes }}</span>
                                    @else
                                        <span title="Falta evidencia de: {{ $faltantes->pluck('name')->join(', ') }}" class="inline-block rounded-full {{ $cubiertos === 0 ? 'bg-[#fff5f5] text-[#c92a2a]' : 'bg-[#fef3c7] text-[#92400e]' }} px-[11px] py-1 text-[11.5px] font-bold whitespace-nowrap">{{ $cubiertos === 0 ? '✗' : '!' }} {{ $cubiertos }}/{{ $totalIntegrantes }}</span>
                                    @endif
                                </td>
                                <td class="{{ $td }}">
                                    @if ($post->estado === \App\Models\PostModel::ESTADO_PUBLICADO)
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#e8f4d4] px-[11px] py-1 text-[11.5px] font-bold whitespace-nowrap text-[#4f7918] before:size-1.5 before:rounded-full before:bg-sds-green-dark before:content-['']">Publicado</span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-[#fef3c7] px-[11px] py-1 text-[11.5px] font-bold whitespace-nowrap text-[#92400e] before:size-1.5 before:rounded-full before:bg-[#d97706] before:content-['']">Borrador</span>
                                    @endif
                                </td>
                                <td class="{{ $td }} text-right">
                                    <div class="inline-flex items-center justify-end gap-1.5 whitespace-nowrap">
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="{{ $actBtn }} border border-[#cfd7cb] bg-white text-sds-ink hover:border-sds-green hover:bg-[#f4faea] hover:text-[#4f7918]">Editar</a>

                                        @if ($post->estado === \App\Models\PostModel::ESTADO_PUBLICADO)
                                            <a href="{{ route('posts.show', $post->slug) }}" title="Ver publicación" aria-label="Ver publicación" class="{{ $iconBtn }} border-[#e8f4d4] text-[#4f7918] hover:border-sds-green hover:bg-[#f4faea]">
                                                <svg {!! $iconSvg !!}><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                            </a>
                                        @endif

                                        <a href="{{ route('admin.posts.edit', $post) }}#galeria" title="Gestionar imágenes" aria-label="Gestionar imágenes" class="{{ $iconBtn }} border-[#cfd7cb] text-sds-ink hover:border-sds-green hover:bg-[#f4faea] hover:text-[#4f7918]">
                                            <svg {!! $iconSvg !!}><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.1-3.1a2 2 0 0 0-2.8 0L6 21"/></svg>
                                        </a>

                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('¿Eliminar esta publicación?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Eliminar publicación" aria-label="Eliminar publicación" class="{{ $iconBtn }} border-[#ffc9c9] bg-[#fff5f5] text-[#c92a2a] hover:border-[#ffa8a8] hover:bg-[#ffe3e3]">
                                                <svg {!! $iconSvg !!}><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="{{ $td }} px-6 py-10 text-center text-[#78827b]">
                                    Aún no hay publicaciones registradas. Haz clic en <strong>+ Nueva publicación</strong> para subir la primera.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
@endsection
