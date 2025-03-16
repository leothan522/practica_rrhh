<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{
    //
    protected $table = "estados";
    protected $fillable = ['id', 'nombre'];

    public function municipios(): HasMany
    {
        return $this->hasMany(Municipio::class, 'estados_id', 'id');
    }

    public function ciudades(): HasMany
    {
        return $this->hasMany(Ciudad::class, 'estados_id', 'id');
    }
}
