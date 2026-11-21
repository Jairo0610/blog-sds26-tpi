@extends('layouts.auth')

@section('title', 'Editar publicación')

@section('content')
@include('admin.posts._styles')

<div class="sds-admin-page">
    <header class="sds-topbar">
        <div class="sds-topbar-inner">
            <a href="{{ route('admin.dashboard') }}" class="sds-brand-group">
                <img src="{{ asset('img/aseis-logo.png') }}" alt="ASEIS - Universidad de El Salvador" class="sds-logo-aseis">
                <span class="sds-divider-v"></span>
                <img src="{{ asset('img/sds26-logo.png') }}" alt="SDS26 Green IoT" class="sds-logo-sds">
            </a>
            <a href="{{ route('admin.dashboard') }}" class="sds-back-btn">← <span class="txt">Volver al panel</span></a>
        </div>
    </header>

    <main class="sds-main-wrap">
        <nav class="sds-breadcrumb" aria-label="Migas de pan">
            <a href="{{ route('admin.dashboard') }}">Panel</a>
            <span>/</span>
            <span>Publicaciones</span>
            <span>/</span>
            <span class="is-current">Editar</span>
        </nav>

        <div class="sds-page-header">
            <span class="sds-page-tag">Semana de Sistemas 2026 · Gestión de entradas</span>
            <h1 class="sds-page-title">Editar publicación</h1>
            <p class="sds-page-subtitle">Actualiza la información, la portada o el estado de esta entrada.</p>
        </div>

        <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('admin.posts._form', ['post' => $post, 'submitLabel' => 'Actualizar publicación'])
        </form>
    </main>
</div>
@endsection
