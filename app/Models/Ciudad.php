<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ciudad extends Model
{
    //
    protected $table = "ciudades";
    protected $fillable = ['id', 'estados_id', 'nombre', 'capital', 'rowquid'];

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }
}
