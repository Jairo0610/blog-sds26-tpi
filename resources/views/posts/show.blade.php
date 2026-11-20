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

    <style>
        .sds-post-page {
            --g-50: #f4faea;
            --g-100: #e8f4d4;
            --g-500: #8cc63f;
            --g-600: #6fa52b;
            --g-700: #4f7918;
            --ink: #111613;
            --ink-2: #4a544d;
            --ink-3: #78827b;
            --line: #e3e8e0;
            --line-2: #cfd7cb;
            --bg: #f6f8f4;

            min-height: 100vh;
            background:
                radial-gradient(900px 360px at 100% -10%, rgba(140, 198, 63, .14), transparent 60%),
                radial-gradient(700px 300px at -10% 0%, rgba(140, 198, 63, .07), transparent 60%),
                var(--bg);
            color: var(--ink);
            font-family: 'Poppins', ui-sans-serif, system-ui, -apple-system, sans-serif;
            -webkit-font-smoothing: antialiased;
        }
        .sds-post-page *, .sds-post-page *::before, .sds-post-page *::after { box-sizing: border-box; }

        .sds-topbar {
            position: sticky; top: 0; z-index: 30;
            background: rgba(255, 255, 255, .92);
            backdrop-filter: saturate(160%) blur(10px);
            -webkit-backdrop-filter: saturate(160%) blur(10px);
            border-bottom: 1px solid var(--line);
        }
        .sds-topbar-inner {
            max-width: 1120px; margin: 0 auto; padding: 12px 24px;
            display: flex; align-items: center; justify-content: space-between; gap: 16px;
        }
        .sds-brand-group { display: inline-flex; align-items: center; gap: 14px; text-decoration: none; }
        .sds-logo-aseis { height: 30px; width: auto; max-width: none; display: block; }
        .sds-logo-sds { height: 38px; width: auto; max-width: none; display: block; }
        .sds-divider-v { width: 1px; height: 28px; background: var(--line-2); }
        .sds-nav-actions { display: flex; align-items: center; gap: 10px; }
        .sds-btn-outline {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 8px 15px; border-radius: 999px;
            border: 1px solid var(--line-2); background: #fff;
            color: var(--ink); font-size: 13px; font-weight: 600; text-decoration: none;
            transition: all .15s ease;
        }
        .sds-btn-outline:hover { background: var(--g-50); border-color: var(--g-500); color: var(--g-700); }

        .sds-article-wrap {
            max-width: 880px;
            margin: 0 auto;
            padding: 24px 24px 64px;
        }
        .sds-breadcrumb {
            display: flex; flex-wrap: wrap; align-items: center; gap: 8px;
            font-size: 12.5px; color: var(--ink-3); margin-bottom: 16px;
        }
        .sds-breadcrumb a { color: var(--ink-2); text-decoration: none; font-weight: 500; }
        .sds-breadcrumb a:hover { color: var(--g-700); text-decoration: underline; }
        .sds-breadcrumb .is-current { color: var(--ink); font-weight: 600; }

        .sds-article-card {
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 6px 28px rgba(17, 22, 19, .045);
        }
        .sds-article-hero {
            padding: 28px 34px 22px;
            background: linear-gradient(135deg, #ffffff 0%, #f5fbed 100%);
            border-bottom: 1px solid var(--line);
        }
        .sds-badges-row {
            display: flex; flex-wrap: wrap; align-items: center; gap: 10px;
            margin-bottom: 12px;
        }
        .sds-cat-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 999px;
            background: var(--g-100); color: var(--g-700);
            font-size: 11px; font-weight: 700; letter-spacing: .05em; text-transform: uppercase;
        }
        .sds-date-badge {
            font-size: 12.5px; font-weight: 500; color: var(--ink-3);
        }
        .sds-article-title {
            margin: 0;
            font-size: 30px;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -.015em;
            color: var(--ink);
        }
        .sds-article-summary {
            margin: 12px 0 0;
            font-size: 15px;
            line-height: 1.6;
            color: var(--ink-2);
            font-weight: 400;
        }

        .sds-meta-strip {
            margin-top: 18px;
            padding-top: 16px;
            border-top: 1px solid #e6ece1;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .sds-authors-group {
            display: flex; flex-wrap: wrap; align-items: center; gap: 8px;
        }
        .sds-author-pill {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 4px 12px 4px 6px;
            border-radius: 999px;
            background: #ffffff;
            border: 1px solid var(--line);
            font-size: 12.5px;
            font-weight: 600;
            color: var(--ink);
        }
        .sds-author-avatar {
            width: 24px; height: 24px; border-radius: 50%;
            background: linear-gradient(135deg, var(--g-500), var(--g-600));
            color: #ffffff; font-size: 11px; font-weight: 800;
            display: inline-flex; align-items: center; justify-content: center;
        }
        .sds-activity-tag {
            font-size: 12px;
            font-weight: 600;
            color: var(--g-700);
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 5px 12px;
        }

        /* Imagen contenida y proporcionada para no invadir la lectura */
        .sds-cover-wrap {
            padding: 24px 34px 0;
        }
        .sds-cover-box {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--line);
            background: #f3f6f1;
            max-height: 310px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sds-cover-box img {
            display: block;
            width: 100%;
            max-height: 310px;
            object-fit: cover;
        }

        .sds-article-body {
            padding: 28px 34px 32px;
            font-size: 15.5px;
            line-height: 1.78;
            color: #1f2622;
        }
        .sds-article-body p {
            margin: 0 0 16px;
        }
        .sds-article-body p:last-child {
            margin-bottom: 0;
        }

        .sds-article-footer {
            margin: 0 34px;
            padding: 18px 0 28px;
            border-top: 1px solid #eff2ec;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            font-size: 12.5px;
            color: var(--ink-3);
        }

        .sds-extra-section {
            padding: 0 34px 32px;
        }
        .sds-extra-title {
            margin: 0 0 14px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--ink-2);
        }
        .sds-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 14px;
        }
        .sds-gallery-item {
            margin: 0;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--line);
            background: #fafbf9;
        }
        .sds-gallery-item img {
            display: block;
            width: 100%;
            aspect-ratio: 16 / 10;
            object-fit: cover;
        }
        .sds-gallery-caption {
            padding: 8px 12px;
            font-size: 12px;
            color: var(--ink-2);
        }

        /* Publicaciones relacionadas compactas y uniformes */
        .sds-related-wrap {
            margin-top: 34px;
        }
        .sds-related-head {
            display: flex; align-items: center; justify-content: space-between; gap: 12px;
            margin-bottom: 16px;
        }
        .sds-related-title {
            margin: 0;
            font-size: 18px;
            font-weight: 800;
            color: var(--ink);
        }
        .sds-related-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }
        @media (max-width: 780px) {
            .sds-related-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }
        @media (max-width: 540px) {
            .sds-related-grid { grid-template-columns: 1fr; }
        }
        .sds-rel-card {
            display: flex; flex-direction: column;
            background: #ffffff;
            border: 1px solid var(--line);
            border-radius: 16px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
        }
        .sds-rel-card:hover {
            transform: translateY(-2px);
            border-color: var(--g-500);
            box-shadow: 0 8px 20px rgba(17, 22, 19, .06);
        }
        .sds-rel-thumb {
            width: 100%;
            aspect-ratio: 16 / 10;
            background: var(--g-50);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .sds-rel-thumb img {
            width: 100%; height: 100%; object-fit: cover; display: block;
        }
        .sds-rel-placeholder {
            font-size: 11px; font-weight: 700; color: var(--g-700); letter-spacing: .06em;
        }
        .sds-rel-body {
            padding: 13px 15px;
            display: flex; flex-direction: column; flex: 1;
        }
        .sds-rel-cat {
            font-size: 10.5px; font-weight: 700; color: var(--g-700); text-transform: uppercase;
            letter-spacing: .04em;
        }
        .sds-rel-name {
            margin: 5px 0 0; font-size: 14px; font-weight: 700; line-height: 1.35;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }

        @media (max-width: 640px) {
            .sds-topbar-inner, .sds-article-wrap { padding-left: 16px; padding-right: 16px; }
            .sds-logo-aseis { height: 24px; } .sds-logo-sds { height: 30px; }
            .sds-article-hero { padding: 22px 18px 18px; }
            .sds-article-title { font-size: 24px; }
            .sds-cover-wrap { padding: 18px 18px 0; }
            .sds-cover-box, .sds-cover-box img { max-height: 220px; }
            .sds-article-body, .sds-extra-section { padding-left: 18px; padding-right: 18px; }
            .sds-article-footer { margin-left: 18px; margin-right: 18px; }
        }
    </style>
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
@endphp
<div class="sds-post-page">
    <header class="sds-topbar">
        <div class="sds-topbar-inner">
            <a href="{{ route('home') }}" class="sds-brand-group">
                <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS - Universidad de El Salvador" class="sds-logo-aseis">
                <span class="sds-divider-v"></span>
                <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="sds-logo-sds">
            </a>
            <div class="sds-nav-actions">
                @auth
                    <a href="{{ route('admin.posts.edit', $post) }}" class="sds-btn-outline">Editar entrada</a>
                @endauth
                <a href="{{ route('home') }}" class="sds-btn-outline">← Volver al blog</a>
            </div>
        </div>
    </header>

    <main class="sds-article-wrap">
        <nav class="sds-breadcrumb" aria-label="Migas de pan">
            <a href="{{ route('home') }}">Inicio</a>
            <span>/</span>
            @if ($post->categoria)
                <a href="{{ route('home', ['categoria' => $post->categoria->slug]) . '#publicaciones' }}">{{ $post->categoria->nombre }}</a>
                <span>/</span>
            @endif
            <span class="is-current">{{ \Illuminate\Support\Str::limit($post->titulo, 48) }}</span>
        </nav>

        <article class="sds-article-card">
            <header class="sds-article-hero">
                <div class="sds-badges-row">
                    @if ($post->categoria)
                        <span class="sds-cat-badge">{{ $post->categoria->nombre }}</span>
                    @endif
                    @if ($fechaFormateada)
                        <span class="sds-date-badge">Actividad del {{ $fechaFormateada }}</span>
                    @endif
                </div>

                <h1 class="sds-article-title">{{ $post->titulo }}</h1>

                @if ($post->resumen)
                    <p class="sds-article-summary">{{ $post->resumen }}</p>
                @endif

                <div class="sds-meta-strip">
                    <div class="sds-authors-group">
                        @php($listaAutores = $post->autores->isNotEmpty() ? $post->autores : collect([$post->usuario])->filter())
                        @foreach ($listaAutores as $autor)
                            <span class="sds-author-pill">
                                <span class="sds-author-avatar">{{ mb_strtoupper(mb_substr($autor->name, 0, 1)) }}</span>
                                <span>{{ $autor->name }}</span>
                            </span>
                        @endforeach
                    </div>

                    @if ($post->actividad)
                        <span class="sds-activity-tag">
                            Itinerario: {{ $post->actividad->nombre }}
                        </span>
                    @endif
                </div>
            </header>

            @if ($post->imagen_principal)
                <div class="sds-cover-wrap">
                    <div class="sds-cover-box">
                        <img src="{{ asset('storage/' . $post->imagen_principal) }}" alt="{{ $post->titulo }}">
                    </div>
                </div>
            @endif

            <div class="sds-article-body">
                @foreach (preg_split("/\r\n|\n|\r/", trim($post->contenido)) as $parrafo)
                    @if (filled($parrafo))
                        <p>{{ $parrafo }}</p>
                    @endif
                @endforeach
            </div>

            @if ($post->imagenes->isNotEmpty())
                <section class="sds-extra-section">
                    <h2 class="sds-extra-title">Galería de la actividad</h2>
                    <div class="sds-gallery-grid">
                        @foreach ($post->imagenes as $img)
                            <figure class="sds-gallery-item">
                                <img src="{{ asset('storage/' . $img->ruta) }}" alt="{{ $img->descripcion ?? $post->titulo }}" loading="lazy">
                                @if ($img->descripcion)
                                    <figcaption class="sds-gallery-caption">{{ $img->descripcion }}</figcaption>
                                @endif
                            </figure>
                        @endforeach
                    </div>
                </section>
            @endif

            <div class="sds-article-footer">
                <span>Semana de Sistemas 2026 · Green IoT</span>
                <a href="{{ route('home') }}" class="sds-btn-outline">← Ver todas las publicaciones</a>
            </div>
        </article>

        @if ($relacionadas->isNotEmpty())
            <section class="sds-related-wrap">
                <div class="sds-related-head">
                    <h2 class="sds-related-title">Más publicaciones de la semana</h2>
                    <a href="{{ route('home') }}" class="sds-btn-outline">Ver todas</a>
                </div>
                <div class="sds-related-grid">
                    @foreach ($relacionadas as $item)
                        <a href="{{ route('posts.show', $item->slug) }}" class="sds-rel-card">
                            <div class="sds-rel-thumb">
                                @if ($item->imagen_principal)
                                    <img src="{{ asset('storage/' . $item->imagen_principal) }}" alt="{{ $item->titulo }}" loading="lazy">
                                @else
                                    <span class="sds-rel-placeholder">SDS26 GREEN IOT</span>
                                @endif
                            </div>
                            <div class="sds-rel-body">
                                @if ($item->categoria)
                                    <span class="sds-rel-cat">{{ $item->categoria->nombre }}</span>
                                @endif
                                <h3 class="sds-rel-name">{{ $item->titulo }}</h3>
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
