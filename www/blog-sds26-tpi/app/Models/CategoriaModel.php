<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CategoriaModel extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
    ];

    //Metodo para generar el slug automaticamente apartir del nombre
    protected static function booted(): void
    {
        static::saving(function (CategoriaModel $categoria) {
            if (blank($categoria->slug) || $categoria->isDirty('nombre')) {
                $categoria->slug = Str::slug($categoria->nombre);
            }
        });
    }

    public function entradas(): HasMany
    {
        return $this->hasMany(PostModel::class, 'categoria_id');
    }

    public function actividades(): HasMany
    {
        return $this->hasMany(ActividadModel::class, 'categoria_id');
    }
}
