@extends('layouts.auth')

@section('title', 'Panel de control')

@section('content')
@csrf

@php
    $input = 'w-full rounded-xl border-[1.5px] border-[#cfd7cb] bg-white px-3.5 py-[11px] font-[inherit] text-sm leading-normal text-sds-ink transition placeholder:text-[#78827b]/70 focus:border-sds-green focus:ring-4 focus:ring-sds-green/20 focus:outline-none';
    $errBorder = 'border-[#c92a2a]!';
    $card = 'rounded-2xl border border-[#e3e8e0] bg-white p-[18px] shadow-[0_2px_12px_rgba(17,22,19,.035)] sm:p-[22px]';
    $cardHead = 'mb-[18px] flex items-center gap-3 border-b border-[#eff2ec] pb-3.5';
    $step = 'inline-flex size-7 shrink-0 items-center justify-center rounded-[9px] bg-linear-to-br from-sds-green to-sds-green-dark text-[12.5px] font-extrabold text-white';
    $label = 'block text-[13px] font-semibold';
    $errText = 'mt-1.5 mb-0 text-xs font-medium text-[#c92a2a]';
    $counter = 'text-[11px] font-semibold tabular-nums text-[#78827b] [&.is-near]:text-[#e8a317] [&.is-full]:text-[#c92a2a]';
@endphp

