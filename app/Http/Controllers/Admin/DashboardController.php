<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActividadModel;
use App\Models\CategoriaModel;
use App\Models\PostModel;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPosts = PostModel::count();
        $publicadasCount = PostModel::where('estado', PostModel::ESTADO_PUBLICADO)->count();
        $borradoresCount = PostModel::where('estado', PostModel::ESTADO_BORRADOR)->count();
        $categoriasCount = CategoriaModel::count();
        $actividadesCount = ActividadModel::count();

        $posts = PostModel::with(['categoria', 'actividad', 'usuario', 'autores'])
            ->orderByDesc('updated_at')
            ->orderByDesc('id')
            ->get();

        return view('admin.dashboard', compact(
            'totalPosts',
            'publicadasCount',
            'borradoresCount',
            'categoriasCount',
            'actividadesCount',
            'posts'
        ));
    }
}
