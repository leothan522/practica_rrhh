<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parroquia extends Model
{
    //
    protected $table = "parroquias";
    protected $fillable = ['id', 'municipios_id', 'nombre'];

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class, 'municipios_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'parroquias_id');
    }
}