@if ($errors->any())
    <div class="mb-5 rounded-[14px] border border-l-4 border-[#ffc9c9] border-l-[#c92a2a] bg-[#fff5f5] px-[18px] py-[15px] text-[13px] text-[#9b1c1c]" role="alert">
        <strong>Revisa los campos del formulario antes de continuar:</strong>
        <ul class="mt-2 mb-0 list-disc pl-[18px]">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 items-start gap-[22px] min-[960px]:grid-cols-[minmax(0,1.55fr)_minmax(320px,1fr)]">
    <div class="flex flex-col gap-5">
        <section class="{{ $card }}">
            <div class="{{ $cardHead }}">
                <span class="{{ $step }}">1</span>
                <div>
                    <h2 class="m-0 text-[15px] font-bold">Contenido de la publicación</h2>
                    <p class="mt-0.5 mb-0 text-xs font-normal text-[#78827b]">Lo que verán los visitantes en el sitio.</p>
                </div>
            </div>

            <div class="mb-[18px] last:mb-0">
                <div class="mb-[7px] flex items-center justify-between gap-2">
                    <label for="titulo" class="{{ $label }}">Título <span class="font-bold text-[#c92a2a]">*</span></label>
                    <span id="titulo-counter" class="{{ $counter }}">0 / 200</span>
                </div>
                <input type="text" id="titulo" name="titulo"
                       value="{{ old('titulo', $post->titulo ?? '') }}"
                       maxlength="200" required
                       placeholder="Ej. Ponencia 1: Arquitectura IoT sostenible en campus"
                       class="{{ $input }} px-[15px] py-3 text-base font-semibold @error('titulo') {{ $errBorder }} @enderror">
                @error('titulo') <p class="{{ $errText }}">{{ $message }}</p> @enderror
            </div>

            <div class="mb-[18px] last:mb-0">
                <div class="mb-[7px] flex items-center justify-between gap-2">
                    <label for="resumen" class="{{ $label }}">Resumen breve <span class="text-xs font-normal text-[#78827b]">(opcional)</span></label>
                    <span id="resumen-counter" class="{{ $counter }}">0 / 300</span>
                </div>
                <input type="text" id="resumen" name="resumen"
                       value="{{ old('resumen', $post->resumen ?? '') }}"
                       maxlength="300"
                       placeholder="Síntesis corta de la actividad o aprendizaje clave"
                       class="{{ $input }} @error('resumen') {{ $errBorder }} @enderror">
                @error('resumen') <p class="{{ $errText }}">{{ $message }}</p> @enderror
            </div>

            <div class="mb-[18px] last:mb-0">
                <label for="contenido" class="{{ $label }} mb-[7px]">Contenido <span class="font-bold text-[#c92a2a]">*</span></label>
                <textarea id="contenido" name="contenido" required
                          placeholder="Redacta aquí el desarrollo de la actividad, expositores, temas tratados y conclusiones..."
                          class="{{ $input }} min-h-[200px] resize-y leading-[1.6] @error('contenido') {{ $errBorder }} @enderror">{{ old('contenido', $post->contenido ?? '') }}</textarea>
                <div class="mt-1.5 flex justify-between gap-2 text-[11.5px] text-[#78827b]">
                    <span>Separa los párrafos con una línea en blanco.</span>
                    <span id="contenido-stats">0 palabras</span>
                </div>
                @error('contenido') <p class="{{ $errText }}">{{ $message }}</p> @enderror
            </div>
        </section>

        @php($hasExistingImg = isset($post) && $post->imagen_principal)
        <section class="{{ $card }}">
            <div class="{{ $cardHead }}">
                <span class="{{ $step }}">2</span>
                <div>
                    <h2 class="m-0 text-[15px] font-bold">Imagen principal</h2>
                    <p class="mt-0.5 mb-0 text-xs font-normal text-[#78827b]">JPG, JPEG, PNG o WEBP · Máx. 4 MB (formato horizontal 16:9).</p>
                </div>
            </div>

            <div id="upload-box" class="relative flex min-h-[210px] w-full cursor-pointer items-center justify-center overflow-hidden rounded-[14px] border-2 border-dashed border-[#b9c8b1] bg-[#f8fbf5] transition hover:border-sds-green hover:bg-[#f4faea] [&.is-dragover]:border-sds-green [&.is-dragover]:bg-[#f4faea]" role="button" tabindex="0" aria-label="Seleccionar o arrastrar imagen principal">
                <div id="dropzone-empty" class="flex flex-col items-center justify-center gap-1.5 px-4 py-6 text-center [&.is-hidden]:hidden {{ $hasExistingImg ? 'is-hidden' : '' }}">
                    <span class="inline-flex size-10 items-center justify-center rounded-[11px] bg-[#e8f4d4] text-[#4f7918]" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m17 8-5-5-5 5"/><path d="M12 3v12"/></svg>
                    </span>
                    <span class="text-[13.5px] font-bold text-[#4f7918]">Seleccionar o arrastrar imagen</span>
                    <span class="text-[11.5px] text-[#78827b]">Arrastra una foto aquí o haz clic para explorarla</span>
                </div>

                <div id="dropzone-filled" class="relative flex h-60 w-full items-center justify-center bg-sds-ink [&.is-hidden]:hidden {{ $hasExistingImg ? '' : 'is-hidden' }}">
                    <img id="imagen-preview"
                         src="{{ $hasExistingImg ? asset('storage/' . $post->imagen_principal) : '' }}"
                         alt="Vista previa de la imagen principal"
                         class="block size-full object-cover">
                    <div class="absolute inset-x-0 bottom-0 flex items-center justify-between gap-2.5 bg-sds-ink/80 px-3 py-[9px] text-white backdrop-blur-xs">
                        <span id="imagen-nombre" class="truncate text-[11.5px] font-medium">
                            {{ $hasExistingImg ? $post->imagen_principal : '' }}
                        </span>
                        <div class="flex shrink-0 items-center gap-1.5">
                            <button type="button" id="btn-change-img" class="cursor-pointer rounded-[7px] border border-white/35 bg-white/15 px-[9px] py-1 font-[inherit] text-[11px] font-semibold text-white transition hover:bg-white/30">Cambiar</button>
                            <button type="button" id="btn-clear-img" class="cursor-pointer rounded-[7px] border border-white/35 bg-white/15 px-[9px] py-1 font-[inherit] text-[11px] font-semibold text-white transition hover:border-[#c92a2a] hover:bg-[#c92a2a]">Quitar</button>
                        </div>
                    </div>
                </div>

                <input type="file" id="imagen_principal" name="imagen_principal" accept="image/jpeg,image/png,image/webp" class="hidden">
            </div>

            <p id="imagen-error" class="mt-2 text-xs font-medium text-[#c92a2a] empty:hidden" role="alert"></p>
            @error('imagen_principal') <p class="{{ $errText }}">{{ $message }}</p> @enderror
        </section>
    </div>

    <div class="flex flex-col gap-5">
        <section class="{{ $card }}">
            <div class="{{ $cardHead }}">
                <span class="{{ $step }}">3</span>
                <h2 class="m-0 text-[15px] font-bold">Estado y fecha</h2>
            </div>

            <div class="mb-[18px] last:mb-0">
                <span class="{{ $label }} mb-[7px]">Estado <span class="font-bold text-[#c92a2a]">*</span></span>
                @php($estadoActual = old('estado', $post->estado ?? \App\Models\PostModel::ESTADO_BORRADOR))
                @php($choice = 'relative flex cursor-pointer items-center gap-[9px] rounded-xl border-[1.5px] border-[#cfd7cb] bg-[#fafbf9] px-[13px] py-[11px] text-[13px] font-semibold transition hover:border-sds-green hover:bg-[#f4faea] has-[input:checked]:border-sds-green has-[input:checked]:bg-[#f4faea] has-[input:checked]:ring-[3px] has-[input:checked]:ring-sds-green/20')
                <div class="grid grid-cols-2 gap-2.5">
                    <label class="{{ $choice }}">
                        <input type="radio" name="estado" class="pointer-events-none absolute opacity-0"
                               value="{{ \App\Models\PostModel::ESTADO_BORRADOR }}"
                               @checked($estadoActual === \App\Models\PostModel::ESTADO_BORRADOR)>
                        <span class="size-[9px] shrink-0 rounded-full bg-[#e8a317]"></span>
                        <span>Borrador</span>
                    </label>
                    <label class="{{ $choice }}">
                        <input type="radio" name="estado" class="pointer-events-none absolute opacity-0"
                               value="{{ \App\Models\PostModel::ESTADO_PUBLICADO }}"
                               @checked($estadoActual === \App\Models\PostModel::ESTADO_PUBLICADO)>
                        <span class="size-[9px] shrink-0 rounded-full bg-sds-green"></span>
                        <span>Publicado</span>
                    </label>
                </div>
            </div>

            <div class="mb-[18px] last:mb-0">
                <label for="fecha_actividad" class="{{ $label }} mb-[7px]">Fecha de actividad <span class="font-bold text-[#c92a2a]">*</span></label>
                <input type="date" id="fecha_actividad" name="fecha_actividad"
                       value="{{ old('fecha_actividad', isset($post) && $post->fecha_actividad ? $post->fecha_actividad->format('Y-m-d') : '') }}"
                       required class="{{ $input }} @error('fecha_actividad') {{ $errBorder }} @enderror">
                @error('fecha_actividad') <p class="{{ $errText }}">{{ $message }}</p> @enderror
            </div>
        </section>

        <section class="{{ $card }}">
            <div class="{{ $cardHead }}">
                <span class="{{ $step }}">4</span>
                <h2 class="m-0 text-[15px] font-bold">Clasificación y autores</h2>
            </div>

            @php($chevron = '<svg class="pointer-events-none absolute top-1/2 right-3.5 -translate-y-1/2 text-[#78827b]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>')

            <div class="mb-[18px] last:mb-0">
                <label for="categoria_id" class="{{ $label }} mb-[7px]">Categoría <span class="font-bold text-[#c92a2a]">*</span></label>
                <div class="relative">
                    <select id="categoria_id" name="categoria_id" required class="{{ $input }} appearance-none pr-[38px] @error('categoria_id') {{ $errBorder }} @enderror">
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" @selected((int) old('categoria_id', $post->categoria_id ?? 0) === $categoria->id)>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    {!! $chevron !!}
                </div>
                @error('categoria_id') <p class="{{ $errText }}">{{ $message }}</p> @enderror
            </div>

            <div class="mb-[18px] last:mb-0">
                <label for="actividad_id" class="{{ $label }} mb-[7px]">Actividad asociada <span class="text-xs font-normal text-[#78827b]">(opcional)</span></label>
                <div class="relative">
                    <select id="actividad_id" name="actividad_id" class="{{ $input }} appearance-none pr-[38px]">
                        <option value="">Sin actividad específica</option>
                        @foreach ($actividades as $actividad)
                            <option value="{{ $actividad->id }}" @selected((int) old('actividad_id', $post->actividad_id ?? 0) === $actividad->id)>
                                {{ $actividad->nombre }} ({{ optional($actividad->fecha_hora)->format('d/m H:i') }})
                            </option>
                        @endforeach
                    </select>
                    {!! $chevron !!}
                </div>
            </div>

            <div class="mb-[18px] last:mb-0">
                <div class="mb-[7px] flex items-center justify-between gap-2">
                    <span class="{{ $label }}">Autores</span>
                    <span id="autores-count" class="rounded-full bg-[#e8f4d4] px-2.5 py-1 text-[11.5px] font-bold whitespace-nowrap text-[#4f7918]">0 seleccionados</span>
                </div>
                @php($autoresSeleccionados = collect(old('autores', isset($post) ? $post->autores->pluck('id')->all() : [auth()->id()]))->map(fn ($v) => (int) $v)->all())

                @if ($usuarios->count() > 6)
                    <div class="mb-2.5">
                        <input type="search" id="autores-buscar" class="{{ $input }} px-3 py-2 text-[13px]" placeholder="Buscar por nombre o carnet..." autocomplete="off">
                    </div>
                @endif

                <div class="flex max-h-[220px] flex-col gap-2 overflow-y-auto" id="autores-lista">
                    @foreach ($usuarios as $usuario)
                        <label class="group relative flex cursor-pointer items-center justify-between gap-2.5 rounded-xl border-[1.5px] border-[#dce2d8] bg-[#fafbf9] px-3 py-2 transition has-[input:checked]:border-sds-green has-[input:checked]:bg-[#f4faea] [&.is-hidden]:hidden" data-search="{{ mb_strtolower($usuario->name . ' ' . $usuario->carnet) }}">
                            <span class="flex min-w-0 items-center gap-2.5 text-[12.5px] font-semibold">
                                <input type="checkbox" name="autores[]" class="pointer-events-none absolute opacity-0" value="{{ $usuario->id }}" @checked(in_array($usuario->id, $autoresSeleccionados, true))>
                                <span class="inline-flex size-7 shrink-0 items-center justify-center rounded-full bg-[#e9eee6] text-[11.5px] font-bold text-[#4a544d] group-has-[input:checked]:bg-sds-green group-has-[input:checked]:text-white">{{ mb_strtoupper(mb_substr($usuario->name, 0, 1)) }}</span>
                                <span class="truncate">{{ $usuario->name }}</span>
                            </span>
                            <span class="rounded-md border border-[#e1e6de] bg-white px-[7px] py-0.5 text-[11px] font-bold text-[#4a544d]">{{ $usuario->carnet }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>

<div class="mt-6 flex flex-wrap items-center justify-between gap-3.5 rounded-2xl border border-[#e3e8e0] bg-white px-[22px] py-4 shadow-[0_2px_12px_rgba(17,22,19,.035)]">
    <span class="text-xs text-[#78827b]">Los campos marcados con <span class="font-bold text-[#c92a2a]">*</span> son obligatorios.</span>
    <div class="flex w-full items-center gap-2.5 sm:w-auto">
        <a href="{{ route('admin.dashboard') }}" class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border-[1.5px] border-[#cfd7cb] bg-white px-5 py-[11px] font-[inherit] text-[13.5px] font-semibold text-sds-ink no-underline transition hover:bg-[#f4f6f3] sm:flex-none">Cancelar</a>
        <button type="submit" id="btn-submit" class="inline-flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-xl border-0 bg-linear-to-br from-sds-green to-sds-green-dark px-5 py-[11px] font-[inherit] text-[13.5px] font-bold text-white shadow-[0_4px_12px_rgba(111,165,43,.3)] transition disabled:cursor-not-allowed disabled:opacity-70 sm:flex-none">{{ $submitLabel ?? 'Guardar publicación' }}</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function bindCounter(inputId, counterId, max) {
        const input = document.getElementById(inputId);
        const counter = document.getElementById(counterId);
        if (!input || !counter) return;
        const update = () => {
            const n = input.value.length;
            counter.textContent = n + ' / ' + max;
            counter.classList.toggle('is-near', n >= max * 0.9 && n < max);
            counter.classList.toggle('is-full', n >= max);
        };
        update();
        input.addEventListener('input', update);
    }
    bindCounter('titulo', 'titulo-counter', 200);
    bindCounter('resumen', 'resumen-counter', 300);

    const contenido = document.getElementById('contenido');
    const stats = document.getElementById('contenido-stats');
    if (contenido && stats) {
        const updateStats = () => {
            const words = contenido.value.trim().split(/\s+/).filter(Boolean).length;
            stats.textContent = words + (words === 1 ? ' palabra' : ' palabras');
        };
        updateStats();
        contenido.addEventListener('input', updateStats);
    }

    const lista = document.getElementById('autores-lista');
    const countEl = document.getElementById('autores-count');
    const buscar = document.getElementById('autores-buscar');
    function updateAuthors() {
        if (!lista || !countEl) return;
        const n = lista.querySelectorAll('input[type=checkbox]:checked').length;
        countEl.textContent = n + (n === 1 ? ' seleccionado' : ' seleccionados');
    }
    if (lista) { lista.addEventListener('change', updateAuthors); updateAuthors(); }
    if (buscar && lista) {
        buscar.addEventListener('input', function () {
            const q = this.value.trim().toLowerCase();
            lista.querySelectorAll('[data-search]').forEach(function (el) {
                el.classList.toggle('is-hidden', q !== '' && !el.dataset.search.includes(q));
            });
        });
    }

    const MAX_BYTES = 4 * 1024 * 1024;
    const TYPES = ['image/jpeg', 'image/png', 'image/webp'];
    const box = document.getElementById('upload-box');
    const emptyBox = document.getElementById('dropzone-empty');
    const filledBox = document.getElementById('dropzone-filled');
    const fileInput = document.getElementById('imagen_principal');
    const fileName = document.getElementById('imagen-nombre');
    const errorEl = document.getElementById('imagen-error');
    const img = document.getElementById('imagen-preview');
    const changeBtn = document.getElementById('btn-change-img');
    const clearBtn = document.getElementById('btn-clear-img');

    function showFile(file) {
        errorEl.textContent = '';
        if (!file) return;
        if (!TYPES.includes(file.type)) {
            errorEl.textContent = 'Formato no permitido. Usa JPG, PNG o WEBP.';
            fileInput.value = '';
            return;
        }
        if (file.size > MAX_BYTES) {
            errorEl.textContent = 'La imagen pesa ' + (file.size / 1048576).toFixed(1) + ' MB y el máximo es 4 MB.';
            fileInput.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function (e) {
            img.src = e.target.result;
            if (fileName) fileName.textContent = file.name;
            if (emptyBox) emptyBox.classList.add('is-hidden');
            if (filledBox) filledBox.classList.remove('is-hidden');
        };
        reader.readAsDataURL(file);
    }

    if (box && fileInput) {
        box.addEventListener('click', function (e) {
            if (e.target && (e.target.id === 'btn-clear-img')) return;
            fileInput.click();
        });
        box.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                fileInput.click();
            }
        });
        if (changeBtn) {
            changeBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                fileInput.click();
            });
        }
        if (clearBtn) {
            clearBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                fileInput.value = '';
                if (img) img.src = '';
                if (fileName) fileName.textContent = '';
                if (errorEl) errorEl.textContent = '';
                if (filledBox) filledBox.classList.add('is-hidden');
                if (emptyBox) emptyBox.classList.remove('is-hidden');
            });
        }
        fileInput.addEventListener('change', function () {
            showFile(this.files && this.files[0]);
        });
        ['dragenter', 'dragover'].forEach(ev => box.addEventListener(ev, e => {
            e.preventDefault();
            box.classList.add('is-dragover');
        }));
        ['dragleave', 'drop'].forEach(ev => box.addEventListener(ev, e => {
            e.preventDefault();
            box.classList.remove('is-dragover');
        }));
        box.addEventListener('drop', function (e) {
            const file = e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files[0];
            if (!file) return;
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;
            showFile(file);
        });
    }

    const btn = document.getElementById('btn-submit');
    if (btn && btn.form) {
        btn.form.addEventListener('submit', function () {
            btn.disabled = true;
            btn.textContent = 'Guardando...';
        });
    }
});
</script>
