<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ActividadModel extends Model
{
    protected $table = 'actividades';

    protected $fillable = [
        'categoria_id',
        'nombre',
        'descripcion',
        'fecha_hora',
        'lugar',
    ];

    protected function casts(): array
    {
        return [
            'fecha_hora' => 'datetime',
        ];
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaModel::class, 'categoria_id');
    }

    public function entradas(): HasMany
    {
        return $this->hasMany(PostModel::class, 'actividad_id');
    }

    public function evidencias(): HasMany
    {
        return $this->hasMany(PostModel::class, 'actividad_id');
    }
}
