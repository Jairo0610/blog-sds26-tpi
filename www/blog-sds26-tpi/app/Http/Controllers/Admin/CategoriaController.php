<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

//Controlador del CRUD de categorías (área administrativa)
class CategoriaController extends Controller
{
    //Lista las categorías con el número de entradas y actividades asociadas
    public function index(): View
    {
        $categorias = CategoriaModel::withCount(['entradas', 'actividades'])->orderBy('nombre')->get();

        return view('admin.categorias.index', compact('categorias'));
    }

    public function create(): View
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateCategoria($request);

        $categoria = CategoriaModel::create($validated);

        return redirect()->route('admin.categorias.index')->with('success', 'La categoría "' . $categoria->nombre . '" se guardó correctamente.');
    }

    public function edit(CategoriaModel $categoria): View
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, CategoriaModel $categoria): RedirectResponse
    {
        $validated = $this->validateCategoria($request, $categoria);

        $categoria->update($validated);

        return redirect()->route('admin.categorias.index')->with('success', 'La categoría "' . $categoria->nombre . '" se actualizó correctamente.');
    }

    public function destroy(CategoriaModel $categoria): RedirectResponse
    {
        //Las claves foráneas de posts y actividades son restrictivas: se avisa en lugar de lanzar un error 500
        if ($categoria->entradas()->exists() || $categoria->actividades()->exists()) {
            return redirect()->route('admin.categorias.index')->with('error', 'No se puede eliminar "' . $categoria->nombre . '" porque tiene publicaciones o actividades asociadas.');
        }

        $nombre = $categoria->nombre;
        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'La categoría "' . $nombre . '" fue eliminada.');
    }

    private function validateCategoria(Request $request, ?CategoriaModel $categoria = null): array
    {
        return $request->validate([
            'nombre' => [
                'required', 'string', 'max:100',
                Rule::unique('categorias', 'nombre')->ignore($categoria?->id),
                //El slug se genera desde el nombre y también debe ser único (ej. "Bingo" y "bingo!" chocarían)
                function (string $attribute, mixed $value, \Closure $fail) use ($categoria) {
                    $slug = Str::slug($value);

                    if ($slug === '') {
                        $fail('El nombre debe contener letras o números.');
                        return;
                    }

                    $existe = CategoriaModel::where('slug', $slug)->when($categoria, fn ($q) => $q->where('id', '!=', $categoria->id))->exists();

                    if ($existe) {
                        $fail('Ya existe una categoría con un nombre equivalente.');
                    }
                },
            ],
            'descripcion' => ['nullable', 'string', 'max:500'],
        ], [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.max' => 'El nombre no puede superar los 100 caracteres.',
            'nombre.unique' => 'Ya existe una categoría con ese nombre.',
            'descripcion.max' => 'La descripción no puede superar los 500 caracteres.',
        ]);
    }
}
