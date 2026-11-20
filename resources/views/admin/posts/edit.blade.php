@extends("layouts.auth")

@section("title", "Editar publicación")

@section("content")
<header class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-5xl items-center justify-between px-6 py-4">
        <div class="flex items-center gap-4">
            <a href="{{ route("admin.dashboard") }}">
                <img src="{{ asset("img/sds26-logo.png") }}" alt="SDS26 Green IoT" class="h-10 w-auto">
            </a>
            <span class="text-sm font-semibold text-sds-ink/60">Editar publicación</span>
        </div>
        <a href="{{ route("admin.dashboard") }}" class="text-sm font-semibold text-sds-ink hover:underline">
            ← Volver al panel
        </a>
    </div>
</header>

<main class="mx-auto max-w-5xl px-6 py-10">
    <h1 class="text-2xl font-black uppercase text-sds-ink">Editar publicación</h1>
    <p class="mt-1 text-sm text-sds-ink/60">Actualiza la información, imagen principal o estado de la entrada.</p>

    <form method="POST" action="{{ route("admin.posts.update", $post) }}" enctype="multipart/form-data" class="mt-6 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        @method("PUT")
        @include("admin.posts._form", ["post" => $post, "submitLabel" => "Actualizar publicación"])
    </form>
</main>
@endsection