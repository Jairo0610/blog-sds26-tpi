<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActividadModel;
use App\Models\CategoriaModel;
use App\Models\PostModel;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PostController extends Controller
{
    public function create(): View
    {
        $categorias = CategoriaModel::orderBy('nombre')->get();
        $actividades = ActividadModel::orderBy('fecha_hora')->get();
        $usuarios = User::orderBy('name')->get();

        return view('admin.posts.create', compact('categorias', 'actividades', 'usuarios'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePost($request);

        $rutaImagen = null;
        if ($request->hasFile('imagen_principal')) {
            $rutaImagen = $request->file('imagen_principal')->store('posts', 'public');
        }

        $estado = $validated['estado'];

        $post = PostModel::create([
            'usuario_id' => $request->user()->id,
            'categoria_id' => $validated['categoria_id'],
            'actividad_id' => $validated['actividad_id'] ?? null,
            'titulo' => $validated['titulo'],
            'fecha_actividad' => $validated['fecha_actividad'],
            'resumen' => $validated['resumen'] ?? null,
            'contenido' => $validated['contenido'],
            'imagen_principal' => $rutaImagen,
            'estado' => $estado,
            'publicado_en' => $estado === PostModel::ESTADO_PUBLICADO ? now() : null,
        ]);

        $autoresIds = collect($validated['autores'] ?? [$request->user()->id])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();

        $post->autores()->sync($autoresIds);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'La publicación "' . $post->titulo . '" se guardó correctamente.');
    }

    public function edit(PostModel $post): View
    {
        $post->load('autores');
        $categorias = CategoriaModel::orderBy('nombre')->get();
        $actividades = ActividadModel::orderBy('fecha_hora')->get();
        $usuarios = User::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categorias', 'actividades', 'usuarios'));
    }

    public function update(Request $request, PostModel $post): RedirectResponse
    {
        $validated = $this->validatePost($request);

        $rutaImagen = $post->imagen_principal;
        if ($request->hasFile('imagen_principal')) {
            if ($rutaImagen && Storage::disk('public')->exists($rutaImagen)) {
                Storage::disk('public')->delete($rutaImagen);
            }
            $rutaImagen = $request->file('imagen_principal')->store('posts', 'public');
        }

        $estado = $validated['estado'];
        $publicadoEn = $post->publicado_en;
        if ($estado === PostModel::ESTADO_PUBLICADO && blank($publicadoEn)) {
            $publicadoEn = now();
        }

        $post->update([
            'categoria_id' => $validated['categoria_id'],
            'actividad_id' => $validated['actividad_id'] ?? null,
            'titulo' => $validated['titulo'],
            'fecha_actividad' => $validated['fecha_actividad'],
            'resumen' => $validated['resumen'] ?? null,
            'contenido' => $validated['contenido'],
            'imagen_principal' => $rutaImagen,
            'estado' => $estado,
            'publicado_en' => $publicadoEn,
        ]);

        $autoresIds = collect($validated['autores'] ?? [$post->usuario_id])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();

        $post->autores()->sync($autoresIds);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'La publicación "' . $post->titulo . '" se actualizó correctamente.');
    }

    public function destroy(PostModel $post): RedirectResponse
    {
        if ($post->imagen_principal && Storage::disk('public')->exists($post->imagen_principal)) {
            Storage::disk('public')->delete($post->imagen_principal);
        }

        $titulo = $post->titulo;
        $post->autores()->detach();
        $post->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'La publicación "' . $titulo . '" fue eliminada.');
    }

    private function validatePost(Request $request): array
    {
        return $request->validate([
            'titulo' => ['required', 'string', 'max:200'],
            'fecha_actividad' => ['required', 'date'],
            'categoria_id' => ['required', 'integer', Rule::exists('categorias', 'id')],
            'actividad_id' => ['nullable', 'integer', Rule::exists('actividades', 'id')],
            'resumen' => ['nullable', 'string', 'max:300'],
            'contenido' => ['required', 'string'],
            'imagen_principal' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'estado' => ['required', Rule::in([PostModel::ESTADO_BORRADOR, PostModel::ESTADO_PUBLICADO])],
            'autores' => ['nullable', 'array'],
            'autores.*' => ['integer', Rule::exists('users', 'id')],
        ], [
            'titulo.required' => 'El título de la publicación es obligatorio.',
            'titulo.max' => 'El título no puede superar los 200 caracteres.',
            'fecha_actividad.required' => 'La fecha de la actividad es obligatoria.',
            'fecha_actividad.date' => 'Ingresa una fecha de actividad válida.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'actividad_id.exists' => 'La actividad seleccionada no es válida.',
            'resumen.max' => 'El resumen no puede superar los 300 caracteres.',
            'contenido.required' => 'El contenido de la publicación es obligatorio.',
            'imagen_principal.image' => 'El archivo seleccionado debe ser una imagen.',
            'imagen_principal.mimes' => 'Solo se admiten imágenes JPG, JPEG, PNG o WEBP.',
            'imagen_principal.max' => 'La imagen no debe pesar más de 4 MB.',
            'estado.required' => 'Debes indicar si la entrada es borrador o publicada.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);
    }
}
