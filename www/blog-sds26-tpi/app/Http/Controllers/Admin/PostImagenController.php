<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostImagenModel;
use App\Models\PostModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

//Controlador para cargar y gestionar la galería de imágenes de una publicación
class PostImagenController extends Controller
{
    //Sube una o varias imágenes a la galería de la publicación
    public function store(Request $request, PostModel $post): RedirectResponse
    {
        $request->validateWithBag('galeria', [
            'imagenes' => ['required', 'array', 'max:10'],
            'imagenes.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'descripcion' => ['nullable', 'string', 'max:200'],
            'usuario_id' => $this->reglaIntegrante($post),
        ], [
            'imagenes.required' => 'Selecciona al menos una imagen para la galería.',
            'imagenes.max' => 'Puedes subir un máximo de 10 imágenes a la vez.',
            'imagenes.*.image' => 'Cada archivo seleccionado debe ser una imagen.',
            'imagenes.*.mimes' => 'Solo se admiten imágenes JPG, JPEG, PNG o WEBP.',
            'imagenes.*.max' => 'Cada imagen no debe pesar más de 4 MB.',
            'descripcion.max' => 'La descripción no puede superar los 200 caracteres.',
            'usuario_id.in' => 'El integrante seleccionado no pertenece a esta publicación.',
        ]);

        $orden = (int) $post->imagenes()->max('orden');

        foreach ($request->file('imagenes') as $archivo) {
            $post->imagenes()->create([
                'ruta' => $archivo->store('posts/galeria', 'public'),
                'usuario_id' => $request->input('usuario_id'),
                'descripcion' => $request->input('descripcion'),
                'orden' => ++$orden,
            ]);
        }

        $total = count($request->file('imagenes'));

        return redirect()->route('admin.posts.edit', $post)->with('success', $total === 1 ? 'Se agregó 1 imagen a la galería.' : "Se agregaron {$total} imágenes a la galería.");
    }

    //Actualiza la descripción de una imagen de la galería
    public function update(Request $request, PostModel $post, PostImagenModel $imagen): RedirectResponse
    {
        $this->asegurarPertenencia($post, $imagen);

        $validated = $request->validateWithBag('galeria', [
            'descripcion' => ['nullable', 'string', 'max:200'],
            'usuario_id' => $this->reglaIntegrante($post),
        ], [
            'descripcion.max' => 'La descripción no puede superar los 200 caracteres.',
            'usuario_id.in' => 'El integrante seleccionado no pertenece a esta publicación.',
        ]);

        $imagen->update($validated);

        return redirect()->route('admin.posts.edit', $post)->with('success', 'La imagen de la galería se actualizó correctamente.');
    }

    //Elimina la imagen de la galería y su archivo del disco
    public function destroy(PostModel $post, PostImagenModel $imagen): RedirectResponse
    {
        $this->asegurarPertenencia($post, $imagen);

        if (Storage::disk('public')->exists($imagen->ruta)) {
            Storage::disk('public')->delete($imagen->ruta);
        }

        $imagen->delete();

        return redirect()->route('admin.posts.edit', $post)->with('success', 'La imagen fue eliminada de la galería.');
    }

    //El dueño de la evidencia debe ser uno de los integrantes de la publicación (vacío = ambos)
    private function reglaIntegrante(PostModel $post): array
    {
        return ['nullable', 'integer', Rule::in($post->integrantes()->pluck('id')->all())];
    }

    //Evita editar o borrar una imagen usando la URL de otra publicación
    private function asegurarPertenencia(PostModel $post, PostImagenModel $imagen): void
    {
        abort_unless($imagen->post_id === $post->id, 404);
    }
}
