@csrf

@if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-800">
        <p class="font-bold">Revisa los campos del formulario:</p>
        <ul class="mt-1 list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="titulo" class="block text-sm font-bold text-sds-ink">Título de la publicación *</label>
        <input
            type="text"
            id="titulo"
            name="titulo"
            value="{{ old("titulo", $post->titulo ?? "") }}"
            maxlength="200"
            required
            class="mt-1.5 w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-sds-ink focus:border-sds-green focus:outline-none"
            placeholder="Ej. Ponencia 1: Investigación aplicada en IoT agrícola"
        >
    </div>

    <div>
        <label for="fecha_actividad" class="block text-sm font-bold text-sds-ink">Fecha de la actividad *</label>
        <input
            type="date"
            id="fecha_actividad"
            name="fecha_actividad"
            value="{{ old("fecha_actividad", isset($post) && $post->fecha_actividad ? $post->fecha_actividad->format("Y-m-d") : "") }}"
            required
            class="mt-1.5 w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-sds-ink focus:border-sds-green focus:outline-none"
        >
    </div>

    <div>
        <label for="estado" class="block text-sm font-bold text-sds-ink">Estado de la entrada *</label>
        @php($estadoActual = old("estado", $post->estado ?? \App\Models\PostModel::ESTADO_BORRADOR))
        <select
            id="estado"
            name="estado"
            required
            class="mt-1.5 w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-sds-ink focus:border-sds-green focus:outline-none"
        >
            <option value="{{ \App\Models\PostModel::ESTADO_BORRADOR }}" @selected($estadoActual === \App\Models\PostModel::ESTADO_BORRADOR)>
                Borrador
            </option>
            <option value="{{ \App\Models\PostModel::ESTADO_PUBLICADO }}" @selected($estadoActual === \App\Models\PostModel::ESTADO_PUBLICADO)>
                Publicado
            </option>
        </select>
    </div>

    <div>
        <label for="categoria_id" class="block text-sm font-bold text-sds-ink">Categoría *</label>
        <select
            id="categoria_id"
            name="categoria_id"
            required
            class="mt-1.5 w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-sds-ink focus:border-sds-green focus:outline-none"
        >
            <option value="">Selecciona una categoría</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @selected((int) old("categoria_id", $post->categoria_id ?? 0) === $categoria->id)>
                    {{ $categoria->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="actividad_id" class="block text-sm font-bold text-sds-ink">Actividad del itinerario (opcional)</label>
        <select
            id="actividad_id"
            name="actividad_id"
            class="mt-1.5 w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-sds-ink focus:border-sds-green focus:outline-none"
        >
            <option value="">Sin actividad específica</option>
            @foreach ($actividades as $actividad)
                <option value="{{ $actividad->id }}" @selected((int) old("actividad_id", $post->actividad_id ?? 0) === $actividad->id)>
                    {{ $actividad->nombre }} ({{ optional($actividad->fecha_hora)->format("d/m H:i") }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="md:col-span-2">
        <label for="resumen" class="block text-sm font-bold text-sds-ink">Resumen breve (opcional, máx. 300 caracteres)</label>
        <input
            type="text"
            id="resumen"
            name="resumen"
            value="{{ old("resumen", $post->resumen ?? "") }}"
            maxlength="300"
            class="mt-1.5 w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-sds-ink focus:border-sds-green focus:outline-none"
            placeholder="Síntesis corta de la actividad o aprendizaje principal"
        >
    </div>

    <div class="md:col-span-2">
        <span class="block text-sm font-bold text-sds-ink">Autor o autores</span>
        @php($autoresSeleccionados = collect(old("autores", isset($post) ? $post->autores->pluck("id")->all() : [auth()->id()]))->map(fn($v) => (int) $v)->all())
        <div class="mt-2 flex flex-wrap gap-4">
            @foreach ($usuarios as $usuario)
                <label class="inline-flex items-center gap-2 rounded-lg border border-gray-200 px-3 py-2 text-sm text-sds-ink cursor-pointer hover:bg-gray-50">
                    <input
                        type="checkbox"
                        name="autores[]"
                        value="{{ $usuario->id }}"
                        @checked(in_array($usuario->id, $autoresSeleccionados, true))
                        class="rounded border-gray-300 text-sds-green focus:ring-sds-green"
                    >
                    <span>{{ $usuario->name }} ({{ $usuario->carnet }})</span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="md:col-span-2">
        <label for="imagen_principal" class="block text-sm font-bold text-sds-ink">Imagen principal (JPG, JPEG, PNG o WEBP · máx. 4 MB)</label>
        <input
            type="file"
            id="imagen_principal"
            name="imagen_principal"
            accept="image/jpeg,image/png,image/webp"
            class="mt-1.5 block w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2 text-sm text-sds-ink file:mr-4 file:rounded-md file:border-0 file:bg-sds-mint file:px-3 file:py-1.5 file:text-xs file:font-bold file:text-sds-green-dark hover:file:bg-sds-green/20"
        >
        @if (isset($post) && $post->imagen_principal)
            <div class="mt-3 flex items-center gap-4">
                <img src="{{ asset("storage/" . $post->imagen_principal) }}" alt="{{ $post->titulo }}" class="h-20 w-32 rounded-lg object-cover border border-gray-200">
                <span class="text-xs text-sds-ink/70">Imagen actual: {{ $post->imagen_principal }}</span>
            </div>
        @endif
    </div>

    <div class="md:col-span-2">
        <label for="contenido" class="block text-sm font-bold text-sds-ink">Contenido de la publicación *</label>
        <textarea
            id="contenido"
            name="contenido"
            rows="8"
            required
            class="mt-1.5 w-full rounded-lg border border-gray-300 px-3.5 py-2.5 text-sm text-sds-ink focus:border-sds-green focus:outline-none"
            placeholder="Escribe aquí la crónica, aprendizajes, expositores o detalles de la actividad..."
        >{{ old("contenido", $post->contenido ?? "") }}</textarea>
    </div>
</div>

<div class="mt-8 flex flex-wrap items-center justify-end gap-3 border-t border-gray-100 pt-6">
    <a href="{{ route("admin.dashboard") }}" class="rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-semibold text-sds-ink hover:bg-gray-50">
        Cancelar
    </a>
    <button type="submit" class="rounded-lg bg-sds-green px-5 py-2.5 text-sm font-bold text-white hover:bg-sds-green-dark">
        {{ $submitLabel ?? "Guardar publicación" }}
    </button>
</div>