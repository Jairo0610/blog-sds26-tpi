@extends("layouts.auth")

@section("title", "Panel de control")

@section("content")
<header class="border-b border-gray-200 bg-white">
    <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
        <div class="flex items-center gap-4">
            <img src="{{ asset("img/sds26-logo.png") }}" alt="SDS26 Green IoT" class="h-10 w-auto">
            <span class="text-sm font-semibold text-sds-ink/70">Panel administrativo</span>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route("home") }}" class="rounded-lg border border-gray-300 px-3.5 py-2 text-sm font-semibold text-sds-ink hover:bg-gray-50">
                Ver blog
            </a>
            <a href="{{ route("admin.posts.create") }}" class="rounded-lg bg-sds-green px-4 py-2 text-sm font-bold text-white hover:bg-sds-green-dark">
                + Nueva publicación
            </a>
            <form method="POST" action="{{ route("logout") }}">
                @csrf
                <button type="submit" class="rounded-lg border border-sds-ink px-4 py-2 text-sm font-semibold hover:bg-sds-ink hover:text-white">
                    Cerrar sesión
                </button>
            </form>
        </div>
    </div>
</header>

<main class="mx-auto max-w-6xl px-6 py-10">
    @if (session("success"))
        <div class="mb-6 rounded-lg border border-sds-green/40 bg-sds-mint px-4 py-3 text-sm font-medium text-sds-green-dark">
            {{ session("success") }}
        </div>
    @endif

    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black uppercase">Panel de control</h1>
            <p class="mt-1 text-sds-ink/60">Sesión iniciada como <strong>{{ auth()->user()->name }}</strong>.</p>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs font-bold uppercase text-sds-ink/60">Total publicaciones</p>
            <p class="mt-2 text-3xl font-black text-sds-ink">{{ $totalPosts ?? 0 }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs font-bold uppercase text-sds-ink/60">Publicadas</p>
            <p class="mt-2 text-3xl font-black text-sds-green-dark">{{ $publicadasCount ?? 0 }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs font-bold uppercase text-sds-ink/60">Borradores</p>
            <p class="mt-2 text-3xl font-black text-amber-700">{{ $borradoresCount ?? 0 }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-5">
            <p class="text-xs font-bold uppercase text-sds-ink/60">Categorías / Actividades</p>
            <p class="mt-2 text-2xl font-black text-sds-ink">{{ $categoriasCount ?? 0 }} / {{ $actividadesCount ?? 0 }}</p>
        </div>
    </div>

    <section class="mt-10 rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4">
            <h2 class="text-lg font-extrabold text-sds-ink">Publicaciones registradas</h2>
            <a href="{{ route("admin.posts.create") }}" class="text-sm font-bold text-sds-green-dark hover:underline">
                + Subir nueva entrada
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gray-50 text-xs font-bold uppercase text-sds-ink/70">
                    <tr>
                        <th class="px-6 py-3">Título</th>
                        <th class="px-6 py-3">Categoría</th>
                        <th class="px-6 py-3">Fecha actividad</th>
                        <th class="px-6 py-3">Autores</th>
                        <th class="px-6 py-3">Estado</th>
                        <th class="px-6 py-3 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($posts ?? [] as $post)
                        <tr class="hover:bg-gray-50/70">
                            <td class="px-6 py-4 font-semibold text-sds-ink">
                                <div class="flex items-center gap-3">
                                    @if ($post->imagen_principal)
                                        <img src="{{ asset("storage/" . $post->imagen_principal) }}" alt="{{ $post->titulo }}" class="h-11 w-16 rounded object-cover border border-gray-200 shrink-0">
                                    @endif
                                    <span>{{ $post->titulo }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sds-ink/80">{{ $post->categoria->nombre ?? "—" }}</td>
                            <td class="px-6 py-4 text-sds-ink/80">{{ optional($post->fecha_actividad)->format("d/m/Y") ?? "—" }}</td>
                            <td class="px-6 py-4 text-sds-ink/80">
                                @if ($post->autores && $post->autores->isNotEmpty())
                                    {{ $post->autores->pluck("name")->join(", ") }}
                                @else
                                    {{ $post->usuario->name ?? "—" }}
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($post->estado === \App\Models\PostModel::ESTADO_PUBLICADO)
                                    <span class="inline-flex rounded-full bg-sds-mint px-2.5 py-1 text-xs font-bold text-sds-green-dark">
                                        Publicado
                                    </span>
                                @else
                                    <span class="inline-flex rounded-full bg-amber-100 px-2.5 py-1 text-xs font-bold text-amber-800">
                                        Borrador
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route("admin.posts.edit", $post) }}" class="rounded-md border border-gray-300 px-3 py-1.5 text-xs font-semibold text-sds-ink hover:bg-gray-50">
                                        Editar
                                    </a>
                                    <form method="POST" action="{{ route("admin.posts.destroy", $post) }}" onsubmit="return confirm(\x27¿Eliminar esta publicación?\x27);">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="rounded-md border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-100">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sds-ink/60">
                                Aún no hay publicaciones registradas. Haz clic en <strong>+ Nueva publicación</strong> para subir la primera.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>
@endsection