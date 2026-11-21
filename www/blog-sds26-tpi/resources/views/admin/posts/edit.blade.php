@extends('layouts.auth')

@section('title', 'Editar publicación')

@section('content')
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
            <span>Publicaciones</span>
            <span>/</span>
            <span class="font-semibold text-sds-ink">Editar</span>
        </nav>

        <div class="relative mb-6 overflow-hidden rounded-[20px] border border-[#e3e8e0] bg-linear-to-br from-white from-0% to-[#f3faea] to-100% p-[18px] shadow-[0_4px_24px_rgba(17,22,19,.04)] sm:px-[26px] sm:py-[22px]">
            <span class="mb-2 inline-flex items-center gap-1.5 rounded-full bg-[#e8f4d4] px-3 py-[5px] text-[11px] font-bold tracking-[.06em] text-[#4f7918] uppercase before:size-1.5 before:rounded-full before:bg-sds-green before:content-['']">Semana de Sistemas 2026 · Gestión de entradas</span>
            <h1 class="m-0 text-[22px] leading-[1.15] font-extrabold tracking-[-.01em] sm:text-[26px]">Editar publicación</h1>
            <p class="mt-1.5 mb-0 text-[13.5px] text-[#4a544d]">Actualiza la información, la portada o el estado de esta entrada.</p>
        </div>

        <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.posts._form', ['post' => $post, 'submitLabel' => 'Actualizar publicación'])
        </form>
    </main>
</div>
@endsection
