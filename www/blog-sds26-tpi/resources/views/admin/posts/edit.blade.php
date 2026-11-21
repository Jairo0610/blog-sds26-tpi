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

        @if (session('success'))
            <div class="sticky top-3 z-30 mb-5 rounded-[14px] border border-l-4 border-[#b5dc7a] border-l-sds-green-dark bg-[#f4faea] px-[18px] py-3.5 text-[13.5px] font-semibold text-[#4f7918]" role="status">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.posts._form', ['post' => $post, 'submitLabel' => 'Actualizar publicación'])
        </form>

        @php
            $card = 'rounded-2xl border border-[#e3e8e0] bg-white p-[18px] shadow-[0_2px_12px_rgba(17,22,19,.035)] sm:p-[22px]';
            $input = 'w-full rounded-xl border-[1.5px] border-[#cfd7cb] bg-white px-3 py-2 font-[inherit] text-[13px] leading-normal text-sds-ink transition placeholder:text-[#78827b]/70 focus:border-sds-green focus:ring-4 focus:ring-sds-green/20 focus:outline-none';
            $actBtn = 'inline-flex items-center justify-center rounded-lg px-3 py-1.5 font-[inherit] text-xs font-semibold no-underline cursor-pointer transition';
            $erroresGaleria = $errors->getBag('galeria');
        @endphp

        <section id="galeria" class="{{ $card }} mt-6">
            <div class="mb-[18px] flex items-center gap-3 border-b border-[#eff2ec] pb-3.5">
                <span class="inline-flex size-7 shrink-0 items-center justify-center rounded-[9px] bg-linear-to-br from-sds-green to-sds-green-dark text-[12.5px] font-extrabold text-white">5</span>
                <div>
                    <h2 class="m-0 text-[15px] font-bold">Galería de imágenes y evidencias</h2>
                    <p class="mt-0.5 mb-0 text-xs font-normal text-[#78827b]">Aparecen en el detalle de la publicación · JPG, JPEG, PNG o WEBP · Máx. 4 MB c/u · hasta 10 por carga.</p>
                </div>
            </div>

            @if ($erroresGaleria->any())
                <div class="mb-5 rounded-[14px] border border-l-4 border-[#ffc9c9] border-l-[#c92a2a] bg-[#fff5f5] px-[18px] py-[15px] text-[13px] text-[#9b1c1c]" role="alert">
                    <strong>No se pudo guardar la galería:</strong>
                    <ul class="mt-2 mb-0 list-disc pl-[18px]">
                        @foreach ($erroresGaleria->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.posts.imagenes.store', $post) }}" data-keep-scroll enctype="multipart/form-data" class="mb-6 grid grid-cols-1 items-end gap-3 min-[800px]:grid-cols-[1fr_1fr_auto]">
                @csrf
                <div>
                    <label for="galeria-imagenes" class="mb-[7px] block text-[13px] font-semibold">Imágenes <span class="font-bold text-[#c92a2a]">*</span></label>
                    <input type="file" id="galeria-imagenes" name="imagenes[]" multiple required accept="image/jpeg,image/png,image/webp" class="{{ $input }} file:mr-3 file:cursor-pointer file:rounded-lg file:border-0 file:bg-[#e8f4d4] file:px-3 file:py-1.5 file:text-xs file:font-semibold file:text-[#4f7918]">
                </div>
                <div>
                    <label for="galeria-descripcion" class="mb-[7px] block text-[13px] font-semibold">Descripción <span class="text-xs font-normal text-[#78827b]">(opcional, se aplica a todas)</span></label>
                    <input type="text" id="galeria-descripcion" name="descripcion" maxlength="200" placeholder="Ej. Asistencia de ambos integrantes al taller" class="{{ $input }}">
                </div>
                <button type="submit" class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-xl border-0 bg-linear-to-br from-sds-green to-sds-green-dark px-5 py-[10px] font-[inherit] text-[13px] font-bold text-white shadow-[0_4px_12px_rgba(111,165,43,.3)] transition">Subir imágenes</button>
            </form>

            @if ($post->imagenes->isEmpty())
                <p class="m-0 rounded-xl border border-dashed border-[#cfd7cb] bg-[#f8fbf5] px-4 py-8 text-center text-[13px] text-[#78827b]">Esta publicación aún no tiene imágenes en la galería.</p>
            @else
                <div class="grid grid-cols-1 gap-4 min-[560px]:grid-cols-2 min-[960px]:grid-cols-3">
                    @foreach ($post->imagenes as $imagen)
                        <article class="overflow-hidden rounded-[14px] border border-[#e3e8e0] bg-[#fafbf9]">
                            <img src="{{ asset('storage/' . $imagen->ruta) }}" alt="{{ $imagen->descripcion ?? $post->titulo }}" loading="lazy" class="block aspect-[16/10] w-full object-cover">
                            <div class="p-3">
                                <form method="POST" action="{{ route('admin.posts.imagenes.update', [$post, $imagen]) }}" data-keep-scroll class="flex flex-col gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="descripcion" value="{{ $imagen->descripcion }}" maxlength="200" placeholder="Descripción" aria-label="Descripción de la imagen" class="{{ $input }}">
                                    <button type="submit" class="{{ $actBtn }} self-end border border-[#cfd7cb] bg-white text-sds-ink hover:border-sds-green hover:bg-[#f4faea] hover:text-[#4f7918]">Guardar descripción</button>
                                </form>
                                <form method="POST" action="{{ route('admin.posts.imagenes.destroy', [$post, $imagen]) }}" data-keep-scroll onsubmit="return confirm('¿Eliminar esta imagen de la galería?');" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="{{ $actBtn }} w-full border border-[#ffc9c9] bg-[#fff5f5] text-[#c92a2a] hover:border-[#ffa8a8] hover:bg-[#ffe3e3]">Eliminar imagen</button>
                                </form>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </main>
</div>
@endsection
