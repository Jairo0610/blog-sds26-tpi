@csrf

@php
    $input = 'w-full rounded-xl border-[1.5px] border-[#cfd7cb] bg-white px-3.5 py-[11px] font-[inherit] text-sm leading-normal text-sds-ink transition placeholder:text-[#78827b]/70 focus:border-sds-green focus:ring-4 focus:ring-sds-green/20 focus:outline-none';
    $errBorder = 'border-[#c92a2a]!';
    $card = 'rounded-2xl border border-[#e3e8e0] bg-white p-[18px] shadow-[0_2px_12px_rgba(17,22,19,.035)] sm:p-[22px]';
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

<section class="{{ $card }} max-w-[720px]">
    <div class="mb-[18px] last:mb-0">
        <div class="mb-[7px] flex items-center justify-between gap-2">
            <label for="nombre" class="{{ $label }}">Nombre <span class="font-bold text-[#c92a2a]">*</span></label>
            <span id="nombre-counter" class="{{ $counter }}">0 / 100</span>
        </div>
        <input type="text" id="nombre" name="nombre"
               value="{{ old('nombre', $categoria->nombre ?? '') }}"
               maxlength="100" required
               placeholder="Ej. Ponencias"
               class="{{ $input }} @error('nombre') {{ $errBorder }} @enderror">
        @error('nombre') <p class="{{ $errText }}">{{ $message }}</p> @enderror
    </div>

    <div class="mb-[18px] last:mb-0">
        <div class="mb-[7px] flex items-center justify-between gap-2">
            <label for="descripcion" class="{{ $label }}">Descripción <span class="text-xs font-normal text-[#78827b]">(opcional)</span></label>
            <span id="descripcion-counter" class="{{ $counter }}">0 / 500</span>
        </div>
        <textarea id="descripcion" name="descripcion" maxlength="500"
                  placeholder="Qué tipo de entradas agrupa esta categoría"
                  class="{{ $input }} min-h-[110px] resize-y leading-[1.6] @error('descripcion') {{ $errBorder }} @enderror">{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>
        @error('descripcion') <p class="{{ $errText }}">{{ $message }}</p> @enderror
    </div>
</section>

<div class="mt-6 flex max-w-[720px] flex-wrap items-center justify-between gap-3.5 rounded-2xl border border-[#e3e8e0] bg-white px-[22px] py-4 shadow-[0_2px_12px_rgba(17,22,19,.035)]">
    <span class="text-xs text-[#78827b]">Los campos marcados con <span class="font-bold text-[#c92a2a]">*</span> son obligatorios.</span>
    <div class="flex w-full items-center gap-2.5 sm:w-auto">
        <a href="{{ route('admin.categorias.index') }}" class="inline-flex flex-1 items-center justify-center gap-2 rounded-xl border-[1.5px] border-[#cfd7cb] bg-white px-5 py-[11px] font-[inherit] text-[13.5px] font-semibold text-sds-ink no-underline transition hover:bg-[#f4f6f3] sm:flex-none">Cancelar</a>
        <button type="submit" class="inline-flex flex-1 cursor-pointer items-center justify-center gap-2 rounded-xl border-0 bg-linear-to-br from-sds-green to-sds-green-dark px-5 py-[11px] font-[inherit] text-[13.5px] font-bold text-white shadow-[0_4px_12px_rgba(111,165,43,.3)] transition sm:flex-none">{{ $submitLabel ?? 'Guardar categoría' }}</button>
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
    bindCounter('nombre', 'nombre-counter', 100);
    bindCounter('descripcion', 'descripcion-counter', 500);
});
</script>
