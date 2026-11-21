<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class PostModel extends Model
{
    public const ESTADO_BORRADOR = 'borrador';
    public const ESTADO_PUBLICADO = 'publicado';

    protected $table = 'posts';

    protected $fillable = [
        'usuario_id',
        'categoria_id',
        'actividad_id',
        'titulo',
        'slug',
        'fecha_actividad',
        'resumen',
        'contenido',
        'imagen_principal',
        'estado',
        'publicado_en',
    ];

    protected function casts(): array
    {
        return [
            'fecha_actividad' => 'date',
            'publicado_en' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (PostModel $entrada) {
            // Slug único a partir del título
            if (blank($entrada->slug) || $entrada->isDirty('titulo')) {
                $base = Str::slug($entrada->titulo);
                $slug = $base;
                $i = 2;
                while (static::where('slug', $slug)->where('id', '!=', $entrada->id ?? 0)->exists()) {
                    $slug = "{$base}-{$i}";
                    $i++;
                }
                $entrada->slug = $slug;
            }

            // Fecha de publicación al pasar a "publicado"
            if ($entrada->estado === self::ESTADO_PUBLICADO && blank($entrada->publicado_en)) {
                $entrada->publicado_en = now();
            }
        });
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaModel::class, 'categoria_id');
    }

    public function actividad(): BelongsTo
    {
        return $this->belongsTo(ActividadModel::class, 'actividad_id');
    }

    public function autores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'usuario_id')->withTimestamps();
    }

    public function imagenes(): HasMany
    {
        return $this->hasMany(PostImagenModel::class, 'post_id')->orderBy('orden');
    }

    public function evidencias(): HasMany
    {
        return $this->hasMany(EvidenciaModel::class, 'post_id');
    }

    public function scopePublicadas(Builder $query): Builder
    {
        return $query->where('estado', self::ESTADO_PUBLICADO);
    }

    public function scopeRecientes(Builder $query): Builder
    {
        return $query->orderByDesc('publicado_en')->orderByDesc('id');
    }

    public function estaPublicada(): bool
    {
        return $this->estado === self::ESTADO_PUBLICADO;
    }
}
