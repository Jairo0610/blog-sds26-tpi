@extends('layouts.auth')

@section('title', 'Categorías')

@section('content')
@php
    $btn = 'inline-flex items-center justify-center gap-[7px] rounded-[11px] px-4 py-[9px] font-[inherit] text-[13px] font-semibold no-underline cursor-pointer transition';
    $btnGhost = $btn . ' border border-[#cfd7cb] bg-white text-sds-ink hover:border-sds-green hover:bg-[#f4faea] hover:text-[#4f7918]';
    $btnPrimary = $btn . ' border-0 bg-linear-to-br from-sds-green to-sds-green-dark font-bold text-white shadow-[0_3px_10px_rgba(111,165,43,.28)] hover:-translate-y-px hover:shadow-[0_5px_14px_rgba(111,165,43,.38)]';

    $th = 'whitespace-nowrap border-b border-[#e3e8e0] bg-[#f8faf6] px-[18px] py-3 text-[11px] font-bold tracking-[.05em] text-[#78827b] uppercase';
    $td = 'border-b border-[#f0f3ed] px-[18px] py-3.5 align-middle text-[#4a544d]';
    $actBtn = 'inline-flex items-center justify-center rounded-lg px-3 py-1.5 font-[inherit] text-xs font-semibold no-underline cursor-pointer transition';
@endphp

<div class="min-h-screen bg-[#f4f7f1] bg-[radial-gradient(900px_380px_at_100%_-10%,rgba(140,198,63,.16),transparent_60%),radial-gradient(700px_320px_at_-10%_0%,rgba(140,198,63,.08),transparent_60%)] font-['Poppins',ui-sans-serif,system-ui,sans-serif] text-sds-ink antialiased">
    <header class="border-b border-[#e3e8e0] bg-white">
        <div class="mx-auto flex max-w-[1200px] items-center justify-between gap-4 px-4 py-3 sm:px-6">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-[14px] no-underline">
                <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS - Universidad de El Salvador" class="block h-6 w-auto max-w-none sm:h-[30px]">
                <span class="h-7 w-px bg-[#cfd7cb]"></span>
                <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="block h-[30px] w-auto max-w-none sm:h-[38px]">
            </a>
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-full border border-[#cfd7cb] bg-white px-3.5 py-2 text-[13px] font-semibold text-sds-ink no-underline transition hover:border-sds-green hover:bg-[#f4faea] hover:text-[#4f7918]"><span class="hidden sm:inline">Volver al panel</span></a>
        </div>
    </header>

    <main class="mx-auto max-w-[1200px] px-4 pt-6 pb-14 sm:px-6">
        <nav class="mb-3.5 flex items-center gap-2 text-[12.5px] text-[#78827b]" aria-label="Migas de pan">
            <a href="{{ route('admin.dashboard') }}" class="font-medium text-[#4a544d] no-underline hover:text-[#4f7918] hover:underline">Panel</a>
            <span>/</span>
            <span class="font-semibold text-sds-ink">Categorías</span>
        </nav>

        @if (session('success'))
            <div class="sticky top-3 z-30 mb-5 rounded-[14px] border border-l-4 border-[#b5dc7a] border-l-sds-green-dark bg-[#f4faea] px-[18px] py-3.5 text-[13.5px] font-semibold text-[#4f7918]" role="status">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="sticky top-3 z-30 mb-5 rounded-[14px] border border-l-4 border-[#ffc9c9] border-l-[#c92a2a] bg-[#fff5f5] px-[18px] py-3.5 text-[13.5px] font-semibold text-[#9b1c1c]" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="relative mb-6 flex flex-wrap items-center justify-between gap-4 overflow-hidden rounded-[20px] border border-[#e3e8e0] bg-linear-to-br from-white from-0% to-[#f3faea] to-100% p-[18px] shadow-[0_4px_24px_rgba(17,22,19,.04)] sm:px-[26px] sm:py-[22px]">
            <div>
                <span class="mb-2 inline-flex items-center gap-1.5 rounded-full bg-[#e8f4d4] px-3 py-[5px] text-[11px] font-bold tracking-[.06em] text-[#4f7918] uppercase before:size-1.5 before:rounded-full before:bg-sds-green before:content-['']">Gestión de categorías</span>
                <h1 class="m-0 text-[22px] leading-[1.15] font-extrabold tracking-[-.01em] sm:text-[26px]">Categorías</h1>
                <p class="mt-1.5 mb-0 text-[13.5px] text-[#4a544d]">Agrupan las publicaciones y alimentan el filtro del blog público.</p>
            </div>
            <a href="{{ route('admin.categorias.create') }}" class="{{ $btnPrimary }}">+ Nueva categoría</a>
        </div>

        <section class="overflow-hidden rounded-[18px] border border-[#e3e8e0] bg-white shadow-[0_4px_20px_rgba(17,22,19,.04)]">
            <div class="w-full overflow-x-auto">
                <table class="w-full border-collapse text-left text-[13.5px]">
                    <thead>
                        <tr>
                            <th class="{{ $th }}">Nombre</th>
                            <th class="{{ $th }}">Descripción</th>
                            <th class="{{ $th }} text-center">Entradas</th>
                            <th class="{{ $th }} text-center">Actividades</th>
                            <th class="{{ $th }} text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="[&>tr:last-child>td]:border-b-0">
                        @forelse ($categorias as $categoria)
                            <tr class="hover:bg-[#fafcf8]">
                                <td class="{{ $td }}">
                                    <span class="block text-sm font-bold text-sds-ink">{{ $categoria->nombre }}</span>
                                    <span class="block text-[11.5px] text-[#78827b]">{{ $categoria->slug }}</span>
                                </td>
                                <td class="{{ $td }} max-w-80 text-[12.5px] leading-[1.4]">{{ $categoria->descripcion ?: '—' }}</td>
                                <td class="{{ $td }} text-center tabular-nums">{{ $categoria->entradas_count }}</td>
                                <td class="{{ $td }} text-center tabular-nums">{{ $categoria->actividades_count }}</td>
                                <td class="{{ $td }} text-right">
                                    <div class="inline-flex items-center justify-end gap-2 whitespace-nowrap">
                                        <a href="{{ route('admin.categorias.edit', $categoria) }}" class="{{ $actBtn }} border border-[#cfd7cb] bg-white text-sds-ink hover:border-sds-green hover:bg-[#f4faea] hover:text-[#4f7918]">Editar</a>
                                        <form method="POST" action="{{ route('admin.categorias.destroy', $categoria) }}" data-keep-scroll onsubmit="return confirm('¿Eliminar esta categoría?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="{{ $actBtn }} border border-[#ffc9c9] bg-[#fff5f5] text-[#c92a2a] hover:border-[#ffa8a8] hover:bg-[#ffe3e3]">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="{{ $td }} px-6 py-10 text-center text-[#78827b]">
                                    Aún no hay categorías. Haz clic en <strong>+ Nueva categoría</strong> para crear la primera.
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
