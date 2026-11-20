@csrf

@if ($errors->any())
    <div class="sds-alert-error" role="alert">
        <strong>Revisa los campos del formulario antes de continuar:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="sds-form-layout">
    <div class="sds-stack">
        <section class="sds-card">
            <div class="sds-card-head">
                <span class="sds-step-badge">1</span>
                <div>
                    <h2 class="sds-card-title">Contenido de la publicación</h2>
                    <p class="sds-card-hint">Lo que verán los visitantes en el sitio.</p>
                </div>
            </div>

            <div class="sds-field">
                <div class="sds-label-row">
                    <label for="titulo" class="sds-label">Título <span class="sds-req">*</span></label>
                    <span id="titulo-counter" class="sds-counter">0 / 200</span>
                </div>
                <input type="text" id="titulo" name="titulo"
                       value="{{ old('titulo', $post->titulo ?? '') }}"
                       maxlength="200" required
                       placeholder="Ej. Ponencia 1: Arquitectura IoT sostenible en campus"
                       class="sds-input is-title @error('titulo') has-error @enderror">
                @error('titulo') <p class="sds-error-text">{{ $message }}</p> @enderror
            </div>

            <div class="sds-field">
                <div class="sds-label-row">
                    <label for="resumen" class="sds-label">Resumen breve <span class="sds-opt">(opcional)</span></label>
                    <span id="resumen-counter" class="sds-counter">0 / 300</span>
                </div>
                <input type="text" id="resumen" name="resumen"
                       value="{{ old('resumen', $post->resumen ?? '') }}"
                       maxlength="300"
                       placeholder="Síntesis corta de la actividad o aprendizaje clave"
                       class="sds-input @error('resumen') has-error @enderror">
                @error('resumen') <p class="sds-error-text">{{ $message }}</p> @enderror
            </div>

            <div class="sds-field">
                <label for="contenido" class="sds-label">Contenido <span class="sds-req">*</span></label>
                <textarea id="contenido" name="contenido" required
                          placeholder="Redacta aquí el desarrollo de la actividad, expositores, temas tratados y conclusiones..."
                          class="sds-textarea @error('contenido') has-error @enderror">{{ old('contenido', $post->contenido ?? '') }}</textarea>
                <div class="sds-field-foot">
                    <span>Separa los párrafos con una línea en blanco.</span>
                    <span id="contenido-stats">0 palabras</span>
                </div>
                @error('contenido') <p class="sds-error-text">{{ $message }}</p> @enderror
            </div>
        </section>

        @php($hasExistingImg = isset($post) && $post->imagen_principal)
        <section class="sds-card">
            <div class="sds-card-head">
                <span class="sds-step-badge">2</span>
                <div>
                    <h2 class="sds-card-title">Imagen principal</h2>
                    <p class="sds-card-hint">JPG, JPEG, PNG o WEBP · Máx. 4 MB (formato horizontal 16:9).</p>
                </div>
            </div>

            <div id="upload-box" class="sds-dropzone" role="button" tabindex="0" aria-label="Seleccionar o arrastrar imagen principal">
                <div id="dropzone-empty" class="sds-dropzone-empty {{ $hasExistingImg ? 'is-hidden' : '' }}">
                    <span class="sds-upload-icon" aria-hidden="true">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m17 8-5-5-5 5"/><path d="M12 3v12"/></svg>
                    </span>
                    <span class="sds-upload-title">Seleccionar o arrastrar imagen</span>
                    <span class="sds-upload-sub">Arrastra una foto aquí o haz clic para explorarla</span>
                </div>

                <div id="dropzone-filled" class="sds-dropzone-filled {{ $hasExistingImg ? '' : 'is-hidden' }}">
                    <img id="imagen-preview"
                         src="{{ $hasExistingImg ? asset('storage/' . $post->imagen_principal) : '' }}"
                         alt="Vista previa de la imagen principal">
                    <div class="sds-dropzone-bar">
                        <span id="imagen-nombre" class="sds-dropzone-filename">
                            {{ $hasExistingImg ? $post->imagen_principal : '' }}
                        </span>
                        <div class="sds-dropzone-actions">
                            <button type="button" id="btn-change-img" class="sds-dz-btn">Cambiar</button>
                            <button type="button" id="btn-clear-img" class="sds-dz-btn is-danger">Quitar</button>
                        </div>
                    </div>
                </div>

                <input type="file" id="imagen_principal" name="imagen_principal" accept="image/jpeg,image/png,image/webp" style="display:none;">
            </div>

            <p id="imagen-error" class="sds-upload-error" role="alert"></p>
            @error('imagen_principal') <p class="sds-error-text">{{ $message }}</p> @enderror
        </section>
    </div>

    <div class="sds-stack">
        <section class="sds-card">
            <div class="sds-card-head">
                <span class="sds-step-badge">3</span>
                <h2 class="sds-card-title">Estado y fecha</h2>
            </div>

            <div class="sds-field">
                <span class="sds-label">Estado <span class="sds-req">*</span></span>
                @php($estadoActual = old('estado', $post->estado ?? \App\Models\PostModel::ESTADO_BORRADOR))
                <div class="sds-radio-grid">
                    <label class="sds-choice-card is-borrador">
                        <input type="radio" name="estado"
                               value="{{ \App\Models\PostModel::ESTADO_BORRADOR }}"
                               @checked($estadoActual === \App\Models\PostModel::ESTADO_BORRADOR)>
                        <span class="sds-choice-dot"></span>
                        <span>Borrador</span>
                    </label>
                    <label class="sds-choice-card is-publicado">
                        <input type="radio" name="estado"
                               value="{{ \App\Models\PostModel::ESTADO_PUBLICADO }}"
                               @checked($estadoActual === \App\Models\PostModel::ESTADO_PUBLICADO)>
                        <span class="sds-choice-dot"></span>
                        <span>Publicado</span>
                    </label>
                </div>
            </div>

            <div class="sds-field">
                <label for="fecha_actividad" class="sds-label">Fecha de actividad <span class="sds-req">*</span></label>
                <input type="date" id="fecha_actividad" name="fecha_actividad"
                       value="{{ old('fecha_actividad', isset($post) && $post->fecha_actividad ? $post->fecha_actividad->format('Y-m-d') : '') }}"
                       required class="sds-input @error('fecha_actividad') has-error @enderror">
                @error('fecha_actividad') <p class="sds-error-text">{{ $message }}</p> @enderror
            </div>
        </section>

        <section class="sds-card">
            <div class="sds-card-head">
                <span class="sds-step-badge">4</span>
                <h2 class="sds-card-title">Clasificación y autores</h2>
            </div>

            <div class="sds-field">
                <label for="categoria_id" class="sds-label">Categoría <span class="sds-req">*</span></label>
                <select id="categoria_id" name="categoria_id" required class="sds-select @error('categoria_id') has-error @enderror">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" @selected((int) old('categoria_id', $post->categoria_id ?? 0) === $categoria->id)>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id') <p class="sds-error-text">{{ $message }}</p> @enderror
            </div>

            <div class="sds-field">
                <label for="actividad_id" class="sds-label">Actividad asociada <span class="sds-opt">(opcional)</span></label>
                <select id="actividad_id" name="actividad_id" class="sds-select">
                    <option value="">Sin actividad específica</option>
                    @foreach ($actividades as $actividad)
                        <option value="{{ $actividad->id }}" @selected((int) old('actividad_id', $post->actividad_id ?? 0) === $actividad->id)>
                            {{ $actividad->nombre }} ({{ optional($actividad->fecha_hora)->format('d/m H:i') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="sds-field">
                <div class="sds-label-row">
                    <span class="sds-label">Autores</span>
                    <span id="autores-count" class="sds-authors-count">0 seleccionados</span>
                </div>
                @php($autoresSeleccionados = collect(old('autores', isset($post) ? $post->autores->pluck('id')->all() : [auth()->id()]))->map(fn ($v) => (int) $v)->all())

                @if ($usuarios->count() > 6)
                    <div class="sds-authors-tools">
                        <input type="search" id="autores-buscar" class="sds-input" placeholder="Buscar por nombre o carnet..." autocomplete="off">
                    </div>
                @endif

                <div class="sds-authors-list" id="autores-lista">
                    @foreach ($usuarios as $usuario)
                        <label class="sds-author-item" data-search="{{ mb_strtolower($usuario->name . ' ' . $usuario->carnet) }}">
                            <span class="sds-author-left">
                                <input type="checkbox" name="autores[]" value="{{ $usuario->id }}" @checked(in_array($usuario->id, $autoresSeleccionados, true))>
                                <span class="sds-avatar">{{ mb_strtoupper(mb_substr($usuario->name, 0, 1)) }}</span>
                                <span class="sds-author-name">{{ $usuario->name }}</span>
                            </span>
                            <span class="sds-carnet">{{ $usuario->carnet }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>

<div class="sds-actions-bar">
    <span class="sds-actions-note">Los campos marcados con <span class="sds-req">*</span> son obligatorios.</span>
    <div class="sds-actions-btns">
        <a href="{{ route('admin.dashboard') }}" class="sds-btn-cancel">Cancelar</a>
        <button type="submit" id="btn-submit" class="sds-btn-submit">{{ $submitLabel ?? 'Guardar publicación' }}</button>
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
            lista.querySelectorAll('.sds-author-item').forEach(function (el) {
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
