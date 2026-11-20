@extends('layouts.auth')

@section('title', 'Panel de control')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .sds-dash-page {
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
        --bg: #f4f7f1;
        --danger: #c92a2a;
        --amber-bg: #fef3c7;
        --amber-txt: #92400e;
        --radius: 16px;

        min-height: 100vh;
        background:
            radial-gradient(900px 380px at 100% -10%, rgba(140, 198, 63, .16), transparent 60%),
            radial-gradient(700px 320px at -10% 0%, rgba(140, 198, 63, .08), transparent 60%),
            var(--bg);
        color: var(--ink);
        font-family: 'Poppins', ui-sans-serif, system-ui, -apple-system, sans-serif;
        -webkit-font-smoothing: antialiased;
    }
    .sds-dash-page *, .sds-dash-page *::before, .sds-dash-page *::after { box-sizing: border-box; }

    /* Topbar */
    .sds-topbar {
        position: sticky; top: 0; z-index: 30;
        background: rgba(255, 255, 255, .9);
        backdrop-filter: saturate(160%) blur(10px);
        -webkit-backdrop-filter: saturate(160%) blur(10px);
        border-bottom: 1px solid var(--line);
    }
    .sds-topbar-inner {
        max-width: 1200px; margin: 0 auto; padding: 12px 24px;
        display: flex; align-items: center; justify-content: space-between; gap: 16px;
        flex-wrap: wrap;
    }
    .sds-brand-group { display: inline-flex; align-items: center; gap: 14px; text-decoration: none; }
    .sds-logo-aseis { height: 30px; width: auto; max-width: none; display: block; }
    .sds-logo-sds { height: 38px; width: auto; max-width: none; display: block; }
    .sds-divider-v { width: 1px; height: 28px; background: var(--line-2); }
    .sds-brand-badge {
        font-size: 12px; font-weight: 600; color: var(--ink-2);
        background: var(--g-50); border: 1px solid var(--g-100);
        padding: 4px 10px; border-radius: 999px;
    }

    .sds-top-actions { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
    .sds-btn {
        display: inline-flex; align-items: center; justify-content: center; gap: 7px;
        padding: 9px 16px; border-radius: 11px;
        font-family: inherit; font-size: 13px; font-weight: 600;
        text-decoration: none; cursor: pointer; transition: all .15s ease;
    }
    .sds-btn-ghost {
        border: 1px solid var(--line-2); background: #fff; color: var(--ink);
    }
    .sds-btn-ghost:hover { background: var(--g-50); border-color: var(--g-500); color: var(--g-700); }
    .sds-btn-primary {
        border: none; color: #fff; font-weight: 700;
        background: linear-gradient(135deg, var(--g-500), var(--g-600));
        box-shadow: 0 3px 10px rgba(111, 165, 43, .28);
    }
    .sds-btn-primary:hover { transform: translateY(-1px); box-shadow: 0 5px 14px rgba(111, 165, 43, .38); }
    .sds-btn-dark {
        border: 1px solid var(--ink); background: transparent; color: var(--ink);
    }
    .sds-btn-dark:hover { background: var(--ink); color: #fff; }

    /* Main */
    .sds-main-wrap { max-width: 1200px; margin: 0 auto; padding: 28px 24px 56px; }

    .sds-alert-ok {
        margin-bottom: 20px; padding: 14px 18px; border-radius: 14px;
        border: 1px solid #b5dc7a; border-left: 4px solid var(--g-600);
        background: var(--g-50); color: var(--g-700);
        font-size: 13.5px; font-weight: 600;
    }

    /* Cabecera */
    .sds-hero-banner {
        position: relative; overflow: hidden;
        margin-bottom: 24px; padding: 24px 28px;
        border-radius: 20px;
        background: linear-gradient(135deg, #ffffff 0%, #f3faea 100%);
        border: 1px solid var(--line);
        box-shadow: 0 4px 20px rgba(17, 22, 19, .035);
        display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px;
    }
    .sds-hero-tag {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 11px; border-radius: 999px;
        background: var(--g-100); color: var(--g-700);
        font-size: 11px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
        margin-bottom: 8px;
    }
    .sds-hero-tag::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--g-500); }
    .sds-hero-title { margin: 0; font-size: 26px; font-weight: 800; line-height: 1.15; letter-spacing: -.01em; }
    .sds-hero-sub { margin: 6px 0 0; font-size: 13.5px; color: var(--ink-2); }

    /* KPIs en 4 columnas */
    .sds-stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 26px;
    }
    @media (max-width: 900px) { .sds-stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 520px) { .sds-stats-grid { grid-template-columns: 1fr; } }

    .sds-stat-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: var(--radius);
        padding: 18px 20px;
        box-shadow: 0 2px 10px rgba(17, 22, 19, .03);
        display: flex; flex-direction: column; justify-content: space-between;
    }
    .sds-stat-top {
        display: flex; align-items: center; justify-content: space-between; gap: 8px;
    }
    .sds-stat-label {
        font-size: 11.5px; font-weight: 700; text-transform: uppercase;
        letter-spacing: .04em; color: var(--ink-3);
    }
    .sds-stat-dot { width: 9px; height: 9px; border-radius: 50%; background: var(--line-2); }
    .sds-stat-dot.is-green { background: var(--g-500); }
    .sds-stat-dot.is-amber { background: #e8a317; }
    .sds-stat-value {
        margin: 10px 0 0; font-size: 28px; font-weight: 800; line-height: 1.1;
        color: var(--ink); font-variant-numeric: tabular-nums;
    }
    .sds-stat-value.is-green { color: var(--g-600); }
    .sds-stat-value.is-amber { color: var(--amber-txt); }

    /* Tabla de publicaciones */
    .sds-table-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(17, 22, 19, .04);
    }
    .sds-table-head {
        padding: 18px 24px;
        border-bottom: 1px solid var(--line);
        display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 12px;
    }
    .sds-table-title { margin: 0; font-size: 16.5px; font-weight: 800; color: var(--ink); }
    .sds-table-link {
        font-size: 13px; font-weight: 700; color: var(--g-700); text-decoration: none;
    }
    .sds-table-link:hover { text-decoration: underline; }

    .sds-table-scroll { width: 100%; overflow-x: auto; }
    .sds-table {
        width: 100%; border-collapse: collapse; text-align: left; font-size: 13.5px;
    }
    .sds-table th {
        padding: 12px 18px;
        background: #f8faf6;
        border-bottom: 1px solid var(--line);
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        letter-spacing: .05em; color: var(--ink-3);
        white-space: nowrap;
    }
    .sds-table td {
        padding: 14px 18px;
        border-bottom: 1px solid #f0f3ed;
        vertical-align: middle;
        color: var(--ink-2);
    }
    .sds-table tbody tr:last-child td { border-bottom: none; }
    .sds-table tbody tr:hover { background: #fafcf8; }

    /* Celda Título + Miniatura fija */
    .sds-post-cell {
        display: flex; align-items: center; gap: 14px; min-width: 240px;
    }
    .sds-post-thumb {
        width: 72px; height: 48px; border-radius: 10px;
        object-fit: cover; flex-shrink: 0;
        border: 1px solid var(--line); background: var(--g-50);
        display: block;
    }
    .sds-post-thumb-placeholder {
        width: 72px; height: 48px; border-radius: 10px;
        border: 1px dashed var(--line-2); background: var(--g-50);
        color: var(--g-700); font-size: 10px; font-weight: 700;
        display: inline-flex; align-items: center; justify-content: center;
        flex-shrink: 0; text-transform: uppercase;
    }
    .sds-post-info { min-width: 0; }
    .sds-post-name {
        display: block; font-size: 14px; font-weight: 700; color: var(--ink);
        line-height: 1.35; text-decoration: none;
    }
    .sds-post-name:hover { color: var(--g-700); }
    .sds-post-sub {
        display: block; margin-top: 2px; font-size: 11.5px; color: var(--ink-3);
        max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }

    .sds-cat-pill {
        display: inline-block; padding: 4px 10px; border-radius: 8px;
        background: #f3f6f1; border: 1px solid #e4e9e0;
        font-size: 12px; font-weight: 600; color: var(--ink-2);
        white-space: nowrap;
    }
    .sds-date-cell { white-space: nowrap; font-size: 13px; font-variant-numeric: tabular-nums; }
    .sds-authors-cell { min-width: 170px; max-width: 240px; font-size: 12.5px; line-height: 1.4; color: var(--ink); font-weight: 500; }

    .sds-status-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 11px; border-radius: 999px;
        font-size: 11.5px; font-weight: 700; white-space: nowrap;
    }
    .sds-status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
    .sds-status-badge.is-pub { background: var(--g-100); color: var(--g-700); }
    .sds-status-badge.is-pub::before { background: var(--g-600); }
    .sds-status-badge.is-draft { background: var(--amber-bg); color: var(--amber-txt); }
    .sds-status-badge.is-draft::before { background: #d97706; }

    /* Botones de acción */
    .sds-row-actions {
        display: inline-flex; align-items: center; justify-content: flex-end; gap: 8px;
        white-space: nowrap;
    }
    .sds-act-btn {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 6px 12px; border-radius: 8px;
        font-family: inherit; font-size: 12px; font-weight: 600;
        text-decoration: none; cursor: pointer; transition: all .15s ease;
    }
    .sds-act-view {
        border: 1px solid var(--g-100); background: var(--g-50); color: var(--g-700);
    }
    .sds-act-view:hover { border-color: var(--g-500); background: var(--g-100); }
    .sds-act-edit {
        border: 1px solid var(--line-2); background: #fff; color: var(--ink);
    }
    .sds-act-edit:hover { border-color: var(--g-500); background: var(--g-50); color: var(--g-700); }
    .sds-act-del {
        border: 1px solid #ffc9c9; background: #fff5f5; color: var(--danger);
    }
    .sds-act-del:hover { background: #ffe3e3; border-color: #ffa8a8; }

    .sds-empty-row {
        padding: 40px 24px !important; text-align: center; color: var(--ink-3);
    }

    @media (max-width: 640px) {
        .sds-topbar-inner, .sds-main-wrap { padding-left: 16px; padding-right: 16px; }
        .sds-logo-aseis { height: 24px; } .sds-logo-sds { height: 30px; }
        .sds-brand-badge { display: none; }
        .sds-hero-banner { padding: 18px 20px; }
        .sds-hero-title { font-size: 22px; }
    }
</style>

<div class="sds-dash-page">
    <header class="sds-topbar">
        <div class="sds-topbar-inner">
            <div class="sds-brand-group">
                <a href="{{ route('admin.dashboard') }}" class="sds-brand-group">
                    <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS - Universidad de El Salvador" class="sds-logo-aseis">
                    <span class="sds-divider-v"></span>
                    <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="sds-logo-sds">
                </a>
                <span class="sds-brand-badge">Panel administrativo</span>
            </div>

            <div class="sds-top-actions">
                <a href="{{ route('home') }}" class="sds-btn sds-btn-ghost">Ver blog</a>
                <a href="{{ route('admin.posts.create') }}" class="sds-btn sds-btn-primary">+ Nueva publicación</a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit" class="sds-btn sds-btn-dark">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </header>

    <main class="sds-main-wrap">
        @if (session('success'))
            <div class="sds-alert-ok" role="status">
                {{ session('success') }}
            </div>
        @endif

        <section class="sds-hero-banner">
            <div>
                <span class="sds-hero-tag">Semana de Sistemas 2026 · Administración</span>
                <h1 class="sds-hero-title">Panel de control</h1>
                <p class="sds-hero-sub">Sesión iniciada como <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->carnet }}).</p>
            </div>
        </section>

        <section class="sds-stats-grid" aria-label="Resumen de publicaciones">
            <div class="sds-stat-card">
                <div class="sds-stat-top">
                    <span class="sds-stat-label">Total publicaciones</span>
                    <span class="sds-stat-dot"></span>
                </div>
                <p class="sds-stat-value">{{ $totalPosts ?? 0 }}</p>
            </div>

            <div class="sds-stat-card">
                <div class="sds-stat-top">
                    <span class="sds-stat-label">Publicadas</span>
                    <span class="sds-stat-dot is-green"></span>
                </div>
                <p class="sds-stat-value is-green">{{ $publicadasCount ?? 0 }}</p>
            </div>

            <div class="sds-stat-card">
                <div class="sds-stat-top">
                    <span class="sds-stat-label">Borradores</span>
                    <span class="sds-stat-dot is-amber"></span>
                </div>
                <p class="sds-stat-value is-amber">{{ $borradoresCount ?? 0 }}</p>
            </div>

            <div class="sds-stat-card">
                <div class="sds-stat-top">
                    <span class="sds-stat-label">Categorías / Actividades</span>
                    <span class="sds-stat-dot is-green"></span>
                </div>
                <p class="sds-stat-value">{{ $categoriasCount ?? 0 }} / {{ $actividadesCount ?? 0 }}</p>
            </div>
        </section>

        <section class="sds-table-card">
            <div class="sds-table-head">
                <h2 class="sds-table-title">Publicaciones registradas</h2>
                <a href="{{ route('admin.posts.create') }}" class="sds-table-link">+ Subir nueva entrada</a>
            </div>

            <div class="sds-table-scroll">
                <table class="sds-table">
                    <thead>
                        <tr>
                            <th>Publicación</th>
                            <th>Categoría</th>
                            <th>Fecha actividad</th>
                            <th>Autores</th>
                            <th>Estado</th>
                            <th style="text-align:right;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($posts ?? [] as $post)
                            <tr>
                                <td>
                                    <div class="sds-post-cell">
                                        @if ($post->imagen_principal)
                                            <img src="{{ asset('storage/' . $post->imagen_principal) }}" alt="{{ $post->titulo }}" class="sds-post-thumb">
                                        @else
                                            <span class="sds-post-thumb-placeholder">SDS26</span>
                                        @endif

                                        <div class="sds-post-info">
                                            @if ($post->estado === \App\Models\PostModel::ESTADO_PUBLICADO)
                                                <a href="{{ route('posts.show', $post->slug) }}" class="sds-post-name">{{ $post->titulo }}</a>
                                            @else
                                                <span class="sds-post-name">{{ $post->titulo }}</span>
                                            @endif
                                            @if ($post->resumen)
                                                <span class="sds-post-sub">{{ $post->resumen }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="sds-cat-pill">{{ $post->categoria->nombre ?? '—' }}</span>
                                </td>
                                <td class="sds-date-cell">
                                    {{ optional($post->fecha_actividad)->format('d/m/Y') ?? '—' }}
                                </td>
                                <td class="sds-authors-cell">
                                    @if ($post->autores && $post->autores->isNotEmpty())
                                        {{ $post->autores->pluck('name')->join(', ') }}
                                    @else
                                        {{ $post->usuario->name ?? '—' }}
                                    @endif
                                </td>
                                <td>
                                    @if ($post->estado === \App\Models\PostModel::ESTADO_PUBLICADO)
                                        <span class="sds-status-badge is-pub">Publicado</span>
                                    @else
                                        <span class="sds-status-badge is-draft">Borrador</span>
                                    @endif
                                </td>
                                <td style="text-align:right;">
                                    <div class="sds-row-actions">
                                        @if ($post->estado === \App\Models\PostModel::ESTADO_PUBLICADO)
                                            <a href="{{ route('posts.show', $post->slug) }}" class="sds-act-btn sds-act-view">Ver</a>
                                        @endif
                                        <a href="{{ route('admin.posts.edit', $post) }}" class="sds-act-btn sds-act-edit">Editar</a>
                                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" style="margin:0;" onsubmit="return confirm('¿Eliminar esta publicación?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="sds-act-btn sds-act-del">Eliminar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="sds-empty-row">
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
