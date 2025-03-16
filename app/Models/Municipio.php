<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipio extends Model
{
    //
    protected $table = "municipios";
    protected $fillable = ['id', 'estados_id', 'nombre'];

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estados_id');
    }

    public function parroquias(): HasMany
    {
        return $this->hasMany(Parroquia::class, 'municipios_id', 'id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'municipios_id', 'id');
    }

}
