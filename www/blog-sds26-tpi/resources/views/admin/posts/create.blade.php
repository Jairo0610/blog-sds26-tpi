@extends('layouts.auth')

@section('title', 'Nueva publicación')

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
            <span class="is-current">Nueva</span>
        </nav>

        <div class="sds-page-header">
            <span class="sds-page-tag">Semana de Sistemas 2026 · Gestión de entradas</span>
            <h1 class="sds-page-title">Nueva publicación</h1>
            <p class="sds-page-subtitle">Completa los datos de la entrada y guárdala como borrador o publicada.</p>
        </div>

        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" novalidate>
            @include('admin.posts._form', ['submitLabel' => 'Guardar publicación'])
        </form>
    </main>
</div>
@endsection
