<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostImagenModel extends Model
{
    protected $table = 'post_images';

    protected $fillable = [
        'post_id',
        'usuario_id',
        'ruta',
        'descripcion',
        'orden',
    ];

    public function entrada(): BelongsTo
    {
        return $this->belongsTo(PostModel::class, 'post_id');
    }

    //Integrante dueño de la evidencia; null significa que corresponde a ambos integrantes
    public function integrante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
