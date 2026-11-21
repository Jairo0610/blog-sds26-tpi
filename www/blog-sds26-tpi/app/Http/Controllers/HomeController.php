<?php

namespace App\Http\Controllers;

use App\Models\ActividadModel;
use App\Models\CategoriaModel;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    //Metodo para cargar las vistas principales con los datos de las ponencias y las actividades
    public function index(Request $request): View
    {
        //Slug de la categoría seleccionada en el filtro
        $categoriaActual = $request->query('categoria');

        //Categorías para los botones del filtro
        $categorias = CategoriaModel::whereHas('entradas', fn ($q) => $q->publicadas())->orderBy('nombre')->get();

        //Publicaciones visibles al público
        $posts = PostModel::publicadas()->with(['categoria', 'usuario', 'autores'])->when($categoriaActual, fn ($q) => $q->whereHas(
                'categoria', fn ($c) => $c->where('slug', $categoriaActual)
            ))->recientes()->paginate(9)->withQueryString();

        //Ponencias del evento, en orden cronológico
        $ponencias = ActividadModel::whereHas('categoria', fn ($q) => $q->where('nombre', 'Ponencias'))->orderBy('fecha_hora')->get();

        //Agrupación de las actividades por día
        $actividadesPorDia = ActividadModel::with('categoria')->whereDoesntHave('categoria', fn ($q) => $q->where('nombre', 'Ponencias'))
            ->orderBy('fecha_hora')->get()->groupBy(fn ($actividad) => $actividad->fecha_hora->toDateString());

        return view('welcome', compact('categorias', 'categoriaActual', 'posts', 'ponencias', 'actividadesPorDia'));
    }

    // Metodo para mostrar el detalle de una publicacion publicada
    public function show(string $slug): View
    {
        $post = PostModel::publicadas()->where('slug', $slug)->with(['categoria', 'actividad', 'usuario', 'autores', 'imagenes', 'evidencias'])->firstOrFail();

        $relacionadas = PostModel::publicadas()->where('id', '!=', $post->id)->with(['categoria', 'usuario', 'autores'])->recientes()->limit(3)->get();

        return view('posts.show', compact('post', 'relacionadas'));
    }
}
