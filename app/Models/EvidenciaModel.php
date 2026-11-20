<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvidenciaModel extends Model
{
    protected $table = 'evidencias';

    protected $fillable = [
        'actividad_id',
        'usuario_id',
        'post_id',
        'tipo',
        'ruta_archivo',
        'descripcion',
        'fecha',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function actividad(): BelongsTo
    {
        return $this->belongsTo(ActividadModel::class, 'actividad_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function entrada(): BelongsTo
    {
        return $this->belongsTo(PostModel::class, 'post_id');
    }
}
