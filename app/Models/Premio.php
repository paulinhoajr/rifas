<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    protected $table = 'premios';

    protected $primaryKey = 'id';

    public function imagens()
    {
        return $this->hasMany(Imagem::class);
    }

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }

}
